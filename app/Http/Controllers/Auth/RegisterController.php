<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Auth;
use Socialite;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

        public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleFacebookCallback()
    {
      $user = Socialite::driver('facebook')->stateless()->user();
      $exits= \App\User::where('email',$user->getEmail())->first();
      //echo $exits->email;
//      echo $user->getId(); echo "<br>";
//      echo $user->getNickname();echo "<br>";
//      echo $user->getName();echo "<br>";
//      echo $user->getEmail();
//      
     // $this->create($user);

        if($exits)
        {
            if (Auth::attempt(['email' => $user->getEmail(), 'password' => '1111111'])) {
            // Authentication passed...
            return redirect()->intended('/');
        }
        }
        else
        {
        
             User::create([
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password' => bcrypt('1111111')
            
        ]);
       
        if (Auth::attempt(['email' => $user->getEmail(), 'password' => '1111111'])) {
            // Authentication passed...
          return redirect()->intended('/');
        
        }
        }
      
    }



     public function redirectToGithub()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleGithubCallback()
    {
      $user = Socialite::driver('github')->stateless()->user();
      $exits= \App\User::where('email',$user->getEmail())->first();
      //echo $exits->email;
//      echo $user->getId(); echo "<br>";
//      echo $user->getNickname();echo "<br>";
//      echo $user->getName();echo "<br>";
//      echo $user->getEmail();
//      
     // $this->create($user);

        if($exits)
        {
            if (Auth::attempt(['email' => $user->getEmail(), 'password' => '1111111'])) {
            // Authentication passed...
            return redirect()->intended('/');
        }
        }
        else
        {
        
             User::create([
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password' => bcrypt('1111111')
            
        ]);
       
        if (Auth::attempt(['email' => $user->getEmail(), 'password' => '1111111'])) {
            // Authentication passed...
          return redirect()->intended('/');
        
        }
        }
      
    }

     public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
      $user = Socialite::driver('google')->stateless()->user();
      $exits= \App\User::where('email',$user->getEmail())->first();
      //echo $exits->email;
//      echo $user->getId(); echo "<br>";
//      echo $user->getNickname();echo "<br>";
//      echo $user->getName();echo "<br>";
//      echo $user->getEmail();
//      
     // $this->create($user);

        if($exits)
        {
            if (Auth::attempt(['email' => $user->getEmail(), 'password' => '1111111'])) {
            // Authentication passed...
            return redirect()->intended('/');
        }
        }
        else
        {
           
           // $dummy_password=str_random(8);
             User::create([
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password' => bcrypt('1111111'),
           
        ]);
       
        if (Auth::attempt(['email' => $user->getEmail(), 'password' => '1111111'])) {
            // Authentication passed...
           return redirect()->intended('/');
        
        }
        }
      
    }

    //--------------------Login wiht twitter------------
     public function redirectToTwitter()
    {
        return Socialite::driver('twitter')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleTwitterCallback()
    {
      $user = Socialite::driver('twitter')->user();
      $exits= \App\User::where('email',$user->getEmail())->first();
      //echo $exits->email;
//      echo $user->getId(); echo "<br>";
//      echo $user->getNickname();echo "<br>";
//      echo $user->getName();echo "<br>";
//      echo $user->getEmail();
//      
     // $this->create($user);

        if($exits)
        {
            if (Auth::attempt(['email' => $user->getEmail(), 'password' => '1111111'])) {
            // Authentication passed...
            return redirect()->intended('/');
        }
        }
        else
        {
            
             User::create([
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password' => bcrypt('1111111'),
            
        ]);
       
        if (Auth::attempt(['email' => $user->getEmail(), 'password' => '1111111'])) {
            // Authentication passed...
        return redirect()->intended('/');
        
        }
        }
      
    }
}
