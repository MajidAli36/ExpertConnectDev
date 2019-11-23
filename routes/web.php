<?php

use Symfony\Component\HttpKernel\Fragment\RoutableFragmentRenderer;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Auth::routes();



Route::post('stripetoken','loggedinuser\AjaxController@generateStriptToken');
Route::post('sendstripetoken','loggedinuser\AjaxController@sendstripetoken');


Route::get('profile','User\UserProfileController@index');
Route::get('cancel-subscription','User\UserProfileController@cancel_subscription');



Route::get('update-password','User\UserProfileController@update_password');
Route::post('update-password',"User\UserProfileController@post_update_password");


Route::get('phone-verification','User\UserProfileController@phone_verification');
Route::post('send-otp',"User\UserProfileController@send_otp");
Route::post('verify-otp',"User\UserProfileController@verify_otp");

//APIS
Route::post('update-profile','User\UserProfileController@update_profile');
Route::post('get-state','User\UserProfileController@getState');
Route::post('get-city','User\UserProfileController@getCity');
//API ENDS

// Route::view('edit-password','user.changeUserPassword');

Route::view('phone','user.userPhoneVerification');
Route::view('terms-conditions','static_pages.userTermsConditions');
Route::view('privacy-policy','static_pages.userPrivacyPolicy');
Route::view('subscription-conditions','static_pages.userSubcriptionConditions');

//FOR APP
Route::view('terms-conditions-app','static_pages.userTermsConditions',['hideHeder'=>true]);
Route::view('privacy-policy-app','static_pages.userPrivacyPolicy',['hideHeder'=>true]);


Route::get('/','HomeController@index')->middleware('guest');

Route::get('register','UserLoginController@register')->middleware('guest');
Route::post('register','UserLoginController@store');

Route::get('login','UserLoginController@index')->middleware('guest');
Route::post('login','UserLoginController@makeLogin')->middleware('guest');//->middleware('auth')->except('logout');;

Route::post('fb-login','UserLoginController@facebook_login');
Route::any('fb-callback','UserLoginController@facebook_callback');

Route::post('g-login','UserLoginController@google_login');
Route::any('g-callback','UserLoginController@google_callback');



Route::any('logout','UserLoginController@logout');

Route::get('password_request','Auth\ForgotPasswordController@showLinkRequestForm');
Route::get('/verify','Auth\ForgotPasswordController@verify');
Route::post('/verify-reset-token','Auth\ForgotPasswordController@verify_reset_token');


Route::post('password_request', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email')->middleware('guest');
// $this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
// Route::post('password_email','UserLoginController@update');

Route::get('auth/facebook', 'Auth\RegisterController@redirectToProvider');
Route::get('auth/facebook/callback', 'Auth\RegisterController@handleProviderCallback');

Route::get('password/reset/{token}','Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset','Auth\ResetPasswordController@reset')->name('password.reset');


Route::get('changepassword','Auth\ResetPasswordController@passchangeform')->name('dashboard.password.change');
Route::post('changepassword','Auth\ResetPasswordController@changePassword')->name('dashboard.password.change');

Route::any('appointments','User\UserProfileController@view_appointments');

// Route::get('dashboard', 'UserLoginController@dashboard')->middleware('guest');
Route::get('dashboard', 'UserLoginController@dashboard');

Route::get('videolibrary', 'loggedinuser\videolibrary@show_video_library');

//user verfication for first time while entering in our system at the time of registration
Route::get('/user/verify/{token}', 'UserLoginController@verifyUser');

Route::post('check-subscription', 'UserLoginController@checkUserSubcription');


//temporary routes open for testing purpose only
Route::get('/videolibrarycurl', 'loggedinuser\videolibrary@listofvideos');
Route::get('/category', 'loggedinuser\videolibrary@categoryview');

// route for subscription check
Route::post('/subscription','loggedinuser\AjaxController@isSubscribed');
Route::get('/subscription','loggedinuser\AjaxController@getSuscriptionDetails');
	// return view("loggedinuser.subscription")->with;
// });

// stripe token ajax
Route::post('stripetoken','loggedinuser\AjaxController@generateStripeToken');
Route::post('sendstripetoken','loggedinuser\AjaxController@sendStripeToken');


// Apply Coupon
Route::post('applyCoupon','loggedinuser\AjaxController@verifyCouponCode');

Route::get('getAppointments', 'UserLoginController@getUserAppointments');


Route::get('videocalltest','VideoChatController@index');
Route::get('/videocalltest2','VideoChatController@authenticate');

// Route::group(['middleware' => 'auth'] , function () {
// 	Route::get('/myprofile','HomeController@myprofile');
// });
//Route::get('/subscriptionConf','loggedinuser\AjaxController@viewSubscription');
// Video Connect Routes
{
	Route::get('/experts','User\VideoCallController@viewAllExperts');
	Route::get('/experts_profile/{id}','User\VideoCallController@expert_profile');

	Route::any('/add-personal-details/{id}','User\VideoCallController@step_1_fill_details');
	Route::any('/add-payment-details/{id}','User\VideoCallController@step2_add_card');
	Route::any('/review-payment-details','User\VideoCallController@review_payment_details');

	Route::post('/makePayment','User\VideoCallController@makePayment');

	Route::get('/thankyou','User\VideoCallController@thankyou');
	Route::get('/error','User\VideoCallController@error');

	Route::post('/getExpertAvailablity','User\VideoCallController@getExpertAvailablity');
}


{
	Route::any('/test','User\VideoCallController@sendMail');
}


//Expert Module Routes
{
	Route::any('expert-dashboard','Expert\ExpertUserController@index');

	Route::view('expert-appointment','expert.manageAppointment');
	Route::any('manage-calendar','Expert\ExpertUserController@calender_index');
	// Route::view('manage-calendar','expert.manageCalendar');
	Route::view('expert-manage','expert.manage');
	Route::post('update-appointment','Expert\ExpertUserController@update_appointment');
	Route::post('appointmentReply','Expert\ExpertUserController@appointmentReply');
	Route::post('appointmentDetails','Expert\ExpertUserController@appointmentDetails');
}
