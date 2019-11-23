<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="{{ url('homepage/fonts/font-awesome.min.css')}}">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{ url('homepage/css/slick.css')}}"/>
	<link rel="stylesheet" type="text/css" href="{{ url('homepage/css/slick-theme.css')}}"/>
	<link rel="stylesheet" type="text/css" href="{{ url('homepage/css/style.css')}}">
    <link rel="icon" href="{{ url('/img/favicon.ico') }}" type="image/x-icon" />
    <link rel="shortcut icon" href="{{ url('/img/favicon.png') }}" type="image/png" />
	<title>Expert Connect</title>
	<!-- Start of expertconnect Zendesk Widget script -->
    <script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=9bf94185-1aa3-4b3c-b514-2f1686f4df39"> </script>
    <!-- End of expertconnect Zendesk Widget script -->

	<style type="text/css">
		.video_section .slick-slider {
		    min-height: 223px;
		}
	</style>
<!-- Google Tag Manager --> <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0], j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src= 'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f); })(window,document,'script','dataLayer','GTM-T6MQWFH');</script> <!-- End Google Tag Manager --></head>
<body class="profile">
	@include('common.navbar_style_1')
	<section class="price_section">
		<div class="container">
			<div class="row">
				<div class="col-12 col-sm-6">
					<h1>
						@if((isset($profile->data->profile_details->name)) && (!empty($profile->data->profile_details->name))) {{$profile->data->profile_details->name}} @endif
						<!-- <a href="#"><img src="{{ url('homepage/images/heart_icon.png') }}" alt="#" class="icon1"></a> <a href="#"><img src="{{ url('homepage/images/upload_icon.png') }}" alt="#" class="icon2"></a> -->
					</h1>
					<!-- <p><img src="{{ url('homepage/images/swizflag.png') }}" alt="#"> SWITZERLAND</p>-->
				</div>
				<div class="col-12 col-sm-6">
					<div class="block">
						<a href="{{ url('add-personal-details/'.$expert_id) }}">
							<button class="btn_yellow"><span>BOOK A VIDEO CALL</span></button>
						</a>		@if (session('success'))
                        <div class="alert alert-success" style="color: #3c763d;background-color: #dff0d8;border-color: #d6e9c6;padding: 15px;margin-bottom: 20px;border: 1px solid transparent;border-radius: 4px;">
                            {{ session('success') }}
                    	</div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger" style="color: #d61b1b;background-color: #f2dede;border-color: ##ebccd1;padding: 15px;margin-bottom: 20px;border: 1px solid transparent;border-radius: 4px;">
                            {{ session('error') }}
                    	</div>
                    @endif
						<!--
						<h4><b>@if((isset($profile->data->profile_details->price)) && (!empty($profile->data->profile_details->price))) ${{number_format($profile->data->profile_details->price,2)}} @endif </b> for 10 min</h4>
						-->
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="player_section">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12 padding_0">
					<div class="video_box">
						@if(isset($profile->data->profile_details->web_image))
							<img src="@if((isset($profile->data->profile_details->web_image)) && (!empty($profile->data->profile_details->web_image))) {{url($profile->data->profile_details->web_image)}} @endif" alt="#">
						@endif
						@if(isset($profile->data->profile_details->trailers))
							<span>
								<a href="#"><img video-src="{{url($profile->data->profile_details->trailers)}}"  src="{{url('/homepage/images/play_icon.png')}} " alt="#" class="play"></a>
							</span>
						@endif
					</div>
				</div>
			</div>
		</div>
	</section>
	@if(isset($profile->data->profile_details->videos) && count($profile->data->profile_details->videos) > 0)
	<section class="video_section video_section2">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<h3>Free Instructional Videos</h3>
					<div class="row">
						<div class="col-12">
							<div class="center slick-center">
								@foreach($profile->data->profile_details->videos as $videos )
									<div class="video_box">
										<span>
											<div class="play">
												<a><img video-src="{{$videos->video}}" src="{{url('/homepage/images/play_icon.png')}}" alt="#"></a>
											</div>
											<img src="{{url($videos->web_thumbnail)}}" alt="#">
											<!--
											<div class="text">
												<div class="row">
													<div class="col-6 padding_0">
														<p><b>ATP rotterdam - 2009</b></p>
														<p>vs / G. Dimitrov</p>
													</div>
												</div>
											</div>-->

										</span>
									</div>
								@endforeach

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	@endif
	<section class="playercat_section">
		<div class="container">
			<div class="row">
				<!--
				<div class="col-12 col-sm-4 playercat_section-inner">
					<img src="{{ url('homepage/images/icon__1.png') }}" alt="#">
					<h2>@if((isset($profile->data->profile_details->ranking)) && (!empty($profile->data->profile_details->ranking))) {{$profile->data->profile_details->ranking}} @endif</h2>
					<p>WORLD RANK</p>
				</div>
				-->
				<div class="col-12 col-sm-6 playercat_section-inner">
					<img src="{{ url('homepage/images/icon__2.png') }}" alt="#" style="padding-bottom:5px; ">
					<h2>@if((isset($profile->data->profile_details->country)) && (!empty($profile->data->profile_details->country))) <h2>{{strtoupper($profile->data->profile_details->country)}} @endif</h2>
					<p>Country</p>
				</div>

				<!--
				<div class="col-12 col-sm-4 playercat_section-inner">
					<img src="{{ url('homepage/images/icon__3.png') }}"  alt="#" >
					<h2>@if((isset($profile->data->profile_details->trophies)) && (!empty($profile->data->profile_details->trophies))) {{$profile->data->profile_details->trophies}} @endif</h2>
					<p>ATP rankings for 310 weeks</p>
				</div>
				-->
				<div class="col-12 col-sm-6 playercat_section-inner">
					<img src="{{ url('homepage/images/icon__3.png') }}"  alt="#" >
					<h2>@if((isset($profile->data->profile_details->highlights)) && (!empty($profile->data->profile_details->highlights))) {{$profile->data->profile_details->highlights}} @endif</h2>
					<p>Area of focus</p>
				</div>
			</div>
		</div>
	</section>
	@if(!empty($profile->data->profile_details->biography))
	<section class="biography_section">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<h3>Biography</h3>
					<p>@if((isset($profile->data->profile_details->biography)) && (!empty($profile->data->profile_details->biography))) {{$profile->data->profile_details->biography}} @endif </p>
				</div>
			</div>
		</div>
	</section>
	@endif
	@if(isset($profile->data->profile_details->images) && count($profile->data->profile_details->images) > 0)
	<section class="image_section">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<h3>Gallery</h3>
					<div class="responsive1">
						@foreach($profile->data->profile_details->images as $gallery )
						<div>
							<img src="{{ url($gallery->image)}}" alt="#">
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</section>
	@endif
	@if(count($random_expert) > 0)
	<section class="ace_section">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<h3>OTHER TOP EXPERTS</h3>
					<div class="row">
						<?php foreach($random_expert as $r_profiles){?>
						<div class="col-12 col-sm-4">
							<div class="video_box video_box1">
								<span>
									<!-- <div class="play">
										<a><img video-src="{{$r_profiles->trailers}}" src="../img/play-btn.png" alt="#"></a>
									</div> -->
									<a href="{{ url('experts_profile/'.$r_profiles->id) }}">
										<img src="{{url($r_profiles->image)}}" alt="#">
									</a>
									<div class="text">
										<div class="row">
											<div class="col-6 padding_0">
												<p><b>{{$r_profiles->name}}</b></p>
												<p>{{$r_profiles->country}}</p>
											</div>
											<div class="col-6 padding_0">
												<a href="{{ url('experts_profile/'.$r_profiles->id) }}" class="profile_link">View Profile</a>
											</div>
										</div>
									</div>
								</span>
							</div>
						</div>
						<?php }?>
					</div>
					<div class="row">
						<div class="col-12 text-center">
							<a href="{{url('experts')}}" class="btn_yellow"><span>View All</span></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	@endif
	@include('common.footer_style_1')


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<!-- <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script> -->
<script type="text/javascript" src="{{url('homepage/js/slick.min.js')}}"></script>
<!-- <script type="text/javascript" src="{{url('homepage/js/profile.min.js')}}"></script>-->

<script type="text/javascript">
	$('.center').slick({
	  centerMode: true,
	  centerPadding: '60px',
	  slidesToShow: 3,
	  autoplay: true,
  	  autoplaySpeed: 2000,
	  responsive: [
	    {
	      breakpoint: 768,
	      settings: {
	        arrows: true,
	        centerMode: true,
	        centerPadding: '40px',
	        slidesToShow: 2
	      }
	    },
	    {
	      breakpoint: 480,
	      settings: {
	        arrows: true,
	        centerMode: true,
	        centerPadding: '20px',
	        slidesToShow: 1
	      }
	    }
	  ]
	});
</script>
<script type="text/javascript">
	$('.responsive1').slick({
	  centerMode: true,
	  centerPadding: '0px',
	  autoplay: true,
  	  autoplaySpeed: 1000,
	  slidesToShow: 2,
	  responsive: [
	    {
	      breakpoint: 768,
	      settings: {
	        arrows: true,
	        centerMode: true,
	        centerPadding: '0px',
	        slidesToShow: 2
	      }
	    },
	    {
	      breakpoint: 480,
	      settings: {
	        arrows: true,
	        centerMode: true,
	        centerPadding: '20px',
	        slidesToShow: 1
	      }
	    }
	  ]
	});
</script>
<script type="text/javascript">
	$(document).ready(function() {
		$('a[href*=\\#]').bind('click', function(e) {
				e.preventDefault(); // prevent hard jump, the default behavior

				var target = $(this).attr("href"); // Set the target as variable

				// perform animated scrolling by getting top-position of target-element and set it as scroll target
				$('html, body').stop().animate({
						scrollTop: $(target).offset().top
				}, 600, function() {
						location.hash = target; //attach the hash (#jumptarget) to the pageurl
				});

				return false;
		});
	});
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#nav-icon1').click(function(){
			$(this).toggleClass('open');
		});
	});
</script>
<script type="text/javascript">
	$(function() {
    var header = $(".nav_section2");

    $(window).scroll(function() {
        var scroll = $(window).scrollTop();
        if (scroll >= 50) {
            header.addClass("scrolled");
        } else {
            header.removeClass("scrolled");
        }
    });

});


	$(document).ready(function(){
		$('.video_section .video_box .play img').click(function(){
			var videoSrc = $(this).attr('video-src');
			// checkSubscription('{{csrf_token()}}',function (status){
			// 	if(status == 1){
			// 		window.location = '/subscription';
			// 	}else{
					$('body').append('<div class="slider-iframe"><iframe allowfullscreen autoplay src='+ videoSrc +'?autoplay=1 allowfullscreen></iframe><div class="video-close">X</div></div>').css('overflow', 'hidden');
					jQuery('.video-close').click(function(){
						jQuery(".slider-iframe").remove();
						$('body').css('overflow', 'auto');
					});
			// 	}
			// })

		});
	});

	$(document).ready(function(){
		$('.player_section .video_box a img').click(function(){
			var videoSrc = $(this).attr('video-src');
			// checkSubscription('{{csrf_token()}}',function (status){
			// 	if(status == 1){
			// 		window.location = '/subscription';
			// 	}else{
					$('body').append('<div class="slider-iframe"><iframe allowfullscreen autoplay src='+ videoSrc +'?autoplay=1></iframe><div class="video-close">X</div></div>').css('overflow', 'hidden');

					jQuery('.video-close').click(function(){
						jQuery(".slider-iframe").remove();
						$('body').css('overflow', 'auto');
					});
			// 	}
			// });
		});
	});

	$(document).ready(function(){
		$('.ace_section .video_box1 .play img').click(function(){
			var videoSrc = $(this).attr('video-src');
			// checkSubscription('{{csrf_token()}}',function (status){
			// 	if(status == 1){
			// 		window.location = '/subscription';
			// 	}else{
					$('.ace_section .video_box1 .play').append('<div class="box-iframe"><iframe allowfullscreen autoplay src='+ videoSrc +'?autoplay=1></iframe><div class="video-close">X</div></div>').css('overflow', 'hidden');

					jQuery('.video-close').click(function(){
						jQuery(".box-iframe").remove();
						$('body').css('overflow', 'auto');
					});
			// 	}
			// });
		});
	});
	$(document).ready(function(){
		$('.ace_section .video_box2 .play img').click(function(){
			var videoSrc = $(this).attr('video-src');
			// checkSubscription('{{csrf_token()}}',function (status){
			// 	if(status == 1){
			// 		window.location = '/subscription';
			// 	}else{
					$('.ace_section .video_box2 .play').append('<div class="box-iframe"><iframe allowfullscreen autoplay src='+ videoSrc +'?autoplay=1></iframe><div class="video-close">X</div></div>').css('overflow', 'hidden');

					jQuery('.video-close').click(function(){
						jQuery(".box-iframe").remove();
						$('body').css('overflow', 'auto');
					});
			// 	}
			// });
		});
	});
	$(document).ready(function(){
		$('.ace_section .video_box3 .play img').click(function(){
			var videoSrc = $(this).attr('video-src');
			// checkSubscription('{{csrf_token()}}',function (status){
			// 	if(status == 1){
			// 		window.location = '/subscription';
			// 	}else{
					$('.ace_section .video_box3 .play').append('<div class="box-iframe"><iframe allowfullscreen autoplay src='+ videoSrc +'?autoplay=1></iframe><div class="video-close">X</div></div>').css('overflow', 'hidden');

					jQuery('.video-close').click(function(){
						jQuery(".box-iframe").remove();
						$('body').css('overflow', 'auto');
					});
			// 	}
			// });
		});
	});
	$(document).ready(function(){
		$('.ace_section .video_box4 .play img').click(function(){
			var videoSrc = $(this).attr('video-src');
			// checkSubscription('{{csrf_token()}}',function (status){
			// 	if(status == 1){
			// 		window.location = '/subscription';
			// 	}else{
					$('.ace_section .video_box4 .play').append('<div class="box-iframe"><iframe allowfullscreen autoplay src='+ videoSrc +'?autoplay=1></iframe><div class="video-close">X</div></div>').css('overflow', 'hidden');

					jQuery('.video-close').click(function(){
						jQuery(".box-iframe").remove();
						$('body').css('overflow', 'auto');
					});
			// 	}
			// });
		});
	});
</script>
<script src="{{ asset('js/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/custom/common.js')}}" type="text/javascript"></script>
<script>
</script>
</body>
</html>
