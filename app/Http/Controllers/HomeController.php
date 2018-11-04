<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Session;
use DB;

class HomeController extends Controller
{
    //
	
	function index()
	{	
	    if (! session()->has('tracking_number')) {
            session()->put('tracking_number', Session::getId());
        }
		//$data['ratings']=DB::table('product_ratings')->get();          
		$data['featured_products'] =  \App\Models\Product::where('is_featured', '=', 1)->orderBy('product_row_id', 'desc')->take(3)->get();	
		$data['latest_products'] =  \App\Models\Product::where('is_latest', '=', 1)->orderBy('product_row_id', 'desc')->take(3)->get();	
		$data['products'] =  \App\Models\Product::where([ ['is_latest', 0], ['is_featured', 0] ])->orderBy('product_row_id', 'desc')->take(8)->get();
		return view('welcome', ['data'=>$data]);	
		
	}
	
	function categoryWiseProducts($category_slug)
	{	

		$data['ratings']=DB::table('product_ratings')->get();
		$info = DB::table('categories')->where('category_slug', $category_slug)->first();
		$category_row_id = $info->category_row_id;		
		$data['category_name'] = $info->category_name;	
		$data['products'] =  DB::table('products')->where('category_row_id',$category_row_id)->orderBy('product_row_id', 'desc')->get();	
		return view('category_wise_products', ['data'=>$data]);	
		
	}
	
	function search($product_name, $category_row_id)
	{			
		$info = DB::table('categories')->where('category_slug', $category_slug)->first();
		$category_row_id = $info->category_row_id;		
		$data['category_name'] = $info->category_name;
		$data['products'] =  DB::table('products')->orderBy('product_row_id', 'desc')->get();			
		return view('category_wise_products', ['data'=>$data]);			
	}
	
	
	
	function productDetails($id)
	{
		//$data['rating']= round(DB::table('product_ratings')->where('product_id','=',$id)->avg('rating'));
		//$data['ratings']=DB::table('product_ratings')->get();
		//$data['related_products']=DB::table('products')->where('category_row_id', '=', $data['single_info']->category_row_id)->get();
		
		$data['products'] =  DB::table('products')->where('is_featured', '=', 0)->orderBy('product_row_id', 'desc')->take(6)->get();	
		$data['single_info'] = DB::table('products')->where('product_row_id', '=', $id)->first();	
		//dd($data['single_info']);
		
		return view('product_details', ['data'=>$data]);	
		
	}
	
	
}
