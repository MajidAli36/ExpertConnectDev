<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\Mail\VerifyEmail;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Controllers\Auth\Mail;

use Helpers;
use ServerUrl;
use Utilities;


class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('guest');
    }


    public function sendResetLinkEmail(Request $request)
    {
        $this->validate($request, ['useremail' => 'required'], ['useremail.required' => 'Please enter your useremail.']);
        
        $data = array();
        $data['user_email'] = $_POST['useremail'];
        $response = Helpers::sendCallApi("POST",ServerUrl::FORGET_PASSWORD, $data , $isAjax = true, $isJson = true, array("os"=> ServerUrl::COMMON_HEADER));
        
        if ($response && $response->success) {
              return redirect('login')->with('status', trans($response->message));
        }else{
            return redirect('login')->with('message', trans($response->message));
        }
    }

    public function showLinkRequestForm(){
        return view('auth.forgetPassword');
    }

    public function verify(){
        if(!isset($_GET['token'])){
            return redirect('login');
        }
        return view('auth.verifyforgetPassword');
    }
    public function verify_reset_token(){
        $data = array();
        $data['password'] = Helpers::encryptPassword($_POST['password']);
        $data['confirmPassword'] = Helpers::encryptPassword($_POST['confirmPassword']);
        $data['token'] = $_POST['token'];
        if(empty($data['token']) || empty($data['token']) || empty($data['token'])){
            return redirect('login')->with('message', trans('Invalid Token'));
        }
        $response = Helpers::sendCallApi("POST",ServerUrl::FORGET_PWD_TKN_VERIFY, $data , $isAjax = true, $isJson = true, array("os"=> ServerUrl::COMMON_HEADER));
        if ($response && $response->success) {
            return redirect('login')->with('status', trans('Password Reset Succesfully'));
        }else{
            return redirect('login')->with('message', trans($response->message));
        }
    }
}