<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class TempController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
       
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

     public function index()
    {
        if (Auth::guest())
        {
            return view('checkout_Without_login');
        }
        return view('checkout2');
     
     
    }
     public function addToCart($product_row_id) {
        
        $data['product_info'] = DB::table('products')->where('product_row_id', $product_row_id)->first();
        
        $tracking_number = Session::getId();       
        DB::table('temp_orders')->insert([
        'product_row_id'=> $data['product_info']->product_row_id, 
        'tracking_number'=> $tracking_number,
        'product_price'=> $data['product_info']->product_price, 
        'product_qty'=> 1,
        'product_total_price'=> $data['product_info']->product_price, 
        'created_at'=> date('Y-m-d H:i:s'),        
        ]);    
        
        return redirect('/mycart');                      
       
    }
    public function postAddToCart(Request  $request)
    {
    
         $product=Product::find($request->product_row_id);
          Cart::add(['id' => $product->product_row_id, 'name' => $product->product_name, 'qty' => $request->qty, 'price' => $product->product_price, 'options' => ['description' => $product->product_long_description,'image'=>$product->product_image]]);
          return redirect('/mycart'); 
    }
    
    public function mycart() {


                               
		$data['temp_orders']=Cart::Content();		   
        
        
        return view('cart', ['data'=>$data]);         
    }
       
     public function updateCart(Request $request) 
     {
	       

              $rowId = $request->rowId;

              $qty=$request->qty_textbox;

            Cart::update($rowId, $qty);
       return redirect('/mycart');                          
     }
     
    public function cartItemDelete(Request $request)
    {


             $rowId = $request->temp_order_row_id;

            Cart::remove($rowId);
		
	 
    } 
	
	public function cartItemDeleteAll()
    {
		Cart::destroy();
    } 
	
	
	
	public function checkout1()
	{
	  
	 $data = Cart::Content();
	
	 return view('checkout_Without_login', ['data'=>$data]);
	 
	} 
    public function confirmOrder(Request $request)
    {
                $tempOrders =Cart::Content();
                $payment_type_id=$request->payment_type_id;

                $shiping['name']=$request->customer_name;
                $shiping['emai']=$request->customer_email;
                $shiping['mobile']=$request->customer_phone;
                $shiping['address']=$request->customer_address;

                $shiping_address=  json_encode($shiping);

                $payment_info='';
                $order_details= [];
                $product_codes='';
                //$payment_method_id=$request->payment_method;
               $payment_id= $request->get('payment_type');

                if($payment_id==1)
                {
                      $arr1["payment_method"]='bKash';
                      $arr1["txr_id"]=$request->trnxId;
                      $arr1["payment_id"]=$payment_id;
                      $payment_info=json_encode($arr1);
                }
                else if($payment_id==2)
                {
                     $arr1["payment_method"]='DBBL Mobile Banking';
                     $arr1["txr_id"]=$request->trnxId;
                      $arr1["payment_id"]=$payment_id;
                      $payment_info=json_encode($arr1);
                }
                else if($payment_id==3)
                {
                      $arr1["payment_method"]='Cash on Delivery';
                       $arr1["payment_id"]=$payment_id;
                      $payment_info=json_encode($arr1);
                }
                else if($payment_id==4){
                $arr1["payment_method"]='VISA Card';
                $arr1["payment_id"]=$payment_id;
                $arr1["card_no"]=$request->card_number;
                $arr1["card_name"]=$request->card_holder_contactname;
                $arr1["cw"]=$request->card_security_code;
                $arr1["exp_month"]=$request->card_exp_month;
                $arr1["exp_year"]=$request->card_exp_year;
                $payment_info=json_encode($arr1);
              
                }
                else if($payment_id==5){
                $arr1["payment_method"]='Master Card';
                $arr1["payment_id"]=$payment_id;
                $arr1["card_no"]=$request->card_number;
                $arr1["card_name"]=$request->card_holder_contactname;
                $arr1["cw"]=$request->card_security_code;
                $arr1["exp_month"]=$request->card_exp_month;
                $arr1["exp_year"]=$request->card_exp_year;
                $payment_info=json_encode($arr1);
              
                }
                else if($payment_id==6){
                $arr1["payment_method"]='American Express';
                $arr1["payment_id"]=$payment_id;
                $arr1["card_no"]=$request->card_number;
                $arr1["card_name"]=$request->card_holder_contactname;
                $arr1["cw"]=$request->card_security_code;
                $arr1["exp_month"]=$request->card_exp_month;
                $arr1["exp_year"]=$request->card_exp_year;
                $payment_info=json_encode($arr1);
              
                }


                    
                foreach ($tempOrders  as $order) {
                    
                        if($order !=null)
                        {
                        
                         $order_details[] = [
                        'product_row_id' => $order->id,
                        'product_name'=>$order->name,
                        'product_price' => $order->price,
                        'product_qty' => $order->qty,
                        'product_total_price' => $order->subtotal(),
                                             
                        ];

                       

                        }
                }

                $order_details_final =json_encode($order_details);


        if(Auth::check())
            {
                          $insert[]=
                                [
                                    'user_id'=>  Auth::user()->id,
                                    'total_price'=>Cart::total(),
                                    'order_details'=>$order_details_final,
                                    'shiping_address'=> $shiping_address,
                                    'payment_details'=>$payment_info
                                    
                                ];
                               if(!empty($insert)){
                    DB::table('orders')->insert($insert);   
                 
                           } 
            }
            else{
                $user=User::firstOrNew(array('email' => $request->customer_email));
                $user->name=$request->customer_name;
                $user->email=$request->customer_email;
                $user->address=$request->customer_address;
                $user->save();
                $insertedId = $user->id;

                             $insert[]=
                                [
                                    'user_id'=>  $insertedId,
                                    'total_price'=>Cart::total(),
                                    'order_details'=>$order_details_final,
                                    'shiping_address'=> $shiping_address,
                                    'payment_details'=>$payment_info
                                    
                                ];
                                if(!empty($insert)){
                    DB::table('orders')->insert($insert);   
                 
                           }  

            }
            Cart::destroy();
            return Redirect::to('/thankyou');

    }
    

    public function checkout(Request $request)
    {
      
         $currentUser = app('Illuminate\Contracts\Auth\Guard')->user();

         $tracking_number = Session::getId(); 
         $total_price = DB::table('Temp_orders')->where('tracking_number',$tracking_number)->sum('product_total_price');
        
         $order_model = new order();

         $order_model->customer_name = $currentUser->name;
         $order_model->address = $request->customer_address;
         $order_model->phone = $request->customer_phone;
         $order_model->bikas_number = $request->bikash_number;
       
         $order_model->tracking_number = $tracking_number;
         $order_model->total_price = $total_price;

         $order_model->created_at = date('Y-m-d H:i:s');
         
         $order_model->save();



     return Redirect::to('/thankyou');
     
    }


    public function checkoutWithregistration(Request $request)
    {
     $tracking_number = Session::getId(); 
     $total_price = DB::table('Temp_orders')->where('tracking_number',$tracking_number)->sum('product_total_price');
    
     $order_model = new order();

     $order_model->customer_name = $request->customer_name;
     $order_model->address = $request->customer_address;
     $order_model->phone = $request->customer_phone;
   
     $order_model->tracking_number = $tracking_number;
     $order_model->total_price = $total_price;

     
     $order_model->save();


     return Redirect::to('/thankyou');
     
    }


    public function test()
    {

    	 $value = session()->get('tracking_number');
    	 echo $value;
    	exit();
    }
}
