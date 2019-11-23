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
	@stack('styles')
	<link href="{{ asset('css/custom-tab.css') }}" rel="stylesheet" type="text/css" >
	<link href="{{ asset('css/manage-appointment.css') }}" rel="stylesheet" type="text/css" >
	<title>Expert Dashboard | Expert Connect </title>
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
</head>
<body class="video-call">
  @include('expert.tmpl.navbar')
	@yield('content')
	@include('common.footer_style_1')

<script src="{{ asset('js/jquery.min.js')}}" type="text/javascript"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{ asset('js/custom-responsive-tab.js') }}"></script>
  @stack('scripts')
</body>
</html>