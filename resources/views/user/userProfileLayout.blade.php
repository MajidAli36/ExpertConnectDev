<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Expert Connect</title>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="{{ url('/img/favicon.ico') }}" type="image/x-icon" />
    <link rel="shortcut icon" href="{{ url('/img/favicon.png') }}" type="image/png" />
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700|Roboto:400,700" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('css/slick.css')}}" type="text/css" />
	<link rel="stylesheet" href="{{ asset('css/jquery.popVideo.css')}}" type="text/css" />
	<link rel="stylesheet" href="{{ asset('css/style.css')}}" type="text/css" />
	<link rel="stylesheet" href="{{ asset('css/profile.css')}}" type="text/css" />
	<link rel="stylesheet" href="{{ asset('css/media-screen.css')}}" type="text/css" />


	<script src="{{ asset('js/jquery.min.js')}}" type="text/javascript"></script>
	<script src="{{ asset('js/slick.min.js')}}" type="text/javascript"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="{{ asset('js/custom-responsive-tab.js') }}"></script>
	<script src="{{ asset('js/custom.js')}}" type="text/javascript"></script>
	<script src="{{ asset('js/custom/common.js')}}" type="text/javascript"></script>
	<style>
	.alert {
		padding: 15px;
		margin-bottom: 20px;
		border: 1px solid transparent;
		border-radius: 4px;
	}
		.alert-success {
			color: #3c763d;
			background-color: #dff0d8;
			border-color: #d6e9c6;
		}
		.alert-danger {
			color: #a94442;
			background-color: #f2dede;
			border-color: #ebccd1;
		}
	</style>
	
<!-- Google Tag Manager --> <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0], j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src= 'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f); })(window,document,'script','dataLayer','GTM-T6MQWFH');</script> <!-- End Google Tag Manager --></head>
<body class="profile-page">
	@include('user.userHeader')
	@yield('userProfileContent')
	@include('user.userFooter')
	<style>
		.loader{
			top:0px;
			left:0px;
			width:100%;
			bottom:0px;
			position:fixed;
			text-align:center;
			display:none;
			background-color:white;
		}
		.loader .wrap{
			top: 50%;
			left: 50%;
			position: absolute;
			transform: translate(-50%,-50%);
			text-align:center;
		}
		.loader .wrap p{
			font-weight: 900;
			margin-top:10px;
		}
	</style>
	<div class="loader">
		<div class="wrap">
			<img src="{{ url('/img/logo.png') }}" class="">
			<p>Loading...</p>
		</div>
	</div>
</body>
</html>