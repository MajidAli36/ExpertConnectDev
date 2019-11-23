<!DOCTYPE html>
<html>
   <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('/homepage/fonts/font-awesome.min.css')}}">
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ asset('/homepage/css/slick.css')}}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('/homepage/css/slick-theme.css')}}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('/homepage/css/style.css')}}">

        <script type="text/javascript" src="{{ asset('/homepage/js/jquery-2.0.3.js')}}"></script>
        <script type="text/javascript" src="{{ asset('/homepage/js/jquery.countdownTimer.js')}}"></script>
        <link rel="stylesheet" type="text/css" href="{{ asset('/homepage/css/jquery.countdownTimer.css')}}">
       

            <link rel="icon" href="{{ url('/img/favicon.ico') }}" type="image/x-icon" />
            <link rel="shortcut icon" href="{{ url('/img/favicon.png') }}" type="image/png" />
        <title>Expert Connect</title>
        <style>
            video::-internal-media-controls-download-button {
                display:none;
            }
            video::-webkit-media-controls-enclosure {
                overflow:hidden;
            }
            video::-webkit-media-controls-panel {
                width: calc(100% + 30px); /* Adjust as needed */
            }
        </style>
        <!-- Start of expertconnect Zendesk Widget script -->
    <script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=9bf94185-1aa3-4b3c-b514-2f1686f4df39"> </script>
<!-- End of expertconnect Zendesk Widget script -->
    <!-- Google Tag Manager --> <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0], j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src= 'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f); })(window,document,'script','dataLayer','GTM-T6MQWFH');</script> <!-- End Google Tag Manager --></head>
    <body class="home">
        @include('common.navbar_style_2')
        <header>
            <div class="video-col">
                <video autoplay muted loop id="myVideo">
                 <source src="{{ url('https://s3.amazonaws.com/expertconnectvideos/WEBSITE+VIDEO+UPPER+RIGHT+CORNER.mp4') }}" type="video/mp4" >
                  Your browser does not support HTML5 video.
                </video>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12">
                                <h1>connect with<br>the experts</h1>
                            </div>
                            <div class="col-12">
                                <ul class="list-inline">
                                     <li class="list-inline-item"><a href="{{ url('experts') }}" class="btn_yellow"><span>book a video call</span></a></li>
                                        <li class="list-inline-item"><a href="{{ url('videolibrary') }}" class="btn_yellow"><span>BROWSE VIDEO LIBRARY</span></a></li>
                                        <li class="list-inline-item"><a href="https://www.expertconnect-dev.pro/videocalltest" class="btn_yellow btn_call"><span>Call</span></a></li>
                                        <span id="ms_timer"></span>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <section class="video_section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12">
                                <div class="center">
                                    @foreach($allExperts as $experts)
                                        <div class="video_box">
                                            <span>
                                                <div class="play">
                                                    <a href="#"><img src="{{ url('/homepage/images/play_icon.png') }}" video-src="{{$experts->trailers}}"  alt="#"></a>
                                                </div>
                                                <img src="{{ $experts->image }}" alt="#">
                                                <div class="text">
                                                    <div class="row">
                                                        <div class="col-6 padding_0">
                                                            <p><b>{{ $experts->name}}</b></p>
                                                            <p>{{ $experts->country}}</p>
                                                        </div>
                                                        <div class="col-6 text-right padding_0">
                                                            <a href="{{ url('experts_profile/'.$experts->id)}}" class="profile_link">View Profile</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <a href="{{ url('experts') }}" class="btn_yellow"><span>VIEW All</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="text_section" >
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12">
                                <p>Expert Connect gives you the unique opportunity to connect with <br>
                                    the biggest names in tennis.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="connect_section" id="about">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-sm-6 padding_0">
                        <div class="vid_box" style="background-image: url({{ url('/homepage/images/video_1.png')}}">
                            <span>
                                <h3>Expert Video Connect</h3>
                                <p>Have a one-on-one video call<br>
                                    with your favourite experts.
                                </p>
                                <a href="{{ url('experts') }}" class="btn_yellow"><span>CONNECT NOW</span></a>
                            </span>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 padding_0">
                        <div class="vid_box" style="background-image: url({{ url('/homepage/images/video_2.png')}}">
                            <span>
                                <h3>Expert Video library</h3>
                                <p>Visit our comprehensive collection<br>
                                of insider star secrets
                                </p>
                                <a href="{{ url('videolibrary') }}" class="btn_yellow"><span>WATCH VIDEOS</span></a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="work_section" >
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                        @if($menu_data->success)
                            <div class="col-12 col-sm-5">
                                <h2>How does it work</h2>
                                <h3>Convenient and easy to use</h3>
                                <p>Simply log on to this application and connect with:-</p>
                                <ul>
                               
                                    @foreach($menu_data->data->menuData as $men_data)
                                        @if($men_data->menuType == "EXPERT_DROPDOWN")
                                            <li><img style="width: 33px;" src="{{ url($men_data->menu_icon_url) }}"  alt="#"> {{ $men_data->menuHeading}}</li>
                                        @endif
                                    @endforeach
                                
                                </ul>
                                <a href="{{ url('experts') }}" class="btn_yellow"><span>VIew all features</span></a>
                            </div>
                        @endif
                            <div class="col-12 col-sm-7">
                                <div class="center1">
                                    <div class="img_box">
                                        <img src="{{ url('/homepage/images/expert_2.jpg') }}" alt="#">
                                        <div class="headline">
                                            1. Login to Expert Connect
                                        </div>
                                    </div>
                                    <div class="img_box">
                                        <img src="{{ url('/homepage/images/expert_1.jpg') }}" alt="#">
                                        <div class="headline">
                                            2. Browse & select expert
                                        </div>
                                    </div>
                                    <div class="img_box">
                                        <img src="{{ url('/homepage/images/expert_3.jpg') }}" alt="#">
                                        <div class="headline">
                                            3. Schedule a call
                                        </div>
                                    </div>
                                    <div class="img_box">
                                        <img src="{{ url('/homepage/images/expert_4.jpg') }}" alt="#">
                                        <div class="headline">
                                            4. Get live expert advice
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="icon_section" id="feature">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12">
                                <h4>A place where you can get reliable advice from leaders of the sport on:</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <img src="{{ url('/homepage/images/icon1.png') }}" alt="#">
                                <p>technique</p>
                            </div>
                            <div class="col">
                                <img src="{{ url('/homepage/images/icon2.png') }}" alt="#">
                                <p>strategy</p>
                            </div>
                            <div class="col">
                                <img src="{{ url('/homepage/images/icon3.png') }}" alt="#">
                                <p>FItness</p>
                            </div>
                            <div class="col">
                                <img src="{{ url('/homepage/images/icon4.png') }}" alt="#">
                                <p>nutrition</p>
                            </div>
                            <div class="col">
                                <img src="{{ url('/homepage/images/icon5.png') }}" alt="#">
                                <p>injury prevention</p>
                            </div>
                            <div class="col">
                                <img src="{{ url('/homepage/images/icon6.png') }}" alt="#" style="margin-top: 18px;">
                                <p>COllege placements</p>
                            </div>
                            <div class="col">
                                <img src="{{ url('/homepage/images/icon7.png') }}" alt="#" style="margin-top: 22px;">
                                <p>Mental training</p>
                            </div>
                            <div class="col">
                                <img src="{{ url('/homepage/images/icon3.png') }}" alt="#" style="margin-top: 22px;">
                                <p>Tennis Equipment</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="gallery_section" id="library">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 col-sm-5">
                                <h3>Video library</h3>
                                <p>View our comprehensive video library and learn from the legends of the sport:</p>
                                <ul>
                                    <li>Grand slam champions share their technical and tactical secrets.</li>
                                    <li>Celebrity coaches and trainers show you the newest training patterns and drills</li>
                                    <li>From Nutrition to injury prevention all the way to racket selection...</li>
                                </ul>
                                <p>Our legendary experts cover hundreds of tennis related topics to take your game to THE NEXT LEVEL</p>
                            </div>
                            <div class="col-12 col-sm-7">
                                <div class="row">
                                    <div class="img_box">
                                        <span>
                                            <img src="{{ url('/homepage/images/gallery_1.png') }}" alt="#">
                                            <div class="anchor">
                                                <a href="#">Ground Strokes</a>
                                            </div>
                                        </span>
                                    </div>
                                    <div class="img_box">
                                        <span>
                                            <img src="{{ url('/homepage/images/gallery_2.png') }}" alt="#">
                                            <div class="anchor">
                                                <a href="#">Tactical</a>
                                            </div>
                                        </span>
                                    </div>
                                    <div class="img_box">
                                        <span>
                                            <img src="{{ url('/homepage/images/gallery_3.png') }}" alt="#">
                                            <div class="anchor">
                                                <a href="#">Tennis Specific Fitness</a>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="img_box">
                                        <span>
                                            <img src="{{ url('/homepage/images/gallery_4.png') }}" alt="#">
                                            <div class="anchor">
                                                <a href="#">Diet & nutrition</a>
                                            </div>
                                        </span>
                                    </div>
                                    <div class="img_box">
                                        <span>
                                            <img src="{{ url('/homepage/images/gallery_5.png') }}" alt="#">
                                            <div class="anchor">
                                                <a href="#">Mental training</a>
                                            </div>
                                        </span>
                                    </div>
                                    <div class="img_box">
                                        <span>
                                            <img src="{{ url('/homepage/images/gallery_6.png') }}" alt="#">
                                            <div class="anchor">
                                                <a href="#">College tennis placement</a>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                                <!--<div class="row">
                                    <div class="img_box">
                                        <span>
                                            <img src="{{ url('/homepage/images/gallery_4.png') }}" alt="#">
                                            <div class="anchor">
                                                <a href="#">Volleys & Overheads</a>
                                            </div>
                                        </span>
                                    </div>
                                    <div class="img_box">
                                        <span>
                                            <img src="{{ url('/homepage/images/gallery_4.png') }}" alt="#">
                                            <div class="anchor">
                                                <a href="#">Tennis Pro Shop</a>
                                            </div>
                                        </span>
                                    </div>
                                    <div class="img_box">
                                        <span>
                                            <img src="{{ url('/homepage/images/gallery_4.png') }}" alt="#">
                                            <div class="anchor">
                                                <a href="#">Serves & Returns</a>
                                            </div>
                                        </span>
                                    </div>
                                </div>-->
                                <div class="row">
                                    <div class="img_box">
                                        <span>
                                            <img src="{{ url('/homepage/images/gallery_8.jpg') }}" alt="#">
                                            <div class="anchor">
                                                <a href="#">Tennis Equipment</a>
                                            </div>
                                        </span>
                                    </div>
                                    <div class="col-12 col-sm-8 text-center">
                                        <a href="{{ url('videolibrary') }}"  class="btn_yellow"><span>VIEW ALL</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="expert_section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 col-sm-10">
                                <h3>Why Expert Connect?</h3>
                                <p>We believe that when it comes to getting the highest level of instruction and advice, distance and accessibility should no longer limit you in your quest. That’s why we created a place where you can get reliable advice from the leaders in the sport, simply through video call. Our detailed video library, brought to you by tennis greats, shares key tips on hundreds of topics. </p>
                                <p>Get the information you need to spark the change that will propel your game to THE NEXT LEVEL</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="app_section" id="download">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12">
                                <h3>DOWNLOAD THE APP AND START TO CONNECT</h3>
                                <ul class="list-inline">
                                    <li class="list-inline-item"><a href="#"><img src="{{ url('/homepage/images/apple.png') }}" alt="#"></a></li>
                                    <li class="list-inline-item"><a href="https://play.google.com/store/apps/details?id=com.hyperon.expertconnect.expertconnect" target="_blank"><img src="{{ url('/homepage/images/google.png') }}" alt="#"></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @include('common.footer_style_1');
        <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script> -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="{{ asset('/homepage/js/slick.min.js')}}"></script>
        <script type="text/javascript" src="{{ asset('/homepage/js/home.js')}}"></script>

 <script type="text/javascript">

var myVar;
var tmFlag = true;
$("document").ready(function(){
$('body').addClass('dashboard-page');
$('#ms_timer').hide();
$('.btn_call').hide();
setInterval(test, 5000); 
});
function test() {
    
    $.ajax({
		type:'GET',
		url:'https://www.expertconnect-dev.pro/getAppointments',
		data:{},
		success:function(data){
			
			if(data.flag == "1")
			{
				$('#ms_timer').hide();
				$('.btn_call').show();
			}
			else if(data.tm_flag == "1" && tmFlag == true)
			{
				tmFlag = false;
					$(function(){
						$('#ms_timer').show();
						$('#ms_timer').countdowntimer({
							minutes : data.tm_minutes,
							seconds : data.tm_seconds,
							size : "lg"
						});
					});
			}
            else if(data.tm_flag == "0" && data.flag == "0")
			{
				$('#ms_timer').hide();
				$('.btn_call').hide();
			}
            
            
		 }
		});

}




</script>


</body>
</html> 