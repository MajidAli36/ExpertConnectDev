<?php
use App\Http\Controllers\loggedinuser\AjaxController;
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;


/*
 * @Auther Anoop Kumar
 */

class Helpers
{

    public static function sendCallApi($requestType,$url, $data = array(), $isAjax = false, $isJson = true, $extra_headers = false)
    {
        if ($isJson) {
            $header = array("Content-type: application/json");
        }
        if ($extra_headers !== false) {
            foreach ($extra_headers as $key => $value) {
                array_push($header, $key . ":" . $value);
            }
        }
        if ($requestType == 'GET' || $requestType == 'DELETE') {
            if ($requestType == 'GET'){
                $url = ServerUrl::BASE_URL . $url . "?" . http_build_query($data);
            }else{
                $url = ServerUrl::BASE_URL . $url;
            }
        } else {
            $url = ServerUrl::BASE_URL . $url;
        }
        

        // Helpers::log(json_encode($url));        //to Comment
        // Helpers::log(json_encode($header));     //to Comment

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        if ($isJson) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        }
        if(isset($requestType) && $requestType == 'POST')
        {
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        }
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($curl, CURLOPT_TIMEOUT, 130);
        curl_setopt($curl, CURLINFO_HEADER_OUT, 1);

        $response = curl_exec($curl);
        // echo $response;
        // exit;
        if (empty($response) || curl_errno($curl) != 0) {
            $response = new stdClass();
            $response->status_code = '999';
            $response->message = 'Server Not Responding.';
            $response->success = false;
            $response = json_encode($response);
        }

        // if(empty($response) || (isset($response->success) && $response->success != true)){
            // Helpers::log($response); //to Comment
            // die();

        return json_decode($response);
    }

    public static function getCountryList(){
        $countryList = Session::get('CountryList');
        // Helpers::log(json_encode($countryList)); //to Comment
        if(isset($countryList->success) && $countryList->success == true){
            return $countryList;
        }else{
            $Country = Helpers::sendCallApi("GET",ServerUrl::GET_COUNTRY, array() , $isAjax = true, $isJson = true, $extra_headers = false);
            if(isset($Country->success) && $Country->success==true){
                Session::put('CountryList',$Country);
                // }
            }
            return $Country;
        }
    }

    public static function getExpertProfile($id){
        $lastExpertProfile = Session::get('lastExpertProfile');
        if(!empty($lastExpertProfile) && isset($lastExpertProfile->data) && isset($lastExpertProfile->data->profile_details) && $lastExpertProfile->data->profile_details->id == $id){
            return $lastExpertProfile;
        }else{
            $data = array();
            $data['expert_id'] = $id;
            $expert = Helpers::sendCallApi("GET",ServerUrl::GET_EXPERT_PROFILE, $data, $isAjax = true, $isJson = true, array("os"=> ServerUrl::COMMON_HEADER));
            Session::put('lastExpertProfile',$expert);
            return $expert;
        }
    }

    public static function getUserProfile(){
        $user_profile = Session::get('userprofile');
        if(isset($user_profile->success) && $user_profile->success == true){
            return $user_profile;
        }else{
            return false;
        }
    }

    public static function getUserId(){
        $user_id = Session::get('user_id');
        if(!empty($user_id)){
            return $user_id;
        }else{
            return false;
        }
    }

    public static function getUserType(){
        $user_type = Session::get('user_type');
        if(!empty($user_type)){
            return $user_type;
        }else{
            return false;
        }
    }

    public static function getMenu($type){
        // $menu = Session::get($type.'Menu');
        $type = strtolower($type);

        // if(isset($menu->success) && $menu->success == true && $menu->type == $type){
        //     return $menu;
        // }else{
            $data = array('user_type' => $type);
            $menu = Helpers::sendCallApi("GET",ServerUrl::GET_MENU, $data, $isAjax = true, $isJson = true, array("os"=> ServerUrl::COMMON_HEADER)); //
            if($menu->success){
                $menu->type = $type;
                Session::put('menuApiResponse',$menu);
            }
            return $menu;
        // }
    }

    public static function getRandomExpert($count,$id=""){
        $experts = array();
        $ids = array();
        $menu = self::getMenu('user');
        // echo json_encode($menu);
        // die();
        if(isset($menu->data) && isset($menu->data->menuData)){
            foreach($menu->data->menuData as $key => $item){
                    if($item->menuType == 'EXPERT_DROPDOWN'){
                        $experts[] = $menu->data->menuData[$key];
                    }
            }

            $return = array();
            $return['data'] = array();

            for($i=0;$i<$count;$i++){
                    $menu_count = count($experts);
                    if($menu_count > 0){
                        $key = rand(0,$menu_count-1);
                        $menu_item_count = count($experts[$key]->menu_items);
                        if($menu_item_count > 0){
                            $index = rand(0,$menu_item_count-1);
                            $exp = array_splice($experts[$key]->menu_items,$index,1)[0];
                            if(in_array($exp->id,$ids)){
                                $i--;
                                continue;
                            }
                            if($exp->id == $id){
                                $i--;
                                // $expertReturn = $exp;
                            }else{
                                $return['data'][] = $exp;
                                $ids[]            = $exp->id;
                            }
                        }else{
                            $i--;
                            array_splice($experts,$key,1);
                        }
                    }else{
                        break;
                    }
            }

            if(isset($expertReturn)){
                $return['expertReturn'] = new \stdClass();
                $return['expertReturn']->data = new \stdClass();
                $return['expertReturn']->success = true;
                // $return['expertReturn']->data->profile_details = $expertReturn;
            }
            return $return;
        }else return array();
    }

    public static function getAllExpertList(){
        $experts = array();
        $ids = new \stdClass();
        $menu = self::getMenu('user');
        // die(json_encode($menu));
        if(isset($menu->data) && $menu->success == true ){
            foreach($menu->data->menuData as $key => $item){
                if($item->menuType == 'EXPERT_DROPDOWN'){
                    foreach($item->menu_items as $menu_items){
                            if(isset($ids->{'a'.$menu_items->id}) && $ids->{'a'.$menu_items->id} == true){
                                continue;
                            }else{
                                $experts[] = $menu_items;
                                $ids->{'a'.$menu_items->id} = true;
                            }
                    }
                }
            }
        }
        return $experts;

    }

    /**
     * if user is login then always return true;
     * else{
     *   if $redirect == true{
     *      if url -> redirect to url after login
     *      else ->   reirect to home page
     *    }else{
     *      return false;
     *    }
     * }
     * NOTE: if $message is given then That Message will be shown in login page else default message will be shown
     */
    public static function validateSession($redirect = true,$message = "",$url = ""){
        $user_profile = self::getUserProfile();
        if( $user_profile!= false && !empty($user_profile)){
            //return if user is login in any case
            return true;
        }else{
            if($redirect){
                if(empty($message)){
                    $message = "Login First to View Page";
                }
                if(!empty($url)){
                    //if url has value then after login redirect to url specified
                    return redirect('login')->with('error',$message)->with('url',$url);
                }else{
                    //after login user will redirect to home
                    return redirect('login')->with('error',$message);
                }
            }else {
                //returned when $redirect == false
                return false;
            }
        }
    }

    public static function log($data){
        echo "<script>console.log(".$data.")</script>";
    }

    public static function limitBio($string){
        $limit = 100;
       if(strlen($string) > $limit){
            return substr($string,0,$limit-3)."...";
       }
       else{
           return $string;
       }
    }

    public static function  isSubscribed(){
        $userid = Session::get('userId');
        Log::debug("In is Subscribe");
        if ($userid !=null){

         // Log::debug("checking");
          
          $url=ServerUrl::BASE_URL.'/ExpertConnect/v2/SubscriptionV2/getSubscriptionDetails?userid='.$userid;
          $outputofcurl=Helpers::curlCall($url,Null);

                $outputofcurl=json_decode($outputofcurl);
          //$subscription_details=$outputofcurl->data->subscription_details;
                $isUserSubscribed=$outputofcurl->data->subscription_details[0]->isSubscribed;
          // dd($outputofcurl->data->subscription_details[0]->isSubscribed);


          //Log::debug("result");
          //Log::debug(json_encode($subscription_details[0]));
          //Log::debug($isUserSubscribed);
          return $isUserSubscribed;
        }
        return false;
    }
    public static function curlCall($postUrl, $toSend)
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

    public static function encryptPassword($password){
        return ($password);
    }



    public static function getExpertLoginProfile(){
        $expertprofile = Session::get('expertprofile');
        if(isset($expertprofile) && $expertprofile->success == true){
            return $expertprofile;
        }else{
            return false;
        }
    }

    public static function setExpertLoginProfile($data){
        if(isset($data->success) && $data->success == true){
            Session::put('expertprofile', $data);
            return true;
        }else{
            return false;
        }
    }

    public static function getAppointments($user_id,$user_type){
            $request = array('type' => $user_type,'sender'=>$user_id);
            $appointments = Helpers::sendCallApi("GET",ServerUrl::GET_APPOINTMENTS, $request, $isAjax = true, $isJson = true, array("os"=> ServerUrl::COMMON_HEADER)); //
            if(isset($appointments) && $appointments->success){
               return $appointments;
            }
    }

    public static function getExpertCalender($expert_id){
        $request = array('expert_id' => $expert_id);
        $appointments = Helpers::sendCallApi("GET",ServerUrl::GET_CALENDER, $request, $isAjax = true, $isJson = true, array("os"=> ServerUrl::COMMON_HEADER)); //
        if(isset($appointments) && $appointments->success){
           return $appointments;
        }
    }

    public static function uploadFile($file_name,$temp_path){
                $s3 = S3Client::factory(array(
                    'credentials'   => array(
                        'key'       => getenv('ACCESS_KEY_ID'),
                        'secret'    => getenv('SECRET_ACCESS_KEY')
                    ),
                    'version' => 'latest',
                    'region'  => 'us-east-2'
                ));
                $bucket = getenv('S3_BUCKET_NAME') ?: die('No "S3_BUCKET" config var in found in env!');
                return $s3->upload($bucket, $file_name, fopen($temp_path, 'rb'), 'public-read');
    }

}

?>
