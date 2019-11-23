<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';
    // protected $username = 'username';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest');
    }

    public function passchangeform(){
    if (Auth::check()) 
     {
        return view('loggedinuser.changepassword');
     }else {
        return redirect('login')->with('message','Please login first');
     }
    }
 
    public function changePassword(Request $request){
    if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
    // The passwords matches
    return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
    }

    if(strcmp($request->get('current-password'), $request->get('password')) == 0){
    //Current password and new password are same
    return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
    }
    $validatedData = $request->validate([
    'current-password' => 'required',
    'password' => 'required|string|min:6|confirmed',
    ]);
    //Change Password
    $user = Auth::user();
    $user->password = $request->get('password');
    $user->save();
    return redirect()->back()->with("success","Password changed successfully !");
    }

    public function update(Request $request)
    {
        // Validate the new password length...
        $request->user()->fill([
            'password' => Hash::make($request->password)
        ])->save();
    }
   
    // public function username()
    // {
    //         return 'username';
    // }

}
