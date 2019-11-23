<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Support\Facades\Session;

use Helpers;
use ServerUrl;
use Utilities;

ini_set('max_execution_time', 300);

class UserProfileController extends Controller
{
    /*------------------------------------ Views----------------------- */
    
    /**
     * Default view
     */
    public function index(){
            //Validate Session
            $res = Helpers::validateSession($redirect = true,$message = "",$url = "");
            if($res!== true && $res!== false){return  $res;}
            
            Session::put('userprofile',Utilities::getUserProfile(Session::get("userId")));
            $userProfile = Session::get('userprofile');
            
            $Country = Helpers::sendCallApi("GET",ServerUrl::GET_COUNTRY, array() , $isAjax = true, $isJson = true, $extra_headers = false);
            
            $states  = array();
            $cities = array();
            if(isset($userProfile->data->user_details->country)){
                $states = Helpers::sendCallApi("GET",ServerUrl::GET_STATE, array('country_id'=>$userProfile->data->user_details->country->id) , $isAjax = true, $isJson = true, $extra_headers = false)->data->state_details;
            }
            if(isset($userProfile->data->user_details->state)){
                $cities = Helpers::sendCallApi("GET",ServerUrl::GET_CITY, array('state_id'=>$userProfile->data->user_details->state->id) , $isAjax = true, $isJson = true, $extra_headers = false)->data->city_details;
            }
            return view('user/viewUserProfile')->with(array('states'=>$states,'cities'=>$cities, 'userProfile'=>$userProfile->data,'country'=>$Country->data->country_details));
    }

    public function view_appointments(){
        $res = Helpers::validateSession($redirect = true,$message = "",$url = "");
        if($res!== true && $res!== false){return  $res;}

        Session::put('userprofile',Utilities::getUserProfile(Session::get("userId")));
        $userProfile = Session::get('userprofile');

        $appointments = Helpers::getAppointments(Session::get("userId"),'user');
        return view('user/viewAppointment')->with(
            array(
                'force_remove_reply'=>true,
                'appointments'      =>  $appointments,
                'userProfile'       =>  $userProfile->data
            )
        );
    }

 /**
  * UPDATE PASSWORD VIEW
  */
function update_password(){
        $res = Helpers::validateSession($redirect = true,$message = "",$url = "");
        if($res!== true && $res!== false){return  $res;}

        Session::put('userprofile',Utilities::getUserProfile(Session::get("userId")));
        $userProfile = Session::get('userprofile');
        return view('user/changeUserPassword')->with(array('userProfile'=>$userProfile->data));
}

public function phone_verification(){
        $res = Helpers::validateSession($redirect = true,$message = "",$url = "");
        if($res!== true && $res!== false){return  $res;}

        Session::put('userprofile',Utilities::getUserProfile(Session::get("userId")));
        $userProfile = Session::get('userprofile');

        $country_Code = Helpers::getCountryList();
        return view('user/userPhoneVerification')->with(
            array(
                    'country_Code'=>$country_Code->data->country_details,
                    'userProfile'=>$userProfile->data
                )
        );
}

public function cancel_subscription(){
    return view('user/cancelSubscription');
}


    /*------------------------------------ CONTROLLERS----------------------- */
    public function send_otp(){
        if(Helpers::validateSession($redirect = false,$message = "",$url = "")){
            $req = array();
            $req['country_code'] = $_POST['code'];
            $req['number'] = $_POST['phone'];
            $req['user_id'] = Session::get('userId');
            $res = Helpers::sendCallApi("POST",ServerUrl::SEND_VERIFICATION_OTP, $req , $isAjax = true, $isJson = true, array("os"=> ServerUrl::COMMON_HEADER));
            exit(json_encode($res));
        }else{
            $return = new \stdClass();
            $return->success = false;
            $return->message = "Login First";
            return json_encode($return);
        }
    }


    public function verify_otp(){
        if(Helpers::validateSession($redirect = false,$message = "",$url = "")){
            $req = array();
            $req['otp'] = $_POST['otp'];
            $req['user_id'] = Session::get('userId');
            $res = Helpers::sendCallApi("POST",ServerUrl::OTP_VERIFICATION, $req , $isAjax = true, $isJson = true, array("os"=> ServerUrl::COMMON_HEADER));
            exit(json_encode($res));
        }else{
            $return = new \stdClass();
            $return->success = false;
            $return->message = "Login First";
            return json_encode($return);
        }
    }

    public function post_update_password(){
        if(Helpers::validateSession($redirect = false,$message = "",$url = "")){
            $req = array();
            $req['id'] = Session::get('userId');
            $req['user_type'] = Session::get('userType');
            $req['password'] =  Helpers::encryptPassword($_POST['password']);
            $req['confirm_password'] =  Helpers::encryptPassword($_POST['confirm_password']);
            $res = Helpers::sendCallApi("POST",ServerUrl::UPDATE_PASSWORD, $req , $isAjax = true, $isJson = true, array("os"=> ServerUrl::COMMON_HEADER));
            if($res->success)
                return redirect('update-password')->with('success',$res->message);
            else return redirect('update-password')->with('error',$res->message);
        }else{
            $return = new \stdClass();
            $return->success = false;
            $return->message = "Login First";
            return json_encode($return);
        }
    }


    public function update_profile(Request $request){
        if(Helpers::validateSession($redirect = false,$message = "",$url = "")){
            $userProfile = Session::get('userprofile');
            $data = array();

            if($request->filled('name')){
                $data['name'] = $request->input('name');
            }
            if($request->filled('lastname')){
                $data['lastname'] = $request->input('lastname');
            }
            if($request->filled('gender')){
                $data['gender'] = strtolower($request->input('gender'));
            }
            if($request->filled('about')){
                $data['about'] = $request->input('about');
            }
            if($request->filled('address')){
                $data['address'] = $request->input('address');
            }
            if($request->filled('dob')){
                $data['dob'] = $request->input('dob');
            }
            if($request->filled('country')){
                $data['country'] = $request->input('country');
            }
            if($request->filled('city')  && $request->input('city') != "null"){
                $data['city'] = $request->input('city');
            }
            if($request->filled('state') && $request->input('state') != "null"){
                $data['state'] = $request->input('state');
            }
            if(isset($_FILES['image'])){
                $file_size=$_FILES['image']['size'];
                $file_tmp= $_FILES['image']['tmp_name'];
            
                $type = pathinfo($file_tmp, PATHINFO_EXTENSION);
                $data_file = file_get_contents($file_tmp);
                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data_file);
                $data['image'] = $base64;
            }else{
                $data["profile_picture_url"] = $userProfile->data->user_details->profile_picture_url;
            }

            $data['userid'] = Session::get("userId");

            $req = array();
            $req['type'] = "user";
            $req['user_details'] = $data;
           // echo(json_encode($req));
           // exit;
           //exit(json_encode($req));
            $res = Helpers::sendCallApi("POST",ServerUrl::PROFILE_UPDATE, $req , $isAjax = false, $isJson = true, array("os"=> ServerUrl::COMMON_HEADER));
            if($res->success){
                Session::put('userprofile',Utilities::getUserProfile(Session::get("userId")));
            }
            die(json_encode($res));
        }else{
            $return = new \stdClass();
            $return->success = false;
            $return->message = "Login First";
            return json_encode($return);
        }
    }


    public function getState(){
        if(Helpers::validateSession($redirect = false,$message = "",$url = "")){
            $data = array();
            $data['country_id'] = $_POST['country_id'];
            $res = Helpers::sendCallApi("GET",ServerUrl::GET_STATE, $data , $isAjax = true, $isJson = true, array("os"=> ServerUrl::COMMON_HEADER));
            exit(json_encode($res));
        }else{
            $return = new \stdClass();
            $return->success = false;
            $return->message = "Login First";
            return json_encode($return); 
        }
    }

    public function getCity(){
        if(Helpers::validateSession($redirect = false,$message = "",$url = "")){
            $data = array();
            $data['state_id'] = $_POST['state_id'];
            $res = Helpers::sendCallApi("GET",ServerUrl::GET_CITY, $data , $isAjax = true, $isJson = true, $extra_headers = false);
            exit(json_encode($res));
        }else{
            $return = new \stdClass();
            $return->success = false;
            $return->message = "Login First";
            return json_encode($return); 
        }
    }
}
