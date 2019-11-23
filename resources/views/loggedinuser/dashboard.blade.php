
@extends('loggedinuser.app')
@push('styles')
	<link rel="stylesheet" href="{{ asset('css/dashboard.css')}}" type="text/css" />
@endpush

@section('content')
<div class="top" id="home">
	<div class="banner dashboard-bg" style="background-image: url(img/dashboard-bg.jpg)">
		<div class="dashboard-banner">
	        <form action="">
		        <h2>Expert Connect</h2>
		        <p>Choose what to do do next</p>
		        <a href="">Video Connect</a>
		        <a href="{{ url('videolibrary') }}" class="lib-btn">Library</a>
	        </form>
 		</div>
		<video autoplay="" loop="" muted="">
			<source src="https://expertconnect.pro/homepage/images/hero_v2.mp4" type="video/mp4">
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
<script type="text/javascript">

	$("document").ready(function(){
		$('body').addClass('dashboard-page');
	});

</script>
@endpush 
