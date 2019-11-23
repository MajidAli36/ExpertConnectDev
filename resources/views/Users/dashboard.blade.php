@php
$userProfile = Session::get('userprofile');
@endphp
@extends('loggedinuser.app')
@push('styles')
	<link rel="stylesheet" href="{{ asset('css/dashboard.css')}}" type="text/css" />
	<link rel="stylesheet" type="text/css" href="{{ asset('/homepage/css/jquery.countdownTimer.css')}}">
@endpush

@section('content') 
<div class="top" id="home">
	<div class="banner dashboard-bg" style="background-image: url(img/dashboard-bg.jpg)">
		<div class="dashboard-banner">
	        <form action="">
		        <h2>Expert Connect</h2>
		        <p>Choose what to do do next</p>
		        <a href="{{ url('experts') }}" class="lib-btn">Video Connect</a>
		        <a href="{{ url('videolibrary') }}" class="lib-btn">Library</a>
				<a href="https://www.expertconnect-dev.pro/videocalltest" class="lib-btn clCall">Call</a>
				<span id="ms_timer"></span>
	        </form>
 		</div>
		<video autoplay="" loop="" muted="">
			<source src="{{url('https://s3.amazonaws.com/expertconnectvideos/WEBSITE+VIDEO+UPPER+RIGHT+CORNER.mp4')}}" type="video/mp4">
		  	Your browser does not support HTML5 video.
		</video>
	</div>
</div>
<div class="wrapper">
	<div class="content">
		<div class="inner">
			<div class="connect">
				<div class="box-thumb brd-right">
					<h3>Video Connect</h3>
					<p>Get reliable advice from the leaders simply through video call.</p>
				</div>
				<div class="box-thumb">
					<h3>Expert Video Library</h3>
					<p>The most comprehensive tennis video library</p>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
<script type="text/javascript" src="{{ asset('/homepage/js/jquery.countdownTimer.js')}}"></script>
<script type="text/javascript">

var myVar;
var tmFlag = true;
	$("document").ready(function(){
		$('body').addClass('dashboard-page');
		$('#ms_timer').hide();
		$('.clCall').hide();
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
				$('.clCall').show();
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
				$('.clCall').hide();
			}
		 }
		});

	 }	
</script>
@endpush 
