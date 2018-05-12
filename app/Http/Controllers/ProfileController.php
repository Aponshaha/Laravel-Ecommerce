<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Order;
use Auth;
use App\User;
use DB;
use Hash;
use App\Models\WishList;
class ProfileController extends Controller
{
    public function __construct()
    {        
	
      $this->middleware('auth');
       
    }

    public function myAccount()
    {
    	$data['my-orders']=Order::get()->where('user_id',Auth::user()->id);
    	return view('user.my-account',['data'=>$data]);
    }

    public function myOrders()
    {
    	$data['my-orders']=Order::get()->where('user_id',Auth::user()->id);
    	return view('user.my-orders',['data'=>$data]);
    }
    public function myPendingOrders()
    {
    	$data['my-orders']=Order::get()->where('user_id',Auth::user()->id);
    	return view('user.my-pending-order',['data'=>$data]);
    }
    public function showUpdateProfileForm()
    {
        return view('user.update-profile');
    }




     public function showResetPasswordForm()
    {
        return view('user.change-password');
    }
  public function resetPassword(Request $request) {
       

    if (Hash::check($request->old_password, Auth::user()->password)) {
      
      $user=Auth::user();
      $user->password= bcrypt($request->password);
      $user->save();
      return redirect('/my-account');
  }
  else
  {    
         return back();
  }
        
    }

   public function myWishList()
   {
     $data['my-wishlist']=DB::table('wish_lists as w')
     ->join('products as p', 'w.product_id', '=', 'p.product_row_id')->where('user_id',Auth::user()->id) 
      ->select('p.*')
      ->get();
      return view('user.my-wishlist',['data'=>$data]);
   }

   public function addToWishList($product_id)
   {
    
     $wishlist=WishList::firstOrCreate(array('product_id' => $product_id,'user_id'=>Auth::user()->id));
     $wishlist->product_id=$product_id;
     $wishlist->user_id=Auth::user()->id;
     $wishlist->save();
     return back();

   }

   public function giveRating($product_id,$rating)
    {

  DB::table('product_ratings')->insert(
    ['rating' => $rating, 'user_id' => Auth::user()->id,'product_id'=>$product_id]
);
      // $rating=new ProductReview();
      // $rating->rating=$rating;
      // $rating->product_id=$product_id;
      // $rating->user_id=Auth::user()->id;
      // $rating->save();
      return back()->with('rating','Thanks!!');;
    }

    public function emailProductToFriend(Request $request)
    {
      try {
         mail($request->email, 'Recommand For you', $request->message.'  '.$request->product_url);
         return back();
      } catch (Exception $e) {
        
      }
    }
}
