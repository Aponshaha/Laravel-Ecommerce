<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
//use validator;
//use Illuminate\Support\Facades\Validator; 

class LoginController extends Controller {
    //
    public function __construct() {
	
	     
    }
    
    public function login() {  
                      
        
       return view('admin.login');
    }
    
    function postAdminLogin(Request $request) {
       $credential = ['email' => $request->email, 'password' => $request->password ];    
      
       // validator
       
        if( Auth()->guard('admins')->attempt($credential) ) {           
            return redirect('/admin/dashboard');
        }
        else {                               
            return redirect('/admin')
                   ->withErrors(['errors', 'Admin Credentail do not match'])
                   ->withInput();           
        }
    }  
    
    function logout() {        
        Auth()->guard('admins')->logout();
        return redirect('/admin');  
    }
      
}
