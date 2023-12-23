<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // custom login controller

    public function login(Request $request){
       
        // for validation Rasel
        $input = $request->all();
        $this->validate($request,[
            'email'=> 'required|email',
            'password'=>'required'
        ]);

        // for authentication Rasel
        if(Auth()->attempt(array('email'=>$input['email'], 'password'=>$input['password']))){
            
            // For admin login
            if(auth()->user()->role=="admin"){
                return redirect()->route('admin.dashboard')->with('status', 'Admin Login successfull!');
            }
            else{
                return redirect()->route('login')->with('error', 'Please login first!');
            }

            // For user login
            if(auth()->user()->role=="user"){
                return redirect()->route('home')->with('status', 'User Login successfull!');
            }
            else{
                return redirect()->route('login')->back('error', 'Please login first!');
            }


        }else{
            return redirect()->route('login')->with('error', 'Enter Your Correct Email Or Password');
        }
    }
 
}
