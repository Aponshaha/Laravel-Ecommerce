<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests; 
use Auth;


use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;                
use Illuminate\Support\Facades\Redirect;
use DB;

use App\Models\Common;
use App\Models\Order;
use App\Models\Payment_model;


use Log;     
use Session;
use Crypt;
use Mail;
use Config;

use Illuminate\Support\Facades\Hash;



use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;          


class OrderController extends Controller
{
   
    public $common;

	public $order_model;
    
    public function __construct()
    {        
	
      //  $this->middleware('auth', ['except' => 'test']);
        $this->common = new Common;
	
        
    }
	
	
    public function test()
    {
	 return view('test');	
	}	
     
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showPaymentOption($temp_order_row_id)
    { 
      
      
     $data['temp_order'] = DB::table('temp_orders')
                               ->where('temp_order_row_id', $temp_order_row_id)    
                               ->first();
     $track_id =  Session::getId();   
  
     
    if(!$data['temp_order'])
    {
       throw new NotFoundHttpException('Session has expired, Please choose the job again');   
    }
    
    $data['order_row_id'] = $temp_order_row_id;       	
	return view('order.payment_method', ['data'=>$data]);	
    
    }
    
    public function saveTempOrder(Request $request)
    {

        $gigs = '';
       if($request->gigs) {
         $gigs = implode($request->gigs, '|');               
       } 
       
     // $track_id =  Session::getId();
      $seller_id =  DB::table('jobs')->where('job_row_id',$request->job_row_id)->first()->user_id;                  
      $temp_order_row_id =  DB::table('temp_orders')->insertGetId([
            'job_row_id' => $request->job_row_id,
             'gigs'=>$gigs,
             'buyer_id' => auth::user()->id,   
             'seller_id' => $seller_id,
             'total_price'=> $request->total_price,                        
            ]);           
          
       return Redirect::to("/order/showPaymentOption/$temp_order_row_id");
    
    }
	
	public function processPayment(Request $request)
    {       //		
    
   /* Log::info('Showing user profile for user: ');   
     echo myData();
     */

   if(Auth::guest()) {
       $user_id = 0;
       if($request->password)
       {
           // if the email is already there then retrieve it.  now we have a bug, solve it.
           $data['name'] = $request->name;
           $data['email'] = $request->email;
           $data['password'] = Hash::make($request->password);
           $user_id =  DB::table('users')->insertGetId($data);
       }
   }
   else {
       $user_id = auth::user()->id;
   }

    $data = array();
    $Order_model = new Order;       
    $order = DB::table('users')            
            ->where('id', $user_id)
            ->first();
	
    $tracking_number = Session::getId();	 
	
	$Order_model->total_price= DB::table('temp_orders')->where('tracking_number', $tracking_number)->sum('product_total_price');	
    
	/*$order->card_number = $request->card_number;
    $order->card_type = $request->card_type; 
    $order->card_holder_contactname = $request->card_holder_contactname;
    $order->card_exp_month = $request->card_exp_month;
    $order->card_exp_year =  $request->card_exp_year;
    $order->total_price = $order_info->product_total_price;
	*/
    //$payment_model = new Payment_model();
    //$gateway_setup_details = $payment_model->getGatewaySetup(); 
    //$cvv2 = '';
   // $paymentDetails = $payment_model->chargeOrder($order, $gateway_setup_details, $cvv2);
    
	$paymentDetails['success'] = 1;

    $Order_model->user_id = $user_id;
      
    if (! $paymentDetails['success'])
    {
    abort(101);
    }
    else
    {

    $Order_model->order_status = 1;
    $Order_model->save();
    $order_row_id = $Order_model->order_row_id;
    }

	$data['track_id'] = 'ORD - ' . $order_row_id;
	return view('front_end.order_success', ['data'=>$data]);
	
    }
    
    function mySellerOrders()
    {
        
		$data['items'] =   DB::table('orders As o')
							->Join('jobs As j', 'o.job_row_id', '=', 'j.job_row_id')                                        
							->where('seller_id', Auth::user()->id) 
							->orderBy('o.order_row_id', 'DESC')					  
							->get();    
                                
		return view('order.seller_orders', ['data'=>$data]);         
    }
    
    function myBuyerOrders()
    {
		$data['items'] = DB::table('orders As o')
							->Join('jobs As j', 'o.job_row_id', '=', 'j.job_row_id')                                        
							->where('buyer_id', Auth::user()->id)  
							->orderBy('o.order_row_id', 'DESC')
							->get();
									
		return view('order.buyer_orders', ['data'=>$data]);         
    }
    
    /*    
       buyer can make the task completed
    */
    
    public function completeProject(Request $request)
    {
		if(!$request->order_row_id)  
		return false;

		$order_row_id = $request->order_row_id;
		$orderInfo = DB::table('orders')->where('order_row_id', $order_row_id)->first();


		$site_elements = Config::get('site_config.site_elements'); 


		// completed 
		if($request->action_type == 1)
		{
		
		// As only buyer can make the task completed
		if( $orderInfo->buyer_id != Auth::user()->id ) 
		return false;
		
		DB::table('orders')
				->where('order_row_id', $order_row_id)
				->update( ['order_status' => $site_elements['order_status_completed'] ]);
				
		DB::table('user_balances')
				->where('order_row_id', $order_row_id)
				->update(['status' => $site_elements['removed_charged'] ]);
		 
									  
		$site_commission =  floor ( ($orderInfo->total_price * $site_elements['admin_commission'] ) / 100 );
		$amount_to_pay = $orderInfo->total_price - $site_commission;
		 
		DB::table('admin_balances')            
				->insert([           
				'amount' => $site_commission,
				'order_row_id' => $orderInfo->order_row_id,
				'created_at' => getCurrentDateTimeForDB(), 
				]);
		 
		DB::table('user_balances')            
				->insert([
				'user_id' => $orderInfo->seller_id,
				'order_row_id' => $orderInfo->order_row_id,
				'balance_amount' => $amount_to_pay,
				'balance_type' => $site_elements ['balance_earned'],
				'status'=>$site_elements['active'],
				'created_at' => getCurrentDateTimeForDB(), 
				]);
				
		Session::flash('success-message', 'The task has been completed Successfully');
	    }
		else if($request->action_type == 2)
		{
			if( ($orderInfo->seller_id != Auth::user()->id) && ($orderInfo->buyer_id != Auth::user()->id) ) // As buyer or seller can make the task disputed
			return false;
			
			DB::table('orders')
					->where('order_row_id', $order_row_id)
					->update(['order_status' => $site_elements['order_status_cancelled'] ]);
					
			DB::table('user_balances')
					->where('order_row_id', $order_row_id)
					->update([
					'balance_type' => $site_elements['balance_deposited_by_cancelling_order'],
					'status' => $site_elements['active'],
					]); 			
				
			Session::flash('success-message', 'The order has been cancelled.');
	  
	    }
		
		DB::table('user_reviews')            
			->insert([
			'order_row_id' => $orderInfo->order_row_id,
			'who_comment'=> Auth::user()->id,			
			'review_text'=>$request->review_text,
			'created_at'=>getCurrentDateTimeForDB(),
			'review_type'=>$request->action_type,
		]);
		
      return redirect('/orderDealings/' . $orderInfo->order_row_id . '/' . $orderInfo->buyer_id . '/' . $orderInfo->seller_id);                      
    
      //user_balances      
    }
    
    
    function balance()
    {                   
         // active amount                                        
         $data['balance_info'] = DB::table('user_balances AS ub')
                            ->leftJoin('orders As o', 'ub.order_row_id', '=', 'o.order_row_id')                                     
                            ->leftJoin('jobs As j', 'o.job_row_id', '=', 'j.job_row_id')                                     
                            ->select('ub.balance_amount', 'ub.status as balance_status', 'j.job_title')  
                            ->where('ub.user_id', Auth::user()->id )->where('ub.status', '!=', 3)
                            ->get();
							
		                          					
                            
         return view('account.balance', ['data'=>$data]);   
    }

    
    function s3()
    {   
        echo $url = Storage::url('author.jpg');                                                            
        $disk = Storage::disk('author.jpg');
        Storage::put('ourfile.jpg', 'pwc example');
    }
   
}
