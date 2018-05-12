<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\File;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

use App\Models\Common;
use App\Models\Menu;

use Session;
use DB;


class MenuController extends Controller
{
    //
	public function __construct()
    {                                        
        $this->middleware('admin-auth');
    }
	
	public function index()
    {             
      $common_model =  new Common();                                               	                       
      $data['all_records'] =DB::table('menus')->where('link_dynamic', 1)->limit(8)->get();
      // dd( $data['all_records']);     
	  return view('admin.menu.index', ['data'=>$data]);
        //   
    }
	
    function create()
    {
     $common_model = new Common();       
     $data['all_records'] = $common_model->allMenu();         
     return view('admin.menu.create', ['data'=>$data]);
       
    }
    
    public function store(Request $request)
    {
      // validation
     
        $this->validate($request, [
            'menu_name' => 'required',
            'parent_id' => 'required',
        ]); 
       
     
        $menu_model = new Menu();
        $menu_model->menu_name = $request->menu_name;  
        $menu_model->menu_content = $request->menu_content; 
        $menu_model->parent_id = $request->parent_id;  
		$menu_model->menu_link = str_slug($request->menu_name, '-');		
		$menu_model->link_dynamic = 1;   
		
        
            
        // get level,  level = parent level + 1.
        $menu_model->level = 0;       
        if($request->parent_id)
        {
          $parent_menu_info =   DB::table('menus')->where('menu_row_id',$request->parent_id)->first(); 
          $menu_model->level = $parent_menu_info->level + 1;
        }
        $menu_model->save();
        
        
         // update parent has_child status 
        if($request->parent_id)
        {
           if($parent_menu_info->has_child != 1)
           { 
               DB::table('menus')
                ->where('menu_row_id', $request->parent_id)
                ->update([
                  'has_child'=> 1
                ]);
           }
        }       
                  
        
      
      Session::flash('success-message', 'Successfully Performed !');        
      return Redirect::to('/admin/menus');
      //save
      
    
    }
    public function edit($id)
    {
        $common_model = new Common();       
        $data['all_records'] = $common_model->allMenu();     
        $data['single_info'] = DB::table('menus')->where('menu_row_id', $id)->first();
        return view('admin.menu.edit', ['data'=>$data]);
    
    }
    public function update(Request $request)
    {
         // validation
        $this->validate($request, [
            'menu_name' => 'required',
            'parent_id' => 'required',
        ]); 
       
     
        $menu_model = new Menu();
          
        
        if($request->menu_row_id)
        {          
           $menu_model = $menu_model->find($request->menu_row_id);
        }
        
       $menu_model->menu_name = $request->menu_name; 
       $menu_model->menu_content = $request->menu_content; 
       $menu_model->parent_id = $request->parent_id;  
	   $menu_model->menu_link = str_slug($request->menu_name, '-');
	   $menu_model->link_dynamic = 1;   
        
       // parent changed ? 
        $parent_id_changed = 0;
        $prev_parent_id = DB::table('menus')->where('menu_row_id', $request->menu_row_id)->first()->parent_id;
        if($request->parent_id != $prev_parent_id) {
        $parent_id_changed = 1;
        }
        
        // get level,  level = parent level + 1.
         $menu_model->level = 0;       
        if($request->parent_id)
        {
          $parent_menu_info =   DB::table('menus')->where('menu_row_id',$request->parent_id)->first(); 
          $menu_model->level = $parent_menu_info->level + 1;
        }
        $menu_model->save();
        
        
         // update parent has_child status 
        if($request->parent_id)
        {
           if($parent_menu_info->has_child != 1)
           { 
               DB::table('menus')
                ->where('menu_row_id', $request->parent_id)
                ->update([
                  'has_child'=> 1
                ]);
           }
        } 
        
        if($parent_id_changed)
        {            
           
           if( !DB::table('menus')->where('parent_id', $prev_parent_id)->count())
           {
           
           DB::table('menus')
                ->where('menu_row_id', $prev_parent_id)
                ->update([
                  'has_child'=> 0
                ]);
           }      
        } 
      
      Session::flash('success-message', 'Successfully Performed !');        
      return Redirect::to('/admin/menus');
    
    }
    
    public function deleteRecord($id)
    {
       if( !$id ) { 
        return false;
       }
       
       // main menu Cannnot be deleted if it has child
       $has_child = DB::table('menus')->where('menu_row_id', $id)->where('has_child', 1)->first();
       if($has_child) {           
        return false;
       }
       
       $parent_id = DB::table('menus')->where('menu_row_id', $id)->first()->parent_id;                                          
       DB::table('menus')->where('menu_row_id', $id)->delete(); 
       
        if($parent_id) {
        if( !DB::table('menus')->where('parent_id', $parent_id)->count()) {
           DB::table('menus')
                ->where('menu_row_id', $parent_id)
                ->update([
                  'has_child'=> 0
                ]);
           }      
       }  
       
       Session::flash('success-message', 'Successfully Performed !');        
       return Redirect::to('/admin/menus');
    }
    
    
}
