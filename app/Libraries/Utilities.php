<?php

/* 
 *@Auther Anoop Kumar
 */
class Utilities{
     
    public static function getUserProfile($userId,$type="user")
    {
        if($type == 'user'){
            $userParamArr = array("userid"=>$userId);
            $response = Helpers::sendCallApi('GET', ServerUrl::GET_USER_PROFILE,$userParamArr, $isAjax=false, $isJson=true,array("os"=> ServerUrl::COMMON_HEADER));    
        }else{
          
            $userParamArr = array("expert_id"=>$userId);
            $response = Helpers::sendCallApi('GET', ServerUrl::GET_EXPERT_PROFILE,$userParamArr, $isAjax=false, $isJson=true,array("os"=> ServerUrl::COMMON_HEADER));    
        }
       return $response;
    }
    
    public static function getUserAppointments($userId)
    {
        
            $data = array();
            $data['type'] = 'user';
            $data['sender'] = Session::get('userId');
            $response = Helpers::sendCallApi('GET', ServerUrl::GET_USER_APPOINTMENTS, $data, $isAjax=false, $isJson=true,array("os"=> ServerUrl::COMMON_HEADER));    
        
       return $response;
    }

    public static function getExpertAppointments($userId)
    {
       
            $data = array();
            $data['type'] = 'expert';
            $data['sender'] = Session::get('userId');
            $response = Helpers::sendCallApi('GET', ServerUrl::GET_USER_APPOINTMENTS, $data, $isAjax=false, $isJson=true,array("os"=> ServerUrl::COMMON_HEADER));    
            return $response;
    }
    
    public static function getListOfVideos($userId)
    {
        $userParamArr = array("userid"=>$userId);
       
        $response = Helpers::sendCallApi('GET', ServerUrl::GET_ALL_VIDEOS,$userParamArr, $isAjax=false, $isJson=true,array("os"=> ServerUrl::COMMON_HEADER));
        if(!empty($response))
        {
            return $response;
        }
        else
        {
            return false;
        }
    }

    public static function formatDate($str){
        $format = "Y-m-d";
        $date = strtotime($str);
        return date($format, $date );
    }
 }
