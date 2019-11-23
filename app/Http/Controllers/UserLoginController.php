<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\VerifyUser;

use Helpers;
use ServerUrl;
use Utilities;

use Socialite;
use Google_Client;
use Google_Service_People;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Session;
use App\Mail\VerifyMail;
use pp\Http\Controllers\loggedinuser\AjaxController;
use Illuminate\Support\Facades\Log;

//mail
use Mail;
use App\Mail\welcomeMail;


class UserLoginController extends Controller
{
    private $base_url;
    public function __construct()
    {
        $this->base_url = ServerUrl::BASE_URL.'/ExpertConnect/v2';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Helpers::validateSession($redirect = false,$message = "",$url = "") == true)
              return  redirect('dashboard');

        Log::debug("In LOGIN");
        if (!empty($_SERVER['HTTP_REFERER'])){
          Log::debug($_SERVER['HTTP_REFERER']);
          $contains = str_contains($_SERVER['HTTP_REFERER'], 'register');
          if (!$contains)
            Session::flash('backUrl', $_SERVER['HTTP_REFERER']);
          }

          if ($url = Session::get('SubscripitonUrl')) {
            Log::debug($url);
            Session::flash('backUrl', $url);
          }


          Log::debug("Redirect to login view");


        return view('auth.login');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Session::flush();
        return redirect('/login');
    }
    public function makeLogin(Request $request)
    {
        if(Helpers::validateSession($redirect = false,$message = "",$url = "") == true) return  redirect('dashboard');

        $this->validate($request,[
                        'email' => 'required|min:6|email',
                        'password' => 'required'
                        ]);

        $requestArr = array('user_email'=>$request->email,'user_password'=>Helpers::encryptPassword($request->password));
        $extraHeader = array("os"=> \ServerUrl::COMMON_HEADER);
        $response = Helpers::sendCallApi('POST',ServerUrl::POST_LOGIN, $requestArr,  $isAjax = false, $isJson=true,$extraHeader);
        // exit(json_encode($response));


        if(!empty($response))
        {
            if($response->success == false)
            {
                    $status_code = $response->status_code;
                    $message = $response->message;

                        return redirect('login')->with('message',$message);

                        exit();

            }else{
                $userId = $response->data->id;
                $userType = $response->data->user_type;
                $token = $response->data->token;
                $useremail=$request->email;

                Session::put('token', $token);
                Session::put('userId', $userId);
                Session::put('userType', strtolower($userType));
                Session::put('username',strtolower($useremail));
                
            }
        }

        if(isset($userType)){
            if(strtolower($userType) =="user"){
                if(isset($userId) && !empty($userId))
                {
                    $userDetails = Utilities::getUserProfile($userId);
                    if(isset($userDetails->success) && $userDetails->success == true )
                    {
                        Session::put('userprofile', $userDetails);
                        $url = Session::get('backUrl');
                        if ($url!=null){
                            $contains = str_contains($url, 'videolib') || str_contains($url, 'category');
                            if ($contains && !$this->isSubscribed())
                              $url = "/subscription";
                        }
                        return ($url!=null) ? redirect($url) : redirect('dashboard');
                    }
                }
            }else{
                if(!empty($userId))
                {
                    $userDetails = Utilities::getUserProfile($userId,'expert');
                    // echo json_encode($userDetails);
                    // exit();
                    if(Helpers::setExpertLoginProfile($userDetails))
                    {
                        return redirect('expert-dashboard');
                    }else{
                        return redirect('login')->with('message','Somthing went wrong. Please try after some time.');
                    }
                }
            }
        }else{
            return redirect('login')->with('message','Somthing went wrong. Please try after some time.');
        }



    }
    public function facebook_login(){
        if(Helpers::validateSession($redirect = false,$message = "",$url = "") == true)
        return  redirect('dashboard');

        return Socialite::driver('facebook')->redirect();
    }
    public function facebook_callback(){
        if(Helpers::validateSession($redirect = false,$message = "",$url = "") == true)
        return  redirect('dashboard');

        $user = Socialite::driver('facebook')->user();
        $request=array();
        $request['accessToken'] = $user->token;
        $request['type'] ='facebook';
        $data = Helpers::sendCallApi("POST",ServerUrl::SOCIAL_LOGIN,  $request , $isAjax = true, $isJson = true, array("os"=> ServerUrl::COMMON_HEADER));
        if($data->success){
            Session::put('userId', $data->data->id);
            Session::put('userType', $data->data->user_type);
            $userDetails = Utilities::getUserProfile($data->data->id);
            if(isset($userDetails->success) && $userDetails->success == true )
            {
                Session::put('userprofile', $userDetails);
                return redirect('dashboard');
            }else{
                return redirect('login');
            }
        }else{
            return redirect('login');
        }
    }
    public function google_login(){
        if(Helpers::validateSession($redirect = false,$message = "",$url = "") == true)
        return  redirect('dashboard');

        return Socialite::driver('google')
        ->scopes(['openid', 'profile', 'email'])
        ->redirect();
    }
    public function google_callback(){
        if(Helpers::validateSession($redirect = false,$message = "",$url = "") == true)
        return  redirect('dashboard');

        $user = Socialite::driver('google')->user();
        $request=array();
        $request['accessToken'] = $user->token;
        $request['type'] ='google';
        // echo (json_encode($request));
        $data = Helpers::sendCallApi("POST",ServerUrl::SOCIAL_LOGIN,  $request , $isAjax = true, $isJson = true, array("os"=> ServerUrl::COMMON_HEADER));
        // exit(json_encode($data));
        if($data->success){
            Session::put('userId', $data->data->id);
            Session::put('userType', $data->data->user_type);
            $userDetails = Utilities::getUserProfile($data->data->id);
            // exit(json_encode($userDetails));
            if(isset($userDetails->success) && $userDetails->success == true )
            {
                Session::put('userprofile', $userDetails);
                return redirect('dashboard');
            }else{
                return redirect('login');
            }
        }else{
            return redirect('login');
        }
    }



    public function dashboard(){
        $userProfile = Session::get('userprofile');
        if(!empty($userProfile))
        {

            return view('Users.dashboard');
        }
        else
        {
            return redirect('login');
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Helpers::validateSession($redirect = false,$message = "",$url = "") == true)
        return  redirect('dashboard');

         $this->validate($request,[
//                        'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
//                        'password_confirmation'=>'min:6',
                        'firstname' => 'required|alpha|min:2|max:255',
                        'lastname' => 'required|alpha|min:2|max:255',
                        'user_gender'=> 'required|in:male,female',
                        'user_contactno' => 'required|digits:10',
                        'user_email' => 'required|email',
//                        'user_dob' => 'nullable|date_format:Y-m-d|before:today',
                        ]);
        $name = $request->input('firstname');
        $lname = $request->input('lastname');
        $dob = $request->input('user_dob');
        $email = $request->input('user_email');
        $gender = $request->input('user_gender');
        $user_contactno = $request->input('user_contactno');
        $pass = $request->input('user_password');
        $cpass = $request->input('password_confirmation');
        $requestArr =  array(
                'firstname' => $name,
                'lastname' => $lname,
                'user_dob' => $dob,
                'user_email' =>$email,
                'user_gender' =>$gender,
                'user_contactno' =>$user_contactno,
                'user_password' =>Helpers::encryptPassword($pass)
             );
            // echo "<script>console.log(".json_encode($requestArr).")</script>";

        if($pass !== $cpass)
        {
               return redirect('register')->with('message','Please enter password and confirm password same.');
               exit();
        }

        $extraHeader = array("os"=> \ServerUrl::COMMON_HEADER);
        $response = Helpers::sendCallApi('POST',ServerUrl::USER_REGISTRATION, $requestArr,  $isAjax = false, $isJson=true,$extraHeader);
            // die(json_encode($response));
            if(isset($response->success) && $response->success == true)
            {

                Mail::to('nassautennis@gmail.com')->send(new welcomeMail($requestArr));
                Mail::to($email)->send(new welcomeMail($requestArr));
                return redirect('dashboard')->with('status', 'Please check your email to verify your account');
            }else{
                $status_code = $response->status_code;
                $message = $response->message;
                return redirect('register')->with('message',$message);
                exit();
            }
    }

    /*check user subscription
     *
     */

    public function checkUserSubcription(Request $request)
    {
        $subscriptionCheck = $request->subscriptionCheck;
        if($subscriptionCheck == 'check')
        {
           $userId = Session::get('userId');

                 $userParamArr = array("userid"=>$userId);
                 $response = Helpers::sendCallApi('GET', ServerUrl::CHECK_USER_SUBSCRIPTION,$userParamArr, $isAjax=false, $isJson=true,array("os"=> ServerUrl::COMMON_HEADER));

                $subscriptionData =  $response->data->subscription_details;

                if(!empty($subscriptionData[0]))
                {
                 $isSubscribed = $subscriptionData[0]->isSubscribed;
                }
                else
                {
                   $isSubscribed = $subscriptionData->isSubscribed;
                }

                if($isSubscribed == '')
                {
                    return 1;
                }
                else
                {
                    return 2;
                }
        }
    }



    /**
     * Edit Profile Controller Function
     */
    public function myprofile(){
        $userProfile = Session::get('userprofile');
       // exit(json_encode($userProfile));
        if(isset($userProfile) && isset($userProfile->data) && isset($userProfile->data->user_type)){
            if($userProfile->data->user_type == "USER"){
                $type = "USER";
                $url = "/GetUserProfileV2?userid=%s";
            }else{
                $type = "EXPERT";
                $url = "/a?expert_id=%s";
            }
           // echo $url;
        }
        return view('Users.myprofile');
    }
    public function verifyUser($token)
    {
        $verifyUser = VerifyUser::where('token', $token)->first();
        if(isset($verifyUser) ){
            $user = $verifyUser->user;
            if($user->status=='N') {
                $verifyUser->user->status = 'Y';
                $verifyUser->user->save();
                $status = "Your e-mail is verified. You can now login.";
            }else{
                $status = "Your e-mail is already verified. You can now login.";
            }
        }else{
            return redirect('/login')->with('message', "Sorry your email cannot be identified.");
        }

        return redirect('/login')->with('status', $status);
    }
    public function register(Request $request)
    {
        if(Helpers::validateSession($redirect = false,$message = "",$url = "") == true)
        return  redirect('dashboard');

        return view('auth.register');
    }
    public function update_password(){
        if(Helpers::validateSession($redirect = false,$message = "",$url = "") == true)
        return  redirect('dashboard');

        return view('auth.forgetPassword');
    }

    public function isSubscribed(){
        $userid = Session::get('userId');
        Log::debug("In is Subscribe");
        if ($userid !=null){

          Log::debug("checking");
          $url=ServerUrl::BASE_URL.'/ExpertConnect/v2/SubscriptionV2/getSubscriptionDetails?userid='.$userid;
          $outputofcurl=Helpers::curlCall($url,Null);
          $outputofcurl=json_decode($outputofcurl);
          //$subscription_details=$outputofcurl->data->subscription_details;
          $isUserSubscribed=$outputofcurl->data->subscription_details[0]->isSubscribed;
          // dd($outputofcurl->data->subscription_details[0]->isSubscribed);


          Log::debug("result");
          //Log::debug(json_encode($subscription_details[0]));
          Log::debug($isUserSubscribed);
          return $isUserSubscribed;
        }
        return false;;
    }
    public function curlCall($postUrl, $toSend)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPGET, 1); //CURLOPT_POST
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $toSend);
        curl_setopt($ch, CURLOPT_URL, $postUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            // "Requires Authentication"=>"YES",
            // 'authorization'=>''
        // ));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $out = curl_exec($ch);
        return $out;
    }

    public function callExpert($email)
    {
        Session::put('userEmail', $email);
        return redirect('videocalltest');
       
    }

    public function getUserAppointments(){

        $userId = Session::get('userId');
        $response = Utilities::getUserAppointments($userId);
       
        $json = json_encode($response);
        if(!empty($response))
        {
            if($response->success == true)
            {
                if($response->data !=null)
                {
                    if($response->data->upcoming_appointments !=null)
                    {
                        $userAppointments = $response->data->upcoming_appointments[0];

                            Session::put('userEmail', $userAppointments->email);    
                            $UTCDate = gmdate("Y-m-d");

                            //$UTCDate = date("Y-m-d"); //EST date

                            if(strcmp($userAppointments->date, $UTCDate) == 0) {

                                //$todayUTCDate = date("Y-m-d H:i:s");
                                $todayUTCDate = gmdate("Y-m-d H:i:s");
                                $appointmentDate = $userAppointments->startDateTime;
                                $appointmentDate = substr($appointmentDate, 0, 19);
                                $DateTwo = $todayUTCDate. ':'.  $userAppointments->startDateTime;
                                
                                
                                $diff = abs(strtotime($todayUTCDate) - strtotime($appointmentDate));
                                $tm_hours = floor($diff / 3600);
                                $tm_minutes = floor(($diff / 60) % 60);
                                $tm_seconds = $diff % 60;
                                $timeDifference = $tm_hours. ':' .$tm_minutes.':'. $tm_seconds;
                                $tm_minutes = $tm_minutes;
                                $tm_seconds = $tm_seconds;
                                //print_r($tm_minutes. ":" .$tm_seconds);
                              
                                // $startAppointmentDate = substr($userAppointments->startDateTime, 10, 10);
                                // print_r($startAppointmentDate);
                                // exit;
                                $UtcTime = gmdate("H.i");
                                $startTime = substr($userAppointments->startDateTime, 10, 10);
                                $startTime= date("H.i", strtotime($startTime));
                                
                                $tm_StartTime = $startTime - .10;
                                $tm_UtcTime = $UtcTime - .10;
                                
                                if($tm_hours == 0)
                                {
                                    if($tm_StartTime >= $tm_UtcTime && $tm_minutes <= 10)
                                    {
                                        $tm_flag = "1";
                                    }
                                    else
                                    {
                                        $tm_flag  = "0";
                                    }
                                    if($tm_StartTime <= $startTime && $startTime <= $UtcTime && $tm_minutes <= 10)
                                    {
                                       $flag = "1";
                                    }
                                    else
                                    {
                                      $flag  = "0";
                                    }
                                    return response()->json(array('flag'=>"$flag", 'tm_flag'=>"$tm_flag",'timeDifference'=>"$timeDifference" ,'tm_hours'=>"$tm_hours", 'tm_minutes'=>"$tm_minutes", 'tm_seconds'=> "$tm_seconds"));

                                }
                            
                        }
                        
                    } 
                } 
            }
        }

        return response()->json(array('flag'=>"0", 'tm_flag'=>"0",'timeDifference'=>"0" ,'tm_hours'=>"0", 'tm_minutes'=>"0", 'tm_seconds'=> "0"));
     }

     public function getExpertAppointments(){

        $userId = Session::get('userId');
        $response = Utilities::getExpertAppointments($userId);
        print_r($response);
        exit;
        if(!empty($response))
        {
            if($response->success == true)
            {
                if($response->data !=null)
                {
                    if($response->data->upcoming_appointments !=null)
                    {
                        $userAppointments = $response->data->upcoming_appointments[0];

                            $UTCDate = date("Y-m-d");
                            if(strcmp($userAppointments->date, $UTCDate) == 0) {

                                $todayUTCDate = date("Y-m-d H:i:s");
                                $appointmentDate = $userAppointments->startDateTime;
                                $appointmentDate = substr($appointmentDate, 0, 19);

                                $diff = abs(strtotime($todayUTCDate) - strtotime($appointmentDate)); 
                                $tm_hours = floor($diff / 3600);
                                $tm_minutes = floor(($diff / 60) % 60);
                                $tm_seconds = $diff % 60;
                                $tm_minutes = 10- $tm_minutes;
                                $timeDifference = $tm_hours. ':'.  $tm_minutes.':'. $tm_seconds;

                                $UtcTime = gmdate("H.i");
                                $startTime = substr($userAppointments->startDateTime, 10, 10);
                                $startTime= date("H.i", strtotime($startTime));
                                
                                $tm_StartTime = $startTime - .10;
                                $tm_UtcTime = $UtcTime - .10;
                                
                                if($tm_StartTime >= $tm_UtcTime)
                                {
                                    $tm_flag = "1";
                                }
                                else
                                {
                                    $tm_flag  = "0";
                                }

                                if($startTime >= $UtcTime)
                                {
                                    $flag = "1";
                                }
                                else
                                {
                                    $flag  = "0";
                               }
                            
                           // return response()->json(array('flag'=>$flag,'tm_flag'=>$tm_flag,'timeDifference'=>$timeDifference));
                            return response()->json(array('flag'=>"$flag",'tm_flag'=>"$tm_flag",'timeDifference'=>"$timeDifference" ,'tm_hours'=>"$tm_hours", 'tm_minutes'=>"$tm_minutes", 'tm_seconds'=> "$tm_seconds"));
                        }
                        
                    } 
                } 
            }
        }

        return response()->json($response); 
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
