<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
class CommonController extends Controller
{
   
    
    public function login(Request $request)
    {
        //$user= User::where(['email' => $request->email, 'password' => $request->password])->first();
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Authentication passed...
           return redirect('/checkoutPage');
        
        }
      
    }

    public function showRegistrationForm()
    {
        return view('auth.custom-register');
    }
    public function register(Request $request)
    {

             User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            ]);

    	 if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Authentication passed...
           return redirect('/checkoutPage');
        
        }
    }
}
