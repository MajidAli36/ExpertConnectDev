<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use ServerUrl;
use Helpers;
use Utilities;
use Session;
use DateTime;

use App\Models\SinchTicketGenerator;



class VideoChatController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
      public function index()
    {
        $emailExpert = Session::get('userEmail');
        //return view('testvideocall/test', $emailExpert);
        return view('testvideocall/test')->with('emailExpert', $emailExpert);
    }


    public function authenticate(Request $request)
    {

      $un=Session::get('userId');
      $type=Session::get('userType');
      $token=Session::get('token');
      $username=Session::get('username');

/*
      $obj=[
        "username1"=>$username,
        "username"=>$un,
        "type"=>$type,
        "token"=>$token
        ];
*/
        $message="Relogin to continue";
        if ($username==null){
          return $message;
        }
        //appkey, secretkey
        $generator = new SinchTicketGenerator('1e3db903-6bf4-468d-8647-73009708ccc2', '0/3lw7JLYEaEd1Lhf7kBIw==');
        $obj=["userTicket"=>$generator->generateTicket($username,new DateTime(),3600)
        ];

      //print_r($un,$pw,$token);
      return $obj;

      /*
        if(Helpers::validateSession($redirect = false,$message = "",$url = "") == true) return  redirect('dashboard');

        $this->validate($request,[
                        'email' => 'required|min:6|email',
                        'password' => 'required'
                        ]);

        $requestArr = array('user_email'=>$request->email,'user_password'=>Helpers::encryptPassword($request->password));
        $extraHeader = array("os"=> \ServerUrl::COMMON_HEADER);
        $response = Helpers::sendCallApi('POST',ServerUrl::POST_LOGIN, $requestArr,  $isAjax = false, $isJson=true,$extraHeader);

        print_r($response);

        return $response;

        */

    }



}
