<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Contracts\Filesystem\Filesystem;

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

use Helpers;
use ServerUrl; 
use Utilities;

use Mail;
use App\Mail\BookingConfirmation;
use App\Mail\Invoice;

class VideoCallController extends Controller
{

    /*  ------------------------VIEW-------------------  */

    public static function sendMail(){
        $resp = Helpers::sendCallApi("GET",ServerUrl::GET_COUNTRY, array() , $isAjax = true, $isJson = true, $extra_headers = false);
       echo ServerUrl::GET_COUNTRY;
        echo "<script>console.log(".json_encode($resp).")</script>";
    }
    //home page
    public static function viewAllExperts(){
        $experts_list = Helpers::getMenu('user');
        // Helpers::log(json_encode($experts_list));
        // exit();
        if(isset($experts_list->data->menuData))
            return view('video_call.experts')->with(array('experts_list'=>$experts_list->data->menuData));
        else return redirect('/');
    }


    public static function expert_profile($id){
        $return = Helpers::getRandomExpert(6,$id);
        $random_expert = $return['data'];
        if(isset($return['expertReturn'])){
            $profile       = $return['expertReturn'];
        }else{
            $profile = Helpers::getExpertProfile($id);
        }
        // Helpers::log(json_encode($return));
        
        if((isset($profile->success) && $profile->success == true)){
            // Helpers::log(json_encode($profile));
            $profile_expert_id = $profile->data->profile_details->id;
            return view('video_call.expert_profile')->with(
                array(
                    'profile'       =>$profile , 
                    'expert_id'     => $profile_expert_id,
                    'random_expert' =>$random_expert
                )
            );
        }else{
            return redirect('/');   
        }
    }

    //step 1 
    public function step_1_fill_details($id){
        //Validate Session
        $res = Helpers::validateSession($redirect = true,$message = "",$url = "");
        if($res!== true && $res!== false){return  $res;}

        $current_request = Session::get('curentRequest');
        $viewArray = array();
        $viewArray['expert_id'] = $id;

        if(empty($current_request) || !is_array($current_request) || empty($current_request['step'])){
            $current_request = array('step'=>1);
        }
            $current_request['expertProfile'] = Helpers::getExpertProfile($id);
            $current_request['userProfile'] = Helpers::getUserProfile();

            Session::put('curentRequest',$current_request);
            $viewArray['curentRequest'] = $current_request;
            Session::put('appointmentSetting',$current_request);

            return view('video_call.add_personal_details')->with(
                $viewArray
            );
    }

    //step 2
    public function step2_add_card($id){
        //Validate Session
        $res = Helpers::validateSession($redirect = true,$message = "",$url = "");
        if($res!== true && $res!== false){return  $res;}

        $transectionID = "";
        $current_request = Session::get('curentRequest');

        if(empty($current_request['step'])){
            return redirect('add-personal-details/'.$id);
        }else 
        if(!empty($_POST)){
                try {
                    $request = array();
                    // Helpers::log(json_encode($_FILES));
                    if(!empty($_FILES['videURLS']['name'])){
                        //ONLY IF VIDEO IS SELECTED
                        $s3 = S3Client::factory(array(
                            'credentials'   => array(
                                'key'       => getenv('ACCESS_KEY_ID'),
                                'secret'    => getenv('SECRET_ACCESS_KEY')
                            ),
                            'version' => 'latest',
                            'region'  => 'us-east-2'
                        ));
                        $bucket = getenv('S3_BUCKET_NAME') ?: die('No "S3_BUCKET" config var in found in env!');
                        $upload = $s3->upload($bucket, $_FILES['videURLS']['name'], fopen($_FILES['videURLS']['tmp_name'], 'rb'), 'public-read');    
                        $request['videoUrl']                = $upload->get('ObjectURL');
                    }
                    
                   
                $dat = explode("/",$_POST['appointmentDate']);
                $date = $dat[1];
                $month = $dat[0];
                $year = $dat[2];
                
                // $request['appointmentDate']         = Utilities::formatDate($date."-".$month."-".$year);
                // $request['appointmentTime']         = $_POST['time1'];
                // $request['appointmentTimeId']       = $_POST['timeID'];
                // $request['question']                = $_POST['question'];
                // $request['expertId']                = $id;
                // $request['userId']                  = Session::get('userId');

                $request['appointmentDate']         = Utilities::formatDate($year."-".$month."-".$date);
               // $request['appointmentTime']         = $_POST['time1'];
                $request['appointmentTimeId']       = $_POST['timeID'];
              //  $request['question']                = $_POST['question'];
                $request['expertId']                = $id;
                $request['userId']                  = Session::get('userId');
                
                Session::put('finalAppointments',$request);
                $appointmentSetting = Session::get('appointmentSetting');
                
                 
                // $data = Helpers::sendCallApi("POST",ServerUrl::BLOCK_APPONTMRNT,  $request , $isAjax = true, $isJson = true, array("os"=> ServerUrl::COMMON_HEADER));
                $Country = Helpers::getCountryList();
                $transectionID = "$%FFSDR$#%@#$";
                return view('video_call.add_payment_details')->with(
                    array(
                        'Country'           => $Country,
                        "transectionID"     => $transectionID,
                        'current_request'   => $current_request
                    )
                );
            }catch(Exception $e){
                $data = new stdClas();
                $data->success = false;
                $data->message = "Failed to upload File(s)";
            }
            if($data->success){
            

                // $transectionID = $data->data->block_details->transactionId;
                // $request['transactionId'] = $transectionID;
                // $request['step'] = 2;
                // $request['expertProfile'] = Helpers::getExpertProfile($id);
                // $request['userProfile'] = Helpers::getUserProfile();
                // $current_request = $request;
               
                Session::put('curentRequest',$request);
            }else{
                Session::put('curentRequest', $current_request);
                return redirect('add-personal-details/'.$id)->with('error',$data->message);
            }
        }else{
            if(!empty($current_request['transactionId'])){
                $transectionID = $current_request['transactionId'];
            }else{
                return redirect('add-personal-details/'.$id);
            }
        }
        $Country = Helpers::getCountryList();
        return view('video_call.add_payment_details')->with(
            array(
                'Country'           => $Country,
                "transectionID"     => $transectionID,
                'current_request'   => $current_request
            )
        );
    }

    //step 3
    public function review_payment_details(Request $request){
        //Validate Session
        $res = Helpers::validateSession($redirect = true,$message = "",$url = "");
        if($res!== true && $res!== false){return  $res;}

        $current_request = Session::get('curentRequest');
        $Json= json_encode($current_request);
       
//         if(empty($current_request['transactionId'])){
//             return redirect('/');
//         }
//         $transaction_status = $this->get_transaction_status($current_request['transactionId']);
//         if($transaction_status->success && $transaction_status->data->transactionStatus->isActive == true){
//             $freeze_appointment = $this->freeze($current_request['transactionId']);
//             if($freeze_appointment == true){
                
//                 if(!isset($current_request['card_data'])){
//                     $card_data = array();
//                     $card_data['credit_card_holder_name'] = $request->get('credit_card_holder_name');
//                     $card_data['card_number'] = $request->get('card_number');
//                     $card_data['cvv'] = $request->get('cvv');
//                     $card_data['exp_month'] = $request->get('exp_month');
//                     $card_data['exp_year'] = $request->get('exp_year');
//                     $current_request['card_data'] = $card_data;
//                 }

//                 if(!isset($current_request['billing_data'])){
//                     $billing_data = array();

//                     $billing_data['billing_first_name'] = $request->get('billing_first_name');
//                     $billing_data['billing_last_name'] = $request->get('billing_last_name');
//                     $billing_data['billing_country'] = $request->get('billing_country');
                    
//                     $billing_state = explode('--',$request->get('billing_state'));
//                     // $billing_city = explode('--',$request->get('billing_city'));
                    
//                     $billing_data['billing_state_id'] = $billing_state[0];
//                     $billing_data['billing_state'] = $billing_state[1];
//                     // $billing_data['billing_city_id'] = $billing_city[0];
//                     // $billing_data['billing_city'] = $billing_city[1];
                    
//                     $billing_data['billing_city'] = $request->get('b_city');
//                     $billing_data['billing_address'] = $request->get('billing_address');
//                     $billing_data['zipCode'] = $request->get('billing_zipcode');
//                     $billing = $request->get('billing');
//                     $current_request['billing_data'] = $billing_data;
//                 }
                
//                 if(!isset($current_request['shipping_data'])){
//                     $shipping_data = array(); 
//                     $shipping_data['shipping_first_name'] = $request->get('shipping_first_name');
//                     $shipping_data['shipping_last_name'] = $request->get('shipping_last_name');
//                     $shipping_data['shipping_country'] = $request->get('shipping_country');
                    
//                     $shipping_state = explode('--',$request->get('shipping_state'));
//                     // $shipping_city = explode('--',$request->get('shipping_city'));

//                     // Helpers::log(json_encode($shipping_state));
//                     // Helpers::log(json_encode($shipping_city));
//                     // die();

//                     $shipping_data['shipping_state_id'] = $shipping_state[0];
//                     $shipping_data['shipping_state'] = $shipping_state[1];
//                     // $shipping_data['shipping_city_id'] = $shipping_city[0];
//                     // $shipping_data['shipping_city'] = $shipping_city[1];
//                     $shipping_data['shipping_city'] = $request->get('s_city');


//                     $shipping_data['shipping_address'] = $request->get('shipping_address');
//                     $shipping_data['shipping_zipcode'] = $request->get('shipping_zipcode');
//                     $current_request['shipping_data'] = $shipping_data;
//                 }
                
//                 $zipCode =  $current_request['billing_data']['zipCode'];
//               //  $services_fees = $this->add_service_tax($current_request['transactionId'],$zipCode,$current_request['expertId']);

// //  if( $services_fees->success == false || (isset($services_fees->data->transactionStatus->isActive) && $services_fees->data->transactionStatus->isActive == false)){
// //                     return redirect('add-personal-details/'.$current_request['expertId'])->with('error',$services_fees->message);
// //                 }

// //                 $current_request['services_fees'] = $services_fees->data;
       
//                 Session::put('curentRequest',$current_request);
//             }
//            // $transaction_status = $this->get_transaction_status($current_request['transactionId']);

//             if($transaction_status->data->transactionStatus->isActive == true){
                
//             }else{
//                 return redirect('add-personal-details/'.$current_request['expertId'])->with('error',"Time Expired");
//             }
//         }else{
//             return redirect('add-personal-details/'.$current_request['expertId'])->with('error',"Time Expired");
//         }  



        if(!isset($current_request['card_data'])){
            $card_data = array();
            $card_data['credit_card_holder_name'] = $request->get('credit_card_holder_name');
            $card_data['card_number'] = $request->get('card_number');
            $card_data['cvv'] = $request->get('cvv');
            $card_data['exp_month'] = $request->get('exp_month');
            $card_data['exp_year'] = $request->get('exp_year');
            $current_request['card_data'] = $card_data;
        }

        if(!isset($current_request['billing_data'])){
            $billing_data = array();

            $billing_data['billing_first_name'] = $request->get('billing_first_name');
            $billing_data['billing_last_name'] = $request->get('billing_last_name');
            $billing_data['billing_country'] = $request->get('billing_country');
            
            $billing_state = explode('--',$request->get('billing_state'));
            // $billing_city = explode('--',$request->get('billing_city'));
            
            $billing_data['billing_state_id'] = $billing_state[0];
            $billing_data['billing_state'] = $billing_state[1];
            // $billing_data['billing_city_id'] = $billing_city[0];
            // $billing_data['billing_city'] = $billing_city[1];
            
            $billing_data['billing_city'] = $request->get('b_city');
            $billing_data['billing_address'] = $request->get('billing_address');
            $billing_data['zipCode'] = $request->get('billing_zipcode');
            $billing = $request->get('billing');
            $current_request['billing_data'] = $billing_data;
        }
        
        if(!isset($current_request['shipping_data'])){
            $shipping_data = array(); 
            $shipping_data['shipping_first_name'] = $request->get('shipping_first_name');
            $shipping_data['shipping_last_name'] = $request->get('shipping_last_name');
            $shipping_data['shipping_country'] = $request->get('shipping_country');
            
            $shipping_state = explode('--',$request->get('shipping_state'));
            // $shipping_city = explode('--',$request->get('shipping_city'));

            // Helpers::log(json_encode($shipping_state));
            // Helpers::log(json_encode($shipping_city));
            // die();

            $shipping_data['shipping_state_id'] = $shipping_state[0];
            $shipping_data['shipping_state'] = $shipping_state[1];
            // $shipping_data['shipping_city_id'] = $shipping_city[0];
            // $shipping_data['shipping_city'] = $shipping_city[1];
            $shipping_data['shipping_city'] = $request->get('s_city');


            $shipping_data['shipping_address'] = $request->get('shipping_address');
            $shipping_data['shipping_zipcode'] = $request->get('shipping_zipcode');
            $current_request['shipping_data'] = $shipping_data;


        }
        
        $zipCode =  $current_request['billing_data']['zipCode'];
        Session::put('curentRequest',$current_request);
        return view('video_call.review_payment_details')->with(
            array('current_request' => $current_request)
        );
    }

    //Step 4
    public function makePayment(){
        //Validate Session
        $request = Session::get('finalAppointments');
        Helpers::sendCallApi("POST",ServerUrl::TEST_APPOINMENT,  $request , $isAjax = true, $isJson = true, array("os"=> ServerUrl::COMMON_HEADER));
        return redirect('thankyou')->with('appointment_confirmation' , null);


        // $res = Helpers::validateSession($redirect = true,$message = "",$url = "");
        // if($res!== true && $res!== false){return  $res;}

        // $current_request = Session::get('curentRequest');

        // $transaction_status = $this->get_transaction_status($current_request['transactionId']);
        // if($transaction_status->data->transactionStatus->isActive == true){
        //     try{
                
        //         $stripe_request = array();
        //         $stripe_request['number'] = $current_request['card_data']['card_number'];
        //         $stripe_request['exp_month'] = $current_request['card_data']['exp_month'];
        //         $stripe_request['exp_year'] = $current_request['card_data']['exp_year'];
        //         $stripe_request['cvc'] = $current_request['card_data']['cvv'];
        //         //$token = $this->getStripeToken($stripe_request);
        //         // if(!empty($token['error'])){
        //         //     return redirect('add-payment-details/'.$current_request['expertId'])->with('error',$token['error']['message']);
        //         // }
        //         // $appointment_confirmation = $this->appointment_confirmation($current_request['transactionId'],$token->id,$current_request['services_fees']->fee->totalFee);
        //         $transactionId = rand();
        //         $amount = 0;
        //         $token = rand();
        //        // $timeDifference = $current_request['transactionId']. ':'.  $token.':'. $transactionId. ':' .$token;
        //         $requestArr = array('transactionId'=>$current_request['transactionId'],'stripeToken'=>$token,'amount'=>$amount);
        //         $appointment_confirmation = Helpers::sendCallApi('POST',ServerUrl::FREEZE_APPOINTMENT, $requestArr,  $isAjax = false, $isJson=true,array("os"=> ServerUrl::COMMON_HEADER));
        //         $current_request['appointment_confirmation'] = $appointment_confirmation;
        //         Session::put('curentRequest',$current_request);
        //         if($appointment_confirmation->success){
        //             //to admin
        //             // Mail::to(getenv('MAIL_USERNAME'))->send(new Invoice($current_request));
        //             //to user
        //             // Mail::to($current_request['userProfile']->data->user_details->useremail)->send(new BookingConfirmation($current_request));
        //             // Mail::to($current_request['userProfile']->data->user_details->useremail)->send(new Invoice($current_request));
        //             return redirect('thankyou')->with('appointment_confirmation' , $appointment_confirmation);
        //         }else{
        //             return redirect('error')->with('appointment_confirmation' , $appointment_confirmation);
        //         }
        //     }catch(Exception $e){
        //         return redirect('add-personal-details/'.$current_request['expertId'])->with('error',"Failed to generate Stripe Token.");
        //     }
        // }else{
        //     return redirect('add-personal-details/'.$current_request['expertId'])->with('error',"Time Expired");
        // }
    }

    public static function thankyou(){
        //Validate Session
        $res = Helpers::validateSession($redirect = true,$message = "",$url = "");
        if($res!== true && $res!== false){return  $res;}

        $curentRequest = Session::get('curentRequest');
        $appointment_confirmation = Session::get('appointment_confirmation');
        return view('video_call.thankyou')->with('curentRequest' , $curentRequest);

        // if(isset($appointment_confirmation->success) && $appointment_confirmation->success == true){
        //     return view('video_call.thankyou')->with('curentRequest' , $curentRequest);
        // }
        // else{
        //     return redirect('/');
        // }
    }

    public static function error(){
        return view('video_call.error');
    }


/** ----------------------  CONTROLLERS--------------------------------------- */
   

    /**
     * To fetch appointment status
     */
    public function getExpertAvailablity(){
        //Validate Session
        if(Helpers::validateSession($redirect = false)){
            $data = array();
            $data['expert_id'] = $_POST['expert_id'];
            $data['user_id'] = Session::get('userId');
            
            $date_r = explode("-",$_POST['date']);
            $month =$date_r[0]; 
            $date = $date_r[1];
            $year = $date_r[2];
    
            $data['date']= Utilities::formatDate($date."-".$month."-".$year);
            $available_time= Helpers::sendCallApi("GET",ServerUrl::GET_EXPERT_UNAVAILABILITY, $data, $isAjax = true, $isJson = true, array("os"=> ServerUrl::COMMON_HEADER));
            return json_encode($available_time);
        }else{
            $return = new \stdClass();
            $return->success = false;
            $return->message = "Login First";
            return json_encode($return);
        }
    }

    /**
     * To validate transaction Status
     */
    public function get_transaction_status($transactionId){
        if(Helpers::validateSession($redirect = false)){
            $data = array();
            $data['transactionId'] = $transactionId;
            $transaction_status = Helpers::sendCallApi("GET",ServerUrl::GET_TRANSACTION_STATUS, $data, $isAjax = true, $isJson = true, array("os"=> ServerUrl::COMMON_HEADER));
            return $transaction_status;
        }else {
            return false;
        }
    }
    /**
     * to freeze transaction status
     */
    public function freeze($transactionId){
        if(Helpers::validateSession($redirect = false)){
            $requestArr = array('transactionId'=>$transactionId);
            $freeze_appointment_response = Helpers::sendCallApi('POST',ServerUrl::FREEZE_APPOINTMENT, $requestArr,  $isAjax = false, $isJson=true,array("os"=> ServerUrl::COMMON_HEADER));
            if($freeze_appointment_response->success == true){
                return true;
            }else{
                return false;
            }
        }else {
            return false;
        }
    }

    /**
     * Confirm Appointment Used in last step
     */
    public function appointment_confirmation($transactionId,$stripeToken,$amount){
        if(Helpers::validateSession($redirect = false)){
            $requestArr = array('transactionId'=>$transactionId,'stripeToken'=>$stripeToken,'amount'=>$amount);
            
            return Helpers::sendCallApi('POST',ServerUrl::FREEZE_APPOINTMENT, $requestArr,  $isAjax = false, $isJson=true,array("os"=> ServerUrl::COMMON_HEADER));
        }else {
            return false;
        }
    }

    
    /**
     * Generate Stripe Token
     */
    public function getStripeToken($cardDetaild){
        try{
                \Stripe\Stripe::setApiKey(getenv('STRIPE_SECRET'));
                $token = \Stripe\Token::create(array(
                    "card" => $cardDetaild
                ));  
                return $token;
            } catch(\Stripe\Error\Card $e) {
                    return $e->getJsonBody();
            } catch (\Stripe\Error\RateLimit $e) {
                    return $e->getJsonBody();
            } catch (\Stripe\Error\InvalidRequest $e) {
                    return $e->getJsonBody();
            } catch (\Stripe\Error\Authentication $e) {
                    return $e->getJsonBody();
            } catch (\Stripe\Error\ApiConnection $e) {
                    return $e->getJsonBody();
            } catch (\Stripe\Error\Base $e) {
                    return $e->getJsonBody();
            } catch (Exception $e) {
                    return $e->getJsonBody();
            }
    }
    
    /**
     * Get Service Tax Details
     */
    public function add_service_tax($transactionId,$zipCode,$expertId){
        $data = array();
        $data['transactionId'] = $transactionId;
        $data['zipCode'] = $zipCode;
        $data['expertId'] = $expertId;
        $services_fees = Helpers::sendCallApi("GET",ServerUrl::GET_INVOICE_AND_TRANSACTION_STATUS, $data, $isAjax = true, $isJson = true, array("os"=> ServerUrl::COMMON_HEADER));
        // if($services_fees->success == true){
        //     if($services_fees->data->transactionStatus->isActive == false){
        //         return false;
        //     }else{
        //         return $services_fees;
        //     }
        // }else{
        //     return false;
        // }
    }
}