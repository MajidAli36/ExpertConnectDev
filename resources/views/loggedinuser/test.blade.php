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

  <div class="top" id="home">
    <div class="banner dashboard-bg" style="background-image: url(img/dashboard-bg.jpg)">
      <div class="dashboard-banner">
        <div class="dashboard-banner-text content">
          <h2>Todays Release</h2>
          <p>Choose what to do do next</p>
        </div>
      </div>
      @if (!empty($today_release))
        <div class="video-banner" data-video="{{$today_release->video_url}}"></div>
        <!-- video autoplay="" loop="" muted="">
  				<source src="{{$today_release->video_url}}" type="video/mp4">
  			  	Your browser does not support HTML5 video.
  			</video -->
      @else
        <div class="video-banner" data-video="https://expertconnect.pro/homepage/images/hero.mp4"></div>
        <video autoplay="" loop="" muted="">
  				<source src="https://expertconnect.pro/homepage/images/hero.mp4" type="video/mp4">
  			  	Your browser does not support HTML5 video.
  			</video>
      @endif
    </div>
  </div>
  <div class="wrapper">
		<div class="video-pop videolib-pop simplePopup">
   		<video src="https://www.w3schools.com/html/movie.mp4" loop controls controlsList="nodownload"></video>
   	</div>
   	<div class="tab-div"> <?php $k=1; ?>
      @if (!empty($mainMenus))
       @foreach ($mainMenus as $mainMenu)
        <div class="tab-data">
        	<h2 class="title">{{$mainMenu}}</h2>
  		   	<ul class="be-select-tab">
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
            @if ($category != "")
             <?php $i = 1; ?>
              @foreach($category as $subCategory)
                @if ($i == 1)
                  <li class="clickme active"><a data-tag="{{$i.$k}}">{{$subCategory}}</a></li>
                @else
                  <li class="clickme"><a data-tag="{{$i.$k}}">{{$subCategory}}</a></li>
                @endif
                <?php $i +=1 ?>
              @endforeach
            @endif
  		    </ul>
          <?php $i = 1; ?>
  		    <div class="tab-container">
  	        @foreach ($category as $subCategory)
              <div class="list show-tab" id="{{$i.$k}}">
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
                    <div class="videolib-slider">
						           <ul class="videolib-one">
                         <?php $j = 1; $flag = false; ?>
                          @foreach ($videoData as $key => $value)
                               @foreach ($value as $key => $val)
                                  <?php if (!is_numeric($key)){
                                      $flag = true;
                                      break;
                                  } ?>
                                  <li slide-data="{{$j.$k}}">
                                    <img src="{{$val->videoThumnails1}}" alt="">
                                    <div class="video-btn"></div><div class="video-btn"></div>
                                    <strong>{{$val->menuHeading}}</strong>
                                  </li>
                                  <?php{{$j +=1}}?>
                                @endforeach
                                @if ($flag)
                                <?php{{$j +=1}}?>
                                  <li slide-data="{{$j.$k}}">
                                    <img src="{{$value->videoThumnails1}}" alt="">
                                      <div class="video-btn"></div><div class="video-btn"></div>
                                      <strong>{{$value->menuHeading}}</strong>
                                  </li>
                                @endif
                          @endforeach

                       </ul>
                       <?php $j = 1; $flag = false?>
                       @foreach ($videoData as $key => $value)
                            @foreach ($value as $key => $val)
                                <?php if (!is_numeric($key)){
                                    $flag = true;
                                    break;
                                } ?>
                                <div slide-data="{{$j.$k}}" class="videolib-detail">
                								 <div class="close-lib-btn"></div>
                  								<div class="banner dashboard-bg" style="background-image: url({{$val->videoThumnails}});">
                  									<div class="dashboard-banner">
                  						        <div class="dashboard-banner-text">
                  							        <h2>{{$val->menuHeading}}</h2>
                  							        <p>{{$val->menuDescription}}</p>
                  						        </div>
                  						     	</div>
                  								</div>
            								      <div class="video-lib-detail" data-video="{{$val->videoURL}}"></div>
            							      </div>
                                <?php{{$j +=1}}?>
                             @endforeach
                             @if ($flag)
                              <?php{{$j +=1}}?>
                               <div slide-data="{{$j.$k}}" class="videolib-detail">
                                <div class="close-lib-btn"></div>
                                 <div class="banner dashboard-bg" style="background-image: url({{$value->videoThumnails}});">
                                   <div class="dashboard-banner">
                                     <div class="dashboard-banner-text">
                                       <h2>{{$value->menuHeading}}</h2>
                                       <p>{{$value->menuDescription}}</p>
                                     </div>
                                   </div>
                                 </div>
                                 <div class="video-lib-detail" data-video="{{$value->videoURL}}"></div>
                               </div>
                             @endif
                        @endforeach
    						    </div>
    						<!-- div class="videolib-slider">
    							<ul class="videolib-two">
    								<li slide-data="1"><img src="img/arantxa.jpg" alt=""><div class="video-btn"></div><strong>Tim Mayotte<span>Tennis Player</span></strong></li>
    								<li slide-data="2"><img src="img/nadia.jpg" alt=""><div class="video-btn"></div><strong>Tim Mayotte<span>Tennis Player</span></strong></li>
    								<li slide-data="3"><img src="img/emilio.jpg" alt=""><div class="video-btn"></div><strong>Tim Mayotte<span>Tennis Player</span></strong></li>
    								<li slide-data="4"><img src="img/julian.jpg" alt=""><div class="video-btn"></div><strong>Tim Mayotte<span>Tennis Player</span></strong></li>
    							</ul>
    							<div slide-data="1" class="videolib-detail">
    								<div class="close-lib-btn"></div>
    								<div class="banner dashboard-bg" style="background-image: url(img/dashboard-bg.jpg);">
    									<div class="dashboard-banner">
    						        <div class="dashboard-banner-text">
    							        <h2>Rafa Nadal</h2>
    							        <p>Lorem ipsum dolor sit amet, consectetur adipiscing
    											elit. Proin efficitur et lorem eu malesuada.</p>
    						        </div>
    						     	</div>
    								</div>
    								<div class="video-lib-detail" data-video="http://clips.vorwaerts-gmbh.de/VfE_html5.mp4"></div>
    							</div>
    							<div slide-data="2" class="videolib-detail">
    								<div class="close-lib-btn"></div>
    								<div class="banner dashboard-bg" style="background-image: url(img/dashboard-bg.jpg);">
    									<div class="dashboard-banner">
    						        <div class="dashboard-banner-text">
    							        <h2>Rafa Nadal</h2>
    							        <p>Lorem ipsum dolor sit amet, consectetur adipiscing
    											elit. Proin efficitur et lorem eu malesuada.</p>
    						        </div>
    						     	</div>
    								</div>
    								<div class="video-lib-detail" data-video="http://clips.vorwaerts-gmbh.de/VfE_html5.mp4"></div>
    							</div>
    							<div slide-data="3" class="videolib-detail">
    								<div class="close-lib-btn"></div>
    								<div class="banner dashboard-bg" style="background-image: url(img/dashboard-bg.jpg);">
    									<div class="dashboard-banner">
    						        <div class="dashboard-banner-text">
    							        <h2>Rafa Nadal</h2>
    							        <p>Lorem ipsum dolor sit amet, consectetur adipiscing
    											elit. Proin efficitur et lorem eu malesuada.</p>
    						        </div>
    						     	</div>
    								</div>
    								<div class="video-lib-detail" data-video="http://clips.vorwaerts-gmbh.de/VfE_html5.mp4"></div>
    							</div>
    							<div slide-data="4" class="videolib-detail">
    								<div class="close-lib-btn"></div>
    								<div class="banner dashboard-bg" style="background-image: url(img/dashboard-bg.jpg);">
    									<div class="dashboard-banner">
    						        <div class="dashboard-banner-text">
    							        <h2>Rafa Nadal</h2>
    							        <p>Lorem ipsum dolor sit amet, consectetur adipiscing
    											elit. Proin efficitur et lorem eu malesuada.</p>
    						        </div>
    						     	</div>
    								</div>
    								<div class="video-lib-detail" data-video="http://clips.vorwaerts-gmbh.de/VfE_html5.mp4"></div>
    							</div>
    						</div-->
    	           @endif
               </div>
               <?php $i +=1; ?>
            @endforeach
          </div>
          <?php $k +=1; ?>
        </div>
        @endforeach
      @endif
  </div>
@endsection
