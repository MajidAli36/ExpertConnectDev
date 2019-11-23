<?php

namespace App\Http\Controllers\loggedinuser;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Helpers;
use ServerUrl;
use Utilities;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class videolibrary extends Controller
{

    public function show_video_library(){

        $userId = Session::get('userId');

        if ($userId == null)
          $userId = 114;

        //Log::debug("User ID: ".$userId);

        $videoData  = Utilities::getListOfVideos($userId);
        //Log::debug(json_encode(array('data'=>$videoData)));
        $video_data = $videoData->data->video_data;
        $mainMenu = array();
        $subMenu = array();
        $videoLists = array();
        $freevideos = array();
        array_push($mainMenu, 'Free Instructional Videos');

        foreach ( $video_data as $videos){
          if ( !empty($videos)){
            $mainMenus = $videos;
            foreach ($mainMenus as $currMenu) {
              if ($currMenu != null){
                array_push($mainMenu, $currMenu->menuHeading);
                if ($currMenu->subMenuItem != null){
                   $subMenus = array();
                   $allCategoryVideos = array();
                   foreach ($currMenu->subMenuItem as $subMenuItems){
                     array_push($subMenus, $subMenuItems->menuHeading);
                     if (!empty($subMenuItems->endDisplayItem)){
                       $allVideos = array();
                       foreach ($subMenuItems->endDisplayItem as $videoList) {
                         if ( !empty($videoList->isFree) && $videoList->isFree ){
                           array_push($freevideos,$videoList);
                         }
                         array_push($allVideos, $videoList);
                       }
                       array_push($allCategoryVideos, $allVideos);
                       array_push($videoLists, array($currMenu->menuHeading.'-'.$subMenuItems->menuHeading => $allVideos));
                     }
                   }
                   array_push($subMenus, 'All in Category');
                   array_push($videoLists, array($currMenu->menuHeading.'-'.'All in Category'=> $allCategoryVideos));
                   array_push($subMenu, array($currMenu->menuHeading => $subMenus ));
                 }
                 else {
                   if (!empty($currMenu->endDisplayItem)){
                     $allVideos = array();
                     foreach ($currMenu->endDisplayItem as $videoList) {
                       if ( !empty($videoList->isFree) && $videoList->isFree ){
                         array_push($freevideos,$videoList);
                       }
                       array_push($allVideos, $videoList);
                    }
                     array_push($videoLists, array($currMenu->menuHeading.'-'.'All in Category' => $allVideos));
                     array_push($subMenu, array($currMenu->menuHeading => ['All in Category'] ));
                   }
                 }
               }
            }
          }
        }
        // array_unshift($videoLists, array('Free Instructional Videos-All in Category' => $freevideos));
        // array_unshift($subMenu, array('Free Instructional Videos' => ['All in Category'] ));

        //Log::debug(json_encode(array('data'=>$videoLists)));
        //Log::debug(json_encode(array('data'=> array('mainMenus'=>$mainMenu, 'subMenus' => $subMenu, 'videoLists' => $videoLists, 'today_release' => $videoData->data->today_release, 'free_sample' => $freevideos))));

        return view('loggedinuser.videolibrary')->with(array('mainMenus'=>$mainMenu, 'subMenus' => $subMenu, 'videoLists' => $videoLists, 'today_release' => $videoData->data->today_release, 'freevideos' => $freevideos));

	}


    public function categoryview(Request $request){
        $userId = Session::get('userId');
        if ($userId == null)
          $userId = 114;

        Log::debug("Category Page: ". $userId);
        $videoData  = Utilities::getListOfVideos($userId);

        //Log::debug("Request ". json_encode($request));
        $category = $request->input('category', 'Technical');

        $freevideos = array();
        $video_data = $videoData->data->video_data;
        foreach ( $video_data as $videos){
          if ( !empty($videos)){
            $mainMenus = $videos;
            foreach ($mainMenus as $currMenu) {
              if ($currMenu != null){
                if ($currMenu->subMenuItem != null){
                   foreach ($currMenu->subMenuItem as $subMenuItems){
                     if (!empty($subMenuItems->endDisplayItem)){
                       foreach ($subMenuItems->endDisplayItem as $videoList) {
                         if ( !empty($videoList->isFree) && $videoList->isFree ){
                           array_push($freevideos,$videoList);
                        }
                       }
                     }
                   }
                 }
                 else {
                   if (!empty($currMenu->endDisplayItem)){
                     foreach ($currMenu->endDisplayItem as $videoList) {
                       if ( !empty($videoList->isFree) && $videoList->isFree ){
                         array_push($freevideos,$videoList);
                     }
                   }
                 }
               }
            }
          }
        }
      }

    //  Log::debug("Category Page: ". json_encode($freevideos));

        return view('loggedinuser.category')->with(array('data'=>$videoData,'category'=>$category, 'FreeSamples' => $freevideos));
    }

}
?>
