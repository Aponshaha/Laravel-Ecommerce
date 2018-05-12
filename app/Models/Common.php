<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB; 
use Illuminate\Support\Facades\Input;
use Image;   

class Common extends Model
{
   
  
    public  $output = array();
   
     /**
      RETRIEVE ALL CATEGORY WITH CHILD.
     */
    
    
	public function allCategories()
    {     	
        $result =  Category::all();         
        $this->output = array();
        foreach($result as $category)
        {
            
            if($category->parent_id == 0)
            {
                
                $this->prod_count = 0;
                if($category->has_child)
                {
                    $this->output[] = $category;
                    $this->setChildren($result, $category->category_row_id);
                }
                else
                {                    
                    $this->output[] = $category;
                }
            }
        }

        $output = $this->output;       
        $this->output = array();
        return $output;
    } 
    
   function setChildren($haystack, $parentCategoryId)
    {  
        if( count($haystack))
        {  
            foreach($haystack as $category)
            {
                if($category->parent_id && $category->parent_id== $parentCategoryId)
                {
                  if($category->has_child)
                    {   
                                         
                    $this->output[] = $category;
                    $this->setChildren($haystack, $category->category_row_id);
                    }
                    else
                    {                  
                    $this->output[] = $category;
                    }
                }
            }
        }
    }
    
  public function parentCategories( $featured = 0)
  {
       $matchThese = ['parent_id' => 0, 'is_featured' =>$featured ];
       return Category::where($matchThese)->get();  
      
  }  
   
   function uploadImage($fileInputField, $uploadFolder = 'uploads')
   {            
            
		$uploadedFileName = '';               
		if (Input::file($fileInputField)) 
		{                   
			$fileInfo = Input::file($fileInputField);
			$uploadedFileName = time() . '.' . $fileInfo->getClientOriginalExtension();
			$upload_path = public_path($uploadFolder);            
			$upload_thumb_path = public_path($uploadFolder . '/thumbs');            
			$fileInfo->move($upload_path, $uploadedFileName);
			Image::make($upload_path . '/' . $uploadedFileName)->resize(250,500)->save($upload_thumb_path . '/' . $uploadedFileName);
		}        
		return $uploadedFileName; 
        
   } 
   
   
   // menu
   public function allMenu()
    {         
        $result = Menu::all()->where('is_active', 1); 
                
        $this->output = array();
        foreach($result as $menu)
        {
          
           if($menu->parent_id == 0)
            {   
                if($menu->has_child)
                {
                    $this->output[] = $menu;
                    $this->setSubMenu($result, $menu->menu_row_id);
                }
                else
                {                    
                    $this->output[] = $menu;
                }
            }
        }

        $output = $this->output;       
        $this->output = array();   
        return $output;
    } 
    
   function setSubMenu($haystack, $parentMenuId)
    {  
       
        if( count($haystack))
        {  
           
            foreach($haystack as $menu)
            {
               
                if($menu->parent_id && $menu->parent_id== $parentMenuId)
                {
                  if($menu->has_child)
                    {   
                                         
                    $this->output[] = $menu;
                    $this->setSubMenu($haystack, $menu->menu_row_id);
                    }    
                    else
                    {                  
                    $this->output[] = $menu;
                    }
                }
            }
        }
    }
    
   
   
                                       
}

