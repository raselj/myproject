<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Admincontroller extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    // view for admin dashboard
    public function adminview(){
        $notification = array(
            'message' => 'you are logged successfully!', 
            'alert-type' => 'success'
        );
        return view('admin.dashboard')->with($notification); // write the admin dashboard view Rasel
    }

    // view for admin dashboard
    public function logout(){
        Auth::logout(); // write the admin dashboard view Rasel
        $notification = array(
            'message' => 'you are logout!', 
            'alert-type' => 'success'
        );
        return redirect()->route('login')->with($notification);
    }

    // password Change here controller
    public function passwordChange(){
        return view('admin.profile.password_change');
    }

    // password update here controller

    public function passwordUpdate(Request $request){
        $validated = $request->validate([
            'email' => 'required',
            'old_password' => 'required',
            'password'=> 'required|min:6|confirmed',
            'password_confirmation' =>'required|same:password',
        ]);

        $oldpass = $request->old_password;
        $password = $request->password;

        $cureent_password = Auth::user()->password;

        if(Hash::check($oldpass, $cureent_password)){
            $user = User::findorfail(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            $notification = array(
                'message' => 'Password Changed Successfully!', 
                'alert-type' => 'success'
            );
            return redirect()->route('login')->with($notification); // write the admin dashboard view Rasel
        }else{
            $notification = array(
                'message' => 'Password Not Matched!', 
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification); // write the admin dashboard view Rasel
        }
   

    }

}
