<?php

namespace App\Http\Controllers\loggedinuser;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\UrlGenerator;
use Laravel\Cashier\Cashier;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use ServerUrl;

use Mail;
use App\Mail\subscriptionConfirmation;

class AjaxController extends Controller
{
    private $base_url;
    public function __construct(){
        $this->base_url = ServerUrl::BASE_URL.'/ExpertConnect/v2';
    }

    public function getSuscriptionDetails(){
        $userid = Session::get('userId');
        Log::debug("In getSuscriptionDetails");

        if ($userid == null){
            Log::debug("Redirect to LOGIN");
            Session::flash('SubscripitonUrl', "/subscription");;
            return redirect('/login');
        }
        if ($this->isSubscribed()){
          return redirect('/dashboard');
        }
        Log::debug("Redirect to subscription");

        $url=$this->base_url.'/SubscriptionV2/getSubscriptionDetails?userid='.$userid;
        $outputofcurl=$this->curlCall($url,Null);
        $outputofcurl=json_decode($outputofcurl);

        //print_r($outputofcurl);die;
        $subscription_details=   $outputofcurl->data->subscription_details;
        return view('loggedinuser.subscription')->with(array("subscription_details"=>$subscription_details));
    }

    public function generateStripeToken(Request $request){
        parse_str($request->customerDetails,$customerDetails);
        Log::debug($customerDetails);

        $validator = Validator::make( $customerDetails , [
                     'card_no' => 'required|numeric',
                     'ccExpiryMonth' => 'required|numeric',
                     'ccExpiryYear' => 'required|numeric|digits:4',
                     'cvvNumber' => 'required|numeric|digits:3',
                     // 'firstName' => 'required',
                     // 'lastName' => 'required',
                     // // 'line1' => 'required',
                     // 'city' => 'required',
                     // 'state' => 'required',
                     // 'postal_code' => 'required| numeric'
                    ]);
        Log::debug($validator->passes());

        if ($validator->passes()) {
            try {

                \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
                Log::debug("Strpe secret is:". env('STRIPE_SECRET') . "\n");

                $token=\Stripe\Token::create(array(
                                            "card" => array(
                                              "number" => "".$customerDetails["card_no"]."",
                                              "exp_month" => $customerDetails["ccExpiryMonth"],
                                              "exp_year" => $customerDetails["ccExpiryYear"],
                                              "cvc" => "".$customerDetails["cvvNumber"]."",
                                              // "address_city" =>  "".$customerDetails["city"]."",
                                              // "address_country" =>  "US",
                                              // "address_line1" =>  "".$customerDetails["line1"]."",
                                              // "address_state" =>  "".$customerDetails["state"]."",
                                              // "address_zip" => "".$customerDetails["postal_code"]."",
                                              )
                                        ));
                                            // "number" => "4242424242424242",
                                            // "exp_month" => 7,
                                            // "exp_year" => 2019,
                                            // "cvc" => "314"
                Log::debug('"token" is:' . $token->id . "\n");
                //
                // $userProfile = Session::get('userprofile');
                //
                // Log::debug("customer details:" .json_encode($userProfile));
                //
                // $customer = \Stripe\Customer::create(array(
                //   'email' => $userProfile->data->user_details->useremail,
                //   'source'  => $token->id,
                //   'shipping' => array(
                //     'address' => array(
                //         'city' => "".$customerDetails["city"]."",
                //         'state' =>  "".$customerDetails["state"]."",
                //         'country' => "US",
                //         'line1' =>  "".$customerDetails["line1"]."",
                //         'postal_code' => "".$customerDetails["postal_code"]."",
                //       ),
                //     'name' =>  "".$customerDetails["firstName"]." ".$customerDetails["lastName"]."",
                //   ),
                // ));
                //
                // Log::debug("customer details:" .json_encode($customer));
                $userProfile = Session::get('userprofile');
                $username= "".$userProfile->data->user_details->name." ".$userProfile->data->user_details->lastname."";
                Log::debug(json_encode( array("status"=>"true","plan"=>$request->plan,"token" =>$token->id,"username" => $username)));
                return json_encode( array("status"=>"true","plan"=>$request->plan,"token" =>$token->id, "username" => $username));
                }catch(\Stripe\Error\Card $e) {
              // Since it's a decline, \Stripe\Error\Card will be caught
              $body = $e->getJsonBody();
              $err  = $body['error'];

              Log::debug('Status is:' . $e->getHttpStatus() . "\n");
              Log::debug('Type is:' . $err['type'] . "\n");
              Log::debug('Code is:' . $err['code'] . "\n");
              // param is '' in this case
              Log::debug('Param is:' . $err['param'] . "\n");
              Log::debug('Message is:' . $err['message'] . "\n");
              //die;
              return false;
            } catch (\Stripe\Error\RateLimit $e) {
              // Too many requests made to the API too quickly
              Log::debug('Rate Limit is:' . $e. "\n");
            } catch (\Stripe\Error\InvalidRequest $e) {
              // Invalid parameters were supplied to Stripe's API
              Log::debug('InvalidRequest is:' . $e. "\n");
            } catch (\Stripe\Error\Authentication $e) {
              // Authentication with Stripe's API failed
              Log::debug('Authentication is:' . $e. "\n");
              // (maybe you changed API keys recently)
            } catch (\Stripe\Error\ApiConnection $e) {
              Log::debug('Api Connection is:' . $e. "\n");
              // Network communication with Stripe failed
            } catch (\Stripe\Error\Base $e) {
              // Display a very generic error to the user, and maybe send
              Log::debug('Base is:' . $e. "\n");
              // yourself an email
            } catch (Exception $e) {
              // Something else happened, completely unrelated to Stripe
              Log::debug('Exception is:' . $e. "\n");
            }

        }else{
          Log::debug('Status is:' . $e->getHttpStatus() . "\n");
          return json_encode(array("status"=>"false"));
        }
    }

    public function sendStripeToken(Request $request){
        Log::debug("sendStripeToken ".$request);
        // $subscriptionToken = null;
        //
        // //$subscriptionToken = $this->startSubscription($request);
        //
        // //Log::debug("subscriptionToken: ". $subscriptionToken);
        //
        // if ($subscriptionToken == null){
        //   Log::debug("Error: in subscriptionType ". $request);
        //   return json_encode(array("status"=>"false"));
        // }

        $url=$this->base_url."/PostUserSubscription";
        $sendArray=array();
        $userid = Session::get('userId');
        $sendArray["userid"]=$userid;  //4;
        $sendArray["subscriptionType"]=$request->plan;    //"SILVER", "GOLD";
        $sendArray["token"]= $request->token;  //"sub_1CqdYyC6wIITZRLylWYPXTKA";

        if ($request->verifiedCode && !empty($request->code) ){   // if verifiedCode is added
            $sendArray["promo_code"]= $request->code;
        }

        Log::debug("Send Array:  ".json_encode($sendArray));
        $res=json_decode($this->curlPost($url,json_encode($sendArray)));
        Log::debug(json_encode($res));
        Log::debug(json_encode(array( "success"=> $res->success, "message" => $res->message,"username"=>$request->username,"redirectUrl"=>base64_encode(url()->previous()))));

        if ($res->success){
          $date = date('d-m-y');
          $userProfile = Session::get('userprofile');
          $email = $userProfile->data->user_details->useremail;
          $requestArr =  array(
                  'firstname' => $userProfile->data->user_details->name,
                  'lastname' => $userProfile->data->user_details->lastname,
                  'user_email' =>$email,
                  'plan' =>$request->plan,
                  'charge'=> $request->price,
                  'subject' => "Thank you for Subscribing to Expert Connect Video Library",
                  'date' => $date
               );
          Mail::to($email)->send(new subscriptionConfirmation($requestArr));
        }

        return json_encode(array( "success"=> $res->success, "message" => $res->message,"username"=>$request->username,"redirectUrl"=>base64_encode(url()->previous())));
     }
     // public function viewSubscription(){
     //   $date = date('d-m-y');
     //   $userProfile = Session::get('userprofile');
     //   $email = $userProfile->data->user_details->useremail;
     //
     //   $data =  array(
     //           'firstname' => $userProfile->data->user_details->name,
     //           'lastname' => $userProfile->data->user_details->lastname,
     //           'user_email' =>$email,
     //           'plan' =>'SILVER',
     //           'charge'=> '$100',
     //           'subject' => "Thank you for Subscribing to Expert Connect Video Library",
     //           'date' => $date
     //        );
     //   return view('emailers.text.subscriptionConfirmation')->with('data', $data);
     // }
    // public function startSubscription($request){
    //   Log::debug("Subscription: ".$request);
    //   try
    //   {
    //     \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    //     $interval = "month";
    //     $amount = 30000; // in cents
    //
    //     if ($request->plan == "GOLD"){
    //       $interval = "year";
    //       $amount = 80000;
    //     }
    //
    //     $plan =  \Stripe\Plan::create(array(
    //         "amount" => $amount,
    //         "interval" => $interval,
    //         "product" => "prod_DP2jGNP1S7GIB8", // created a product from dashboard, refrence: Expert Pro con
    //         "currency" => "usd"
    //         ));
    //
    //     $subscription = \Stripe\Subscription::create([
    //         'customer' =>  $request->customertoken,
    //         'items' => [['plan' => $plan]],
    //     ]);
    //
    //     Log::debug("subscription details:" .json_encode($subscription));
    //     return $request->token;
    //   }
    //   catch(Exception $e)
    //   {
    //     Log::debug("unable to get payement for customer: " .$userid. " : exception:: ".$e);
    //     return null;
    //   }
    // }

    public function verifyCouponCode(Request $request){
      Log::debug("Coupon code:: ".$request->coupon);
      $url=$this->base_url.'/PostPromoCodeV2';
      $sendArray=array();
      $sendArray["userid"] = Session::get('userId');
      $sendArray["promo_code"]=$request->coupon;  //CLUBMANISH;
      $sendArray["subscription_type"]=$request->plan;  //CLUBMANISH;

      $res=json_decode($this->curlPost($url,json_encode($sendArray)));

      if ($res->success){
        Log::debug(json_encode(array("success"=>$res->success, "message"=> $res->message, "discount" => $res->data->discount)));
        return json_encode(array("success"=>$res->success, "message"=> $res->message, "discount" => $res->data->discount));
      }

      Log::debug(json_encode(array("success"=>$res->success, "message"=> $res->message)));
      return json_encode(array("success"=>$res->success, "message"=> $res->message));
    }
    public function isSubscribed(){
        $userid = Session::get('userId');
        $url=$this->base_url.'/SubscriptionV2/getSubscriptionDetails?userid='.$userid;
        $outputofcurl=$this->curlCall($url,Null);
        $outputofcurl=json_decode($outputofcurl);
        $subscription_details=$outputofcurl->data->subscription_details;
        $isUserSubscribed=$outputofcurl->data->subscription_details[0]->isSubscribed;
        // dd($outputofcurl->data->subscription_details[0]->isSubscribed);
        return $isUserSubscribed;

    }

    public function curlPost($postUrl, $toSend)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $toSend);
        curl_setopt($ch, CURLOPT_URL, $postUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $out = curl_exec($ch);
        return $out;
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

	public function isSubscribedview(Request $request){
        $data=json_decode($this->isSubscribed());
        // $category = $request->input('category', 'Technical');
		// return view('loggedinuser.subscription')->with(array('data'=>$data));
        // return redirect(url()->previous());
        return view('loggedinuser.category')->with(array('data'=>$data));
    }
}
