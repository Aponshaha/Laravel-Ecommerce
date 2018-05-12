<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
//use validator;
//use Illuminate\Support\Facades\Validator; 

class CouponController extends Controller {
    //
    public function __construct()
    {
        $this->middleware('admin-auth');
    }
    
    public function index() {
        $data['coupons_list'] = '';
       return view('admin.coupon.home', ['data'=>$data]);
    }


    public function create() {
        $data['coupons_list'] = '';
        return view('admin.coupon.home', ['data'=>$data]);
    }

      
}
