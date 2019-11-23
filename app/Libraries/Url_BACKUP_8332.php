<?php

/*@Auther Anoop Kumar
 */
class Url
{
    const BASE_URL                  = "http://54.235.14.209:8080/";
    const COMMON_HEADER             = 'web';
    const SERVER_PATH               = "ExpertConnect/v2/";
    const POST_LOGIN                =   self::SERVER_PATH."PostLogin";
    const SOCIAL_LOGIN              =   self::SERVER_PATH."PostSocialLogin";
    const GET_USER_PROFILE          =   self::SERVER_PATH."GetUserProfileV2";
    const PROFILE_UPDATE            =   self::SERVER_PATH."UpdateProfileV2";
    const UPDATE_PASSWORD           =   self::SERVER_PATH."PostUpdatePasswordV2";
    const FORGET_PASSWORD           =   self::SERVER_PATH."PostForgotPasswordRequest";


    const GET_ALL_VIDEOS            =   self::SERVER_PATH."VideoGalleryV2";
    const SEND_VERIFICATION_OTP     =   self::SERVER_PATH."RequestPhoneNumberOTP";
    const OTP_VERIFICATION          =   self::SERVER_PATH."PostOTPVerification";
    const CHECK_USER_SUBSCRIPTION   =   self::SERVER_PATH."SubscriptionV2/getSubscriptionDetails";
    
    const GET_COUNTRY               =   self::SERVER_PATH."GetCountries";
    const GET_STATE                 =   self::SERVER_PATH."GetStates";
    const GET_CITY                  =   self::SERVER_PATH."GetCities";
    const USER_REGISTRATION         =   self::SERVER_PATH."PostSignUp";



    const BLOCK_APPONTMRNT          = self::SERVER_PATH."appointment/blockAppointment";
    

    //Video Calling Module
    const GET_EXPERTS			                =  self::SERVER_PATH."MenuServletV2";
    const GET_EXPERT_PROFILE                    =  self::SERVER_PATH."GetExpertProfileDetails";
    const GET_EXPERT_UNAVAILABILITY             =  self::SERVER_PATH."GetExpertUnAvialabilityV2";
    const BLOCK_APPOINTMENT                     =  self::SERVER_PATH."appointment/blockAppointment";
    const GET_INVOICE_AND_TRANSACTION_STATUS    =  self::SERVER_PATH."InvoiceV2/getInvoiceAndTransStatus";
    const GET_TRANSACTION_STATUS                =  self::SERVER_PATH."TransactionsV2/getStatus";
    const FREEZE_APPOINTMENT                    =  self::SERVER_PATH."FreezeAppointment";
    const GET_CONFIRMATION_APPOINTMENT          =  self::SERVER_PATH."AppointmentConfirmationV2";

    const GET_MENU                              = self::SERVER_PATH."MenuServletV2";  /* user/expert */
}
