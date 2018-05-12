<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;


use App\Models\Category;
use App\Models\Common;
use Illuminate\Support\Facades\Input;

use Session;
use DB;
use Validator;

class CategoryController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('admin-auth');
    }
	public function index()
    {                             
      $common_model = new Common();  
	  $data['all_records'] = $common_model->allCategories();      
	  return view('admin.category.index', ['data'=>$data]);
        //   
    }
	
	function create()
	{
     $common_model = new Common();       
	 $data['all_records'] = $common_model->allCategories();     
	 return view('admin.category.create', ['data'=>$data]);
	   
	}
	
	public function store(Request $request)
    {
	
	
	
			
			
	  $postData = Input::all();
    // setting up custom error messages for the field validation
     $messages = [
         'category_name.required' => 'Enter email address',
       
     ];
    $rules = [
      'category_name' => 'required',
      
    ];

    // doing the validation, passing post data, rules and the messages
    $validator = Validator::make($postData, $rules, $messages);
    if ($validator->fails()) {
      // send back to the page with the input data and errors
      return Redirect::to('/admin/categories/create')->withInput()->withErrors($validator);
    }
	
		
		
	
	$data  =  Input::except(array('_token')) ;
	$rule  =  array(
                'category_name'       => 'required',
               
                   ) ;
    $validator = Validator::make($data,$rule);
    if ($validator->fails())
    {
    $messages = $validator->messages();
    //return Redirect::to('/admin/categories/create')->with('message', 'Register Failed');
	return Redirect::back()->witherrors($validator);

    }
    else
    {
	}
      // validation
        $this->validate($request, [
            'category_name' => 'required',
            'parent_id' => 'required',
        ]); 
     
     
        $category_model = new Category();
        $category_model->category_name = $request->category_name;  
        $category_model->parent_id = $request->parent_id;   
        
       
        // get level,  level = parent level + 1.
        $category_model->level = 0;
        if($category_model->parent_id)
        {
          $parent_cat_info =   DB::table('categories')->where('category_row_id',$category_model->parent_id)->first(); 
          $category_model->level = $parent_cat_info->level + 1;
        }                
                
        $category_model->save();
        
        
         // update parent has_child status 
        if($category_model->parent_id)
        {
           if($parent_cat_info->has_child != 1)
           { 
               DB::table('categories')
                ->where('category_row_id', $request->parent_id)
                ->update([
                  'has_child'=> 1
                ]);
           }
        }       
                  
        
      
      Session::flash('success-message', 'Successfully Performed !');        
      return Redirect::to('/admin/categories');
      //save
      
	
	}
	public function edit($id)
    {
        $common_model = new Common();       
        $data['all_records'] = $common_model->allCategories();     
        $data['single_info'] = DB::table('categories')->where('category_row_id', $id)->first(); 
        return view('admin.category.edit', ['data'=>$data]);
	
	}
	public function update(Request $request)
    {
         // validation
        $this->validate($request, [
            'category_name' => 'required',
            'parent_id' => 'required',
        ]);
       
       
        $category_model = new Category();

        
        // check whether is it for edit
        if( !$request->category_row_id) {          
            return false;           
        }
      
        // receive all post values. 
        $category_model = $category_model->find($request->category_row_id); // edit operation.
        $category_model->category_name = $request->category_name;  
        $category_model->parent_id = $request->parent_id;   
        
        // parent changed ? 
        $parent_id_changed = 0;
        $prev_parent_id = DB::table('categories')->where('category_row_id', $request->category_row_id)->first()->parent_id;
        if($request->parent_id != $prev_parent_id) {
        $parent_id_changed = 1;
        }
        
       
        // get level,  level = parent level + 1.
        $category_model->level = 0;
        if($category_model->parent_id)
        {
          $parent_cat_info =   DB::table('categories')->where('category_row_id',$category_model->parent_id)->first(); 
          $category_model->level = $parent_cat_info->level + 1;
        }                
                
                
        $category_model->save();
        
         
        // update has_child status of present parent         
        if($category_model->parent_id)
        {
           if($parent_cat_info->has_child != 1)
           { 
               DB::table('categories')
                ->where('category_row_id', $request->parent_id)
                ->update([
                  'has_child'=> 1
                ]);
           }
        } 
        
        // update  has_child status of previous parent 
        if($parent_id_changed)
        {            
           
           if( !DB::table('categories')->where('parent_id', $prev_parent_id)->count())
           {
           
           DB::table('categories')
                ->where('category_row_id', $prev_parent_id)
                ->update([
                  'has_child'=> 0
                ]);
           }      
        } 
      
      Session::flash('success-message', 'Successfully Performed !');        
      return Redirect::to('/admin/categories');
	
	}
    
    public function deleteRecord($id)
    {
       if( !$id ) { 
        return false;
       }
       
       // main category Cannnot be deleted if it has child
       $has_child = DB::table('categories')->where('category_row_id', $id)->where('has_child', 1)->first();
       if($has_child) {           
        return false;
       }                             
       
       $parent_id = DB::table('categories')->where('category_row_id', $id)->first()->parent_id;                                                
       DB::table('categories')->where('category_row_id', $id)->delete(); 
       
       // has child of status of parent id.
        
       if($parent_id) {
        if( !DB::table('categories')->where('parent_id', $parent_id)->count()) {
           DB::table('categories')
                ->where('category_row_id', $parent_id)
                ->update([
                  'has_child'=> 0
                ]);
           }      
       }  
       
       
       Session::flash('success-message', 'Successfully Performed !');        
       return Redirect::to('/admin/categories');
    }
    
    
}
