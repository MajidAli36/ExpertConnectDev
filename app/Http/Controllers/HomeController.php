<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use ServerUrl;
use Helpers;
use Utilities;
use Session;

class HomeController extends Controller
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
        $allExperts = Helpers::getAllExpertList();
        $menu_data = Session::get('menuApiResponse');
        if(!isset($menu_data) || (isset( $menu_data) && !$menu_data->success)){
            $menu_data = Helpers::getMenu('user');
        }
        // exit(json_encode($menu_data));

        if(empty($allExperts)){
            $allExperts = array();
        }
        return view('home')->with(array('allExperts'=>$allExperts,'menu_data'=>$menu_data));
    }

    // public function testcontroller(Request $request){
    //     return view('auth.passwords.reset')->with('token',"$request->token");
    // }

    // public function setNewPassword(){
        
    // }

    // public function myprofile(){
    //     return view('home');
    // }  

}
