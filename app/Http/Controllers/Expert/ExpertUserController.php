<?php

namespace App\Http\Controllers\Expert;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Contracts\Filesystem\Filesystem;

use Helpers;
use ServerUrl; 
use Utilities;
// use Dompdf\Helpers;

class ExpertUserController extends Controller
{
    function index(){
        $expert_profile = Helpers::getExpertLoginProfile();
        if($expert_profile == false) return redirect('login');
        
        if(isset($expert_profile->data->profile_details->id)){
            $expert_id = $expert_profile->data->profile_details->id;
            $appointments = Helpers::getAppointments($expert_id,'expert');
            // exit(json_encode($appointments));
            return view('expert.pages.dashboard')->with(array(
                    'expert_profile'    =>  $expert_profile->data,
                    'appointments'      =>  $appointments
                ));
        }else{
            return redirect('login')->with('message','Something went wrong');
        }
    }

    function calender_index(){
        $expert_profile = Helpers::getExpertLoginProfile();
        if($expert_profile == false) return redirect('login');

        if(isset($expert_profile->data->profile_details->id)){
            $expert_id = $expert_profile->data->profile_details->id;
            $calender = Helpers::getExpertCalender($expert_id);
            
            return view('expert.pages.manageCalendar')->with(array(
                    'expert_profile'    =>  $expert_profile->data,
                    'calender'          =>  $calender
                ));
        }else{
            return redirect('login')->with('message','Something went wrong');
        }
    }


    function update_appointment(Request $request){
        $expert_profile = Helpers::getExpertLoginProfile();

        $appointmentDate    = $request->input('appointmentDate');
        $time_id            = $request->input('time_id');
        $is_available       = $request->input('is_available');
        if($is_available == "true"){
            $is_available = true;
        }else{
            $is_available = false;
        }

        if(isset($expert_profile->data->profile_details->id)){
            $expert_id = $expert_profile->data->profile_details->id;
            $request = new \StdClass();
            $request->appointmentDate = $appointmentDate;
            $request->time_id = $time_id;
            $request->is_available = $is_available;
            $request->expert_id = $expert_id;
            $res = Helpers::sendCallApi("POST",ServerUrl::UPDATE_APPOINTMENT, $request, $isAjax = true, $isJson = true, array("os"=> ServerUrl::COMMON_HEADER)); //
        }else{
            $res = new \stdClass();
            $res->success = false;
        }
        return json_encode($res);
    }


    public function appointmentReply(Request $request){
        $expert_profile = Helpers::getExpertLoginProfile();

        $appointment_id     =   $request->input('appointment_id');
        $expert_reply       =   $request->input('expert_reply');
        if(isset($expert_profile->data->profile_details->id)){

            if(isset($_FILES['expert_video']) && !empty($_FILES['expert_video']['tmp_name'])){
                try{
                    $upload = Helpers::uploadFile($_FILES['expert_video']['name'],$_FILES['expert_video']['tmp_name']);
                    $video_url = $upload->get('ObjectURL');
                }catch(Exception $e){
                    $data = new stdClas();
                    $data->success = false;
                    $data->message = "Failed to upload File";
                    return $data;
                }
            }

            $request = new \StdClass();
            $request->appointment_id = $appointment_id;
            $request->expert_reply = $expert_reply;
            $request->expert_id =  $expert_profile->data->profile_details->id;
            if(isset($video_url)){$request->expert_video = $video_url;}

            $res = Helpers::sendCallApi("POST",ServerUrl::APPOINTMENT_REPLY, $request, $isAjax = true, $isJson = true, array("os"=> ServerUrl::COMMON_HEADER)); //
        }else{
            $res = new \stdClass();
            $res->success = false;
            $res->code = 100;
        }
        return json_encode($res);
    }

    public function appointmentDetails(Request $request){
        $expert_profile = Helpers::getExpertLoginProfile();

        $appointment_id     =   $request->input('appointment_id');
        $sendata = false;
        if(isset($expert_profile->data->profile_details->id)){
            $sendata = true;
        }else{
            Session::put('userprofile',Utilities::getUserProfile(Session::get("userId")));
            $userProfile = Session::get('userprofile');
            if(!empty($userProfile) && $userProfile->success == true){
                $sendata = true;
            }
        }
        
        if($sendata == true){
            $request = new \StdClass();
            $request->appointment_id = $appointment_id;
            $res = Helpers::sendCallApi("GET",ServerUrl::APPOINTMENT_DETAILS, $request, $isAjax = true, $isJson = true, array("os"=> ServerUrl::COMMON_HEADER)); //
        }else{
            $res = new \stdClass();
            $res->success = false;
        }
        return json_encode($res);
    }
}