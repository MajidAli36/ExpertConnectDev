@extends('loggedinuser.app')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/videolibrary.css')}}" type="text/css" />
<style>
.tab-data a{
    text-decoration: none;
}
</style>
@endpush
@section('content')
	<div class="loader" style="display:block;z-index:9999999;">
		<div class="wrap">
			<img src="{{ url('/img/logo.png') }}" class="">
			<p>Loading...</p>
		</div>
	</div>

  <div class="top" id="home">
    <div class="banner banner-new dashboard-bg" style="display:none;background-image: url(img/dashboard-bg.jpg)">
      <div class="dashboard-banner">
        <div class="dashboard-banner-text content">
          <div class="subscribe-detail">
            <h2>INSIDE 'EXPERT CONNECT'</h2>
            <p>View our comprehensive video library and learn from the legends of the sport
Our star experts cover hundreds of tennis related topics to take your game to THE NEXT LEVEL</p>
            <a class="access-btn"><span>Subscribe Now</span></a>
          </div>
        </div>
      </div>
      @if (!empty($today_release))
        <div class="video-banner" data-video="https://s3.amazonaws.com/expertconnectvideos/ALL+ENCOMPASING+TRAILER+UPDATED+9-22-18.mp4"></div>
        <video autoplay="" loop="" muted="">
  				  <source src="{{$today_release->video_url}}" type="video/mp4">
  			  	Your browser does not support HTML5 video.
  			</video>
      @else
        <div class="video-banner" data-video="https://s3.amazonaws.com/expertconnectvideos/ALL+ENCOMPASING+TRAILER+UPDATED+9-22-18.mp4"></div>
        <video autoplay="" loop="" muted="">
  				<source src="https://s3.amazonaws.com/expertconnectvideos/ALL+ENCOMPASING+TRAILER+UPDATED+9-22-18.mp4" type="video/mp4">
  			  	Your browser does not support HTML5 video.
  			</video>
      @endif
    </div>
  </div>
  <div class="wrapper">
		<div class="video-pop videolib-pop simplePopup">
   		<video src="https://s3.amazonaws.com/expertconnectvideos/ALL+ENCOMPASING+TRAILER+UPDATED+9-22-18.mp4"  controls controlsList="nodownload"></video>
   	</div>
   	<div class="tab-div"> <?php $k=1; ?>
      @if (!empty($mainMenus))
      <div class="sticky-filter">
        <h1>Video library</h1>
        <div class="cat-filter video-fil">
          <select>
            <?php
              foreach ($mainMenus as $mainMenu) {
                $selected=($mainMenu)?"selected":"";
                echo '<option value="'.$mainMenu.'">'.$mainMenu.'</option>';
              }
            ?>
          </select>
        </div>
      </div>
       @foreach ($mainMenus as $mainMenu)
        <div class="tab-data">
          <a href="{{ url('category?category='.str_replace(" ","_",trim($mainMenu))) }}">
            <h2 class="title">{{$mainMenu}}</h2>
          </a>
    		   	@if ($mainMenu == "Free Instructional Videos")
              <ul class="be-select-tab">
                <li class="clickme active"><a class="filter" data-tag="outer_0_0">All in Category</a></li>
                <li class="clickme"><a href="{{ url('category?category='.str_replace(" ","_",trim($mainMenu))) }}">View All</a></li>
    		      </ul>
            @else  <ul class="be-select-tab">
              {{$category = ""}}
              @foreach ($subMenus as $subMenu)
                {{$flag = false}}
                @foreach ($subMenu as $subMenuItem => $val)
                  <?php if ($subMenuItem == $mainMenu){
                      $category = array_reverse($val);
                      $flag = true;
                      break;
                  } ?>
                @endforeach
                <?php if ($flag){
                  break;
                }?>
              @endforeach
              @if ($category != "" && $mainMenu != "Free Instructional Videos")
               <?php $i = 1; ?>
                @foreach($category as $subCategory)
                  @if ($i == 1)
                    <li class="clickme active"><a class="filter" data-tag="outer_{{$i}}_{{$k}}">{{$subCategory}}</a></li>
                  @else
                    <li class="clickme"><a class="filter" data-tag="outer_{{$i}}_{{$k}}">{{$subCategory}}</a></li>
                  @endif
                  <?php $i +=1 ?>
                @endforeach
                <li class="clickme"><a href="{{ url('category?category='.str_replace(" ","_",trim($mainMenu))) }}">View All</a></li>
    		      @endif
            </ul>
            @endif
          <?php $i = 1; ?>
  		    <div class="tab-container">
            @if ($mainMenu == "Free Instructional Videos")
            @if (sizeOf($freevideos) >= 10)
               <div class="videolib-slider">
                 <ul class="videolib-one">
                   <?php $t = 1; $flag = false; Log::debug("Size of free Samples: ".sizeOf($freevideos))?>

                    @foreach ($freevideos as $key => $value)
                         @foreach ($value as $key => $val)
                            <?php if (!is_numeric($key)) {
                                $flag = true;
                                break;
                            } ?>
                            <?php if ($t > sizeOf($freevideos)/2) {
                                break;
                            } else {?>
                            <li slide-data="inner_free_{{$t}}_{{$k}}">
                              <img class="show-on-load" style="display:none;" src="{{$val->webThumbnail}}" alt="">
                              <div class="video-btn" style="display:none;"></div>
                            </li>
                            <?php $t +=1; }?>
                          @endforeach
                          <?php if ($t > sizeOf($freevideos)/2) {
                              break;
                          } else {?>
                          @if ($flag)
                            <?php $t = $t+ 1;?>
                            <li slide-data="inner_free_{{$t}}_{{$k}}">
                              <img class="show-on-load" style="display:none;" src="{{$value->webThumbnail}}" alt="">
                                <div class="video-btn" style="display:none;"></div>
                            </li>
                          @endif
                        <?php } ?>
                      @endforeach
                 </ul>
                 <?php $t = 1; $flag = false;?>
                 @foreach ($freevideos as $key => $value)
                      @foreach ($value as $key => $val)
                          <?php if ( !is_numeric($key)){
                              $flag = true;
                              break;
                          } ?>
                          <?php if (($t > sizeOf($freevideos)/2) ) {
                            break;
                          } else {?>
                          <div slide-data="inner_free_{{$t}}_{{$k}}" class="videolib-detail">
                           <div class="close-lib-btn"></div>
                            <div class="banner dashboard-bg" style="display:none;background-image: url('{{$val->webBanner}}');">
                            </div>
                            <div class="video-lib-detail" data-video="{{$val->videoURL}}" id="free_sample"></div>
                          </div>
                          <?php $t +=1; }?>
                      @endforeach
                       <?php if (($t > sizeOf($freevideos)/2) ) {
                         break;
                       } else {?>
                       @if ($flag)
                        <?php $t +=1;?>
                         <div slide-data="inner_free_{{$t}}_{{$k}}" class="videolib-detail">
                          <div class="close-lib-btn"></div>
                           <div class="banner dashboard-bg" style="display:none;background-image: url('{{$value->webBanner}}');">
                           </div>
                           <div class="video-lib-detail" data-video="{{$value->videoURL}}" id="free_sample"></div>
                         </div>
                       @endif
                     <?php } ?>
                  @endforeach
              </div>
              <div class="videolib-slider">
                <ul class="videolib-two">
                  <?php $t = 1; $flag = false; ?>
                   @foreach ($freevideos as $key => $value)
                        @foreach ($value as $key => $val)
                          <?php if (!is_numeric($key)){
                            $flag = true;
                            break;
                          } ?>
                          <?php if ($t < sizeOf($freevideos)/2){
                              $t+=1;
                              continue;
                            } else {?>
                           <li slide-data="inner_free_{{$t}}_{{$k}}">
                             <img class="show-on-load" style="display:none;" src="{{$val->webThumbnail}}" alt="">
                             <div class="video-btn" style="display:none;"></div>
                           </li>
                           <?php $t +=1; }?>
                         @endforeach
                         <?php if ($t < sizeOf($freevideos)/2) {
                            $t +=1;
                             continue;
                         } else {?>
                         @if ($flag)
                            <?php if ($t < sizeOf($freevideos)/2) {
                                $t +=1;
                                 continue;
                             } else {?>
                             <?php $t +=1;?>
                            <li slide-data="inner_free_{{$t}}_{{$k}}">
                             <img class="show-on-load" style="display:none;" src="{{$value->webThumbnail}}" alt="">
                               <div class="video-btn" style="display:none;"></div>
                            </li>
                          <?php } ?>
                         @endif
                       <?php } ?>
                     @endforeach
                </ul>
                <?php $t = 1; $flag = false;?>
                @foreach ($freevideos as $key => $value)
                     @foreach ($value as $key => $val)
                         <?php if ( !is_numeric($key)){
                             $flag = true;
                             break;
                         } ?>
                         <?php if ($t < sizeOf($freevideos)/2){
                            $t+=1;
                            continue;
                          } else { ?>
                          <div slide-data="inner_free_{{$t}}_{{$k}}" class="videolib-detail">
                          <div class="close-lib-btn"></div>
                           <div class="banner dashboard-bg" style="display:none;background-image: url('{{$val->webBanner}}');">
                           </div>
                           <div class="video-lib-detail" data-video="{{$val->videoURL}}" id="free_sample"></div>
                         </div>
                         <?php $t +=1;}?>
                      @endforeach
                      <?php if ($t < sizeOf($freevideos)/2) {
                         $t +=1;
                          continue;
                      } else {?>
                      @if ($flag)
                        <?php if ($t < sizeOf($freevideos)/2) {
                          $t +=1;
                          continue;
                        } else {?>
                        <?php $t +=1;?>
                        <div slide-data="inner_free_{{$t}}_{{$k}}" class="videolib-detail">
                         <div class="close-lib-btn"></div>
                          <div class="banner dashboard-bg" style="display:none;background-image: url('{{$value->webBanner}}');">
                          </div>
                          <div class="video-lib-detail" data-video="{{$value->videoURL}}" id="free_sample"></div>
                        </div>
                      <?php } ?>
                      @endif
                    <?php } ?>
                 @endforeach
             </div>
             @else
                <div class="list show-tab" id="outer_0_0">
                <div class="videolib-slider">
                  <ul class="videolib-one">
                    <?php $j = 1; $flag = false; ?>
                     @foreach ($freevideos as $key => $value)
                          @foreach ($value as $key => $val)
                             <?php if (!is_numeric($key)){
                                 $flag = true;
                                 break;
                             } ?>
                             <li slide-data="inner_{{$j}}_{{$k}}">
                               <img class="show-on-load" style="display:none;" src="{{$val->webThumbnail}}" alt="">
                               <div class="video-btn" style="display:none;"></div>
                             </li>
                             <?php $j +=1;?>
                           @endforeach
                           @if ($flag)
                           <?php $j +=1;?>
                             <li slide-data="inner_{{$j}}_{{$k}}">
                               <img class="show-on-load" style="display:none;" src="{{$value->webThumbnail}}" alt="">
                                 <div class="video-btn" style="display:none;"></div>
                             </li>
                           @endif
                       @endforeach
                  </ul>
                  <?php $j = 1; $flag = false;?>
                  @foreach ($freevideos as $key => $value)
                       @foreach ($value as $key => $val)
                         <?php if (!is_numeric($key)){
                             $flag = true;
                             break;
                         } ?>
                         <div slide-data="inner_{{$j}}_{{$k}}" class="videolib-detail">
                          <div class="close-lib-btn"></div>
                           <div class="banner dashboard-bg" style="display:none;background-image: url({{$val->webBanner}});">
                            </div>
                           <div class="video-lib-detail" data-video="{{$val->videoURL}}" id="free_sample"></div>
                         </div>
                         <?php $j +=1;?>
                      @endforeach
                      @if ($flag)
                       <?php $j +=1; ?>
                        <div slide-data="inner_{{$j}}_{{$k}}" class="videolib-detail">
                         <div class="close-lib-btn"></div>
                          <div class="banner dashboard-bg" style="display:none;background-image: url({{$value->webBanner}});">
                          </div>
                          <div class="video-lib-detail" data-video="{{$value->videoURL}}"  id="free_sample"></div>
                        </div>
                      @endif
                 @endforeach
                </div>
              </div>
              @endif
            @else
              @foreach ($category as $subCategory)
                @if ($i == 1)
                <div class="list show-tab" id="outer_{{$i}}_{{$k}}">
                @else
                <div class="list" id="outer_{{$i}}_{{$k}}">
                @endif
                  {{$videoData = ""}}  {{$videoItems = ""}}
                  @foreach ($videoLists as $videoList)
                    {{$flag = false}}
                    @foreach ($videoList as $videosCategory => $val)
                      <?php if ($videosCategory == $mainMenu.'-'.$subCategory){
                          $videoData= $val;
                          $videoItems = count($videoData, COUNT_RECURSIVE);
                          $flag = true;
                          break;
                      } ?>
                    @endforeach
                    <?php if ($flag){
                      break;
                    }?>
                  @endforeach
                  @if ($videoData != "")
                      @if ($videoItems >= 10)
                         <div class="videolib-slider">
    						           <ul class="videolib-one">
                             <?php $j = 1; $flag = false; ?>
                              @foreach ($videoData as $key => $value)
                                   @foreach ($value as $key => $val)
                                      <?php if (!is_numeric($key)) {
                                          $flag = true;
                                          break;
                                      } ?>
                                      <?php if ($j > $videoItems/2) {
                                          break;
                                      } else {?>
                                      <li slide-data="inner_{{$j}}_{{$k}}">
                                        <img class="show-on-load" style="display:none;" src="{{$val->webThumbnail}}" alt="">
                                        <div class="video-btn" style="display:none;"></div>
                                      </li>
                                      <?php $j +=1; }?>
                                    @endforeach
                                    <?php if ($j > $videoItems/2) {
                                        break;
                                    } else {?>
                                    @if ($flag)
                                      <?php $j = $j+ 1;?>
                                      <li slide-data="inner_{{$j}}_{{$k}}">
                                        <img class="show-on-load" style="display:none;" src="{{$value->webThumbnail}}" alt="">
                                          <div class="video-btn" style="display:none;"></div>
                                      </li>
                                    @endif
                                  <?php } ?>
                                @endforeach
                           </ul>
                           <?php $j = 1; $flag = false;?>
                           @foreach ($videoData as $key => $value)
                                @foreach ($value as $key => $val)
                                    <?php if ( !is_numeric($key)){
                                        $flag = true;
                                        break;
                                    } ?>
                                    <?php if (($j > $videoItems/2) ) {
                                      break;
                                    } else {?>
                                    <div slide-data="inner_{{$j}}_{{$k}}" class="videolib-detail">
                    								 <div class="close-lib-btn"></div>
                      								<div class="banner dashboard-bg" style="display:none;background-image: url('{{$val->webBanner}}');">
                      								</div>
                								      <div class="video-lib-detail" data-video="{{$val->videoURL}}"></div>
                							      </div>
                                    <?php $j +=1; }?>
                                @endforeach
                                 <?php if (($j > $videoItems/2) ) {
                                   break;
                                 } else {?>
                                 @if ($flag)
                                  <?php $j +=1;?>
                                   <div slide-data="inner_{{$j}}_{{$k}}" class="videolib-detail">
                                    <div class="close-lib-btn"></div>
                                     <div class="banner dashboard-bg" style="display:none;background-image: url('{{$value->webBanner}}');">
                                     </div>
                                     <div class="video-lib-detail" data-video="{{$value->videoURL}}"></div>
                                   </div>
                                 @endif
                               <?php } ?>
                            @endforeach
        						    </div>
                        <div class="videolib-slider">
                          <ul class="videolib-two">
                            <?php $j = 1; $flag = false; ?>
                             @foreach ($videoData as $key => $value)
                                  @foreach ($value as $key => $val)
                                    <?php if (!is_numeric($key)){
                                      $flag = true;
                                      break;
                                    } ?>
                                    <?php if ($j < $videoItems/2){
                                        $j+=1;
                                        continue;
                                      } else {?>
                                     <li slide-data="inner_{{$j}}_{{$k}}">
                                       <img class="show-on-load" style="display:none;" src="{{$val->webThumbnail}}" alt="">
                                       <div class="video-btn" style="display:none;"></div>
                                     </li>
                                     <?php $j +=1; }?>
                                   @endforeach
                                   <?php if ($j < $videoItems/2) {
                                      $j +=1;
                                       continue;
                                   } else {?>
                                   @if ($flag)
                                      <?php if ($j < $videoItems/2) {
                                          $j +=1;
                                           continue;
                                       } else {?>
                                       <?php $j +=1;?>
                                      <li slide-data="inner_{{$j}}_{{$k}}">
                                       <img class="show-on-load" style="display:none;" src="{{$value->webThumbnail}}" alt="">
                                         <div class="video-btn" style="display:none;"></div>
                                      </li>
                                    <?php } ?>
                                   @endif
                                 <?php } ?>
                               @endforeach
                          </ul>
                          <?php $j = 1; $flag = false;?>
                          @foreach ($videoData as $key => $value)
                               @foreach ($value as $key => $val)
                                   <?php if ( !is_numeric($key)){
                                       $flag = true;
                                       break;
                                   } ?>
                                   <?php if ($j < $videoItems/2){
                                      $j+=1;
                                      continue;
                                    } else { ?>
                                    <div slide-data="inner_{{$j}}_{{$k}}" class="videolib-detail">
                                    <div class="close-lib-btn"></div>
                                     <div class="banner dashboard-bg" style="display:none;background-image: url('{{$val->webBanner}}');">
                                     </div>
                                     <div class="video-lib-detail" data-video="{{$val->videoURL}}"></div>
                                   </div>
                                   <?php $j +=1;}?>
                                @endforeach
                                <?php if ($j < $videoItems/2) {
                                   $j +=1;
                                    continue;
                                } else {?>
                                @if ($flag)
                                  <?php if ($j < $videoItems/2) {
                                    $j +=1;
                                    continue;
                                  } else {?>
                                  <?php $j +=1;?>
                                  <div slide-data="inner_{{$j}}_{{$k}}" class="videolib-detail">
                                   <div class="close-lib-btn"></div>
                                    <div class="banner dashboard-bg" style="display:none;background-image: url('{{$value->webBanner}}');">
                                    </div>
                                    <div class="video-lib-detail" data-video="{{$value->videoURL}}"></div>
                                  </div>
                                <?php } ?>
                                @endif
                              <?php } ?>
                           @endforeach
                       </div>
                      @else
                        <div class="videolib-slider">
                        <ul class="videolib-one">
                          <?php $j = 1; $flag = false; ?>
                           @foreach ($videoData as $key => $value)
                                @foreach ($value as $key => $val)
                                   <?php if (!is_numeric($key)){
                                       $flag = true;
                                       break;
                                   } ?>
                                   <li slide-data="inner_{{$j}}_{{$k}}">
                                     <img class="show-on-load" style="display:none;" src="{{$val->webThumbnail}}" alt="">
                                     <div class="video-btn" style="display:none;"></div>
                                   </li>
                                   <?php $j +=1;?>
                                 @endforeach
                                 @if ($flag)
                                 <?php $j +=1;?>
                                   <li slide-data="inner_{{$j}}_{{$k}}">
                                     <img class="show-on-load" style="display:none;" src="{{$value->webThumbnail}}" alt="">
                                       <div class="video-btn" style="display:none;"></div>
                                   </li>
                                 @endif
                             @endforeach
                        </ul>
                        <?php $j = 1; $flag = false;?>
                        @foreach ($videoData as $key => $value)
                             @foreach ($value as $key => $val)
                                 <?php if (!is_numeric($key)){
                                     $flag = true;
                                     break;
                                 } ?>
                                 <div slide-data="inner_{{$j}}_{{$k}}" class="videolib-detail">
                                  <div class="close-lib-btn"></div>
                                   <div class="banner dashboard-bg" style="display:none;background-image: url({{$val->webBanner}});">
                                   </div>
                                   <div class="video-lib-detail" data-video="{{$val->videoURL}}"></div>
                                 </div>
                                 <?php $j +=1;?>
                              @endforeach
                              @if ($flag)
                               <?php $j +=1; ?>
                                <div slide-data="inner_{{$j}}_{{$k}}" class="videolib-detail">
                                 <div class="close-lib-btn"></div>
                                  <div class="banner dashboard-bg" style="display:none;background-image: url({{$value->webBanner}});">
                                  </div>
                                  <div class="video-lib-detail" data-video="{{$value->videoURL}}"></div>
                                </div>
                              @endif
                         @endforeach
                        </div>
                      @endif
      						 @endif
                 </div>
                 <?php $i +=1; ?>
              @endforeach
            @endif
          </div>
          <?php $k +=1; ?>
        </div>
        @endforeach
      @endif
  </div>
@endsection

@push('scripts')
<script>

  $(document).ready(function (){

    $('body').addClass('videolib-page');
    $('.dashboard-bg').show();
    $('.video-btn').show();
    $('.show-on-load').show();
    $('.loader').hide();

    $('.access-btn').click(function () {
      window.location = 'subscription';
    });

    $('.video-lib-detail').click(function () {
        if ($(this).attr("id") == "free_sample"){
          var a = $(this).attr("data-video");
          $(".video-pop video").attr("src", a);
          $(".video-pop").simplePopup();
          $(".video-pop video").get(0).play();
        } else{
         @if (Session::get('userId') == null)
           window.location = 'login';
         @else
         var a = $(this).attr("data-video");
         $.ajax({
               url: 'check-subscription',
               type: 'POST',
               headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
               dataType: 'json',
               cache: false,
               data: {subscriptionCheck:"check"},
               success: function (data) {
                   if(data == 1)
                   {
                       window.location = 'subscription';
                   }
                   else
                   {
                     $(".video-pop video").attr("src", a);
                     $(".video-pop").simplePopup();
                     $(".video-pop video").get(0).play();
                   }
               }
              });
         @endif
       }
    });

    // function videoEnded() {
    //     alert('video ended');
    // }
    $('video').on('ended',function(){
      console.log('Video has ended!');
      $('.simplePopupBackground').removeAttr('style');
      $('.videolib-pop').removeAttr('style');

    });
  });
</script>
@endpush
