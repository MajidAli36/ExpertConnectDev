<!DOCTYPE html>
<html> 
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="cache-control" content="no-cache" />
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
		/*.btn-primary{ 
			background-color: transparent;
			border: 0 !important;
		}
		.btn-primary:hover{ 
			background-color: transparent;
			border-bottom: 2px solid #BDC92B !important;
			border-radius: 0 !important;
		}
		.btn-primary:active, .btn-primary:not(:disabled):not(.disabled).active, .btn-primary:not(:disabled):not(.disabled):active, .show>.btn-primary.dropdown-toggle{
			background-color: transparent;
			border: 0 !important;
		}
		.btn-primary:focus, .navbar-dark .navbar-nav .nav-item .show:focus{
			outline: none !important;
			box-shadow: 0 0 0 !important;
		}*/
	</style>
<!-- Google Tag Manager --> <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0], j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src= 'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f); })(window,document,'script','dataLayer','GTM-T6MQWFH');</script> <!-- End Google Tag Manager --></head>
<body class="listing-v2">
	@include('common.navbar_style_1')
	<header class="header headerv2">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<h2>Meet the experts</h2>
					<div class="slider">
						<div class="center">
							<?php
							$exp_count = 0;
							foreach($experts_list as $key => $experts){
								if($experts->menuType != "EXPERT_DROPDOWN") continue;
								$exp_count++;
								?>
								<div class="item">
									<div class="col-in" href="#menu{{ $key }}" bgTargetColor="#BDC92B">
										<img src="{{url($experts->menu_icon_url)}}" style="width:33px;" alt="#" class="icon icon1">
										<p>{{$experts->menuHeading}}</p>
										<img src="{{url('homepage/images/angledown.png')}}" alt="#" class="angle">
									</div>
								</div>
							<?php }?>

								<!-- <div class="item">
								<div class="col-in" href="#menu12" bgTargetColor="#BDC92B">
									<img src="{{url('homepage/images/v2icon4.png')}}" alt="#" class="icon icon4">
									<p>Legends of the game</p>
									<img src="{{url('homepage/images/angledown.png')}}" alt="#" class="angle">
								</div>
							</div>
							<div class="item">
								<div class="col-in" href="#menu10" bgTargetColor="#BDC92B">
									<img src="{{url('homepage/images/v2icon5.png')}}" alt="#" class="icon icon5">
									<p>Today’s stars</p>
									<img src="{{url('homepage/images/angledown.png')}}" alt="#" class="angle">
								</div>
							</div>
							<div class="item">
								<div class="col-in" href="#menu15" bgTargetColor="#BDC92B">
									<img src="{{url('homepage/images/v2icon2.png')}}" alt="#" class="icon icon1">
									<p>Diet and nutrition</p>
									<img src="{{url('homepage/images/angledown.png')}}" alt="#" class="angle">
								</div>
							</div> -->

						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
	<section class="slider_content">
		<div class="yellowbox"></div>
		<?php foreach($experts_list as $key => $experts){
			if($experts->menuType != "EXPERT_DROPDOWN") continue;?>
		<div class="contentbox {{ $key == 0?'active':'' }}" id="menu{{ $key }}">
			<h3>{{$experts->menuHeading}}</h3>
			<div class="container">
				<div class="row">
					<?php 

						$count = count($experts->menu_items);
						// if($count == 1 ){ $cou = 1; $class = "";}
						// else if($count == 2 ){ $cou = 2;$class = "col-sm-6";}
						// else { 
							$class = "col-sm-4"; $cou = 4;
						// }
					?>
					<?php foreach($experts->menu_items as $items){ ?>
						<div class="col-12 {{ $class }}">
							<div class="box">
								<a href="{{ url('experts_profile/'.$items->id)}}">
									<img src="{{ $items->image }}" alt="#">
								</a>
								<h4>{{ $items->name}}</h4>
								<p class="country">{{ $items->country}}</p>
								<p>{{ Helpers::limitBio($items->biography) }}</p>
								<a href="{{ url('experts_profile/'.$items->id)}}" class="profilelink">VIEW PROFILE</a>
							</div>
						</div>
					<?php }?>
				</div>
			</div>
		</div>
		<?php } ?>
	</section>

    @include('common.footer_style_1')


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<!-- <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script> -->
<script type="text/javascript" src="{{url('homepage/js/slick.min.js')}}"></script>
<script type="text/javascript" src="{{url('homepage/js/listining-v2.js')}}"></script>
	
	<script src="{{ asset('js/jquery.min.js')}}" type="text/javascript"></script>
	<script src="{{ asset('js/custom/common.js')}}" type="text/javascript"></script>

<script>

var auto_counter = false;
var exp_count = {{ $exp_count }};
var animation_time = 500;
$(document).ready(function(){
	var counter = parseInt(getCookie('menu_counter'));
	if(!counter || counter==""){counter = 0; }
	auto_counter = true;
	$('.slick-prev').hide();
	$('.slick-next').hide();
		gotopos(0,counter,function(){
			auto_counter = false;
			$('.slick-prev').show();
			$('.slick-next').show();
		})
})


$(document).on('click','.slick-prev',function(){
	if(auto_counter == false){
		auto_counter = true;
		var counter = parseInt(getCookie('menu_counter'));
		if(!counter || counter==""){counter = 0; }
		counter--;
		if(counter == -(exp_count)){
			counter = 0;	
		}
		setCookie("menu_counter", counter, 0.2);
		setTimeout(() => {
			auto_counter = false;
		}, animation_time);
	}
})
$(document).on('click','.slick-next',function(){
	if(auto_counter == false){
		auto_counter = true;
		var counter = parseInt(getCookie('menu_counter'));
		if(!counter || counter==""){counter = 0; }
		counter++;
		if(counter >= (exp_count)){
			counter = 0;	
		}
		setCookie("menu_counter", counter, 0.2)
		setTimeout(() => {
			auto_counter = false;
		}, animation_time);
	}
})
function gotopos(index,pos,callback){
	if(index == pos){
		callback();
	}else if(index < pos){
		$('.slick-next').trigger('click');
		setTimeout(function(){
			gotopos(index + 1,pos,callback);
		},animation_time);
	}else{
		if(index > pos){
		$('.slick-prev').trigger('click');
		setTimeout(function(){
			gotopos(index ,pos + 1,callback);
		},animation_time);
	}
	}
}
</script>
</body>
</html>