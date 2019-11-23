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
	<link rel="stylesheet" type="text/css" href="{{ url('homepage/css/datepicker.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ url('homepage/css/style.css')}}">
    <link rel="icon" href="{{ url('/img/favicon.ico') }}" type="image/x-icon" />
    <link rel="shortcut icon" href="{{ url('/img/favicon.png') }}" type="image/png" />
    <title>Error</title>
    <!-- Start of expertconnect Zendesk Widget script -->
    <script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=9bf94185-1aa3-4b3c-b514-2f1686f4df39"> </script>
    <!-- End of expertconnect Zendesk Widget script -->	
	
<!-- Google Tag Manager --> <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0], j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src= 'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f); })(window,document,'script','dataLayer','GTM-T6MQWFH');</script> <!-- End Google Tag Manager --></head>
<body class="error">
    @include('common.navbar_style_1')
    <header class="header">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<img src="{{ url('homepage/images/error_icon.png')}}" alt="#">
					<h2>ERROR</h2>
				</div>
			</div>
		</div>
    </header>
    <section class="booking_section booking_section2">
		<img src="{{ url('homepage/images/left_shape.png')}}" alt="#" class="left">
		<img src="{{ url('homepage/images/right_shape.png')}}" alt="#" class="right">
		<span>
			<div class="container">
				<div class="row">
					<div class="col-12">
						<p>Oops! Looks like the ball is not in your court!<br>Don’t lose hope, please try again.</p>
					</div>
				</div>
			</div>
		</span>
    </section>
    @include('common.footer_style_1')
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <!-- <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script> -->
    <script type="text/javascript" src="{{ url('homepage/js/error.js')}}"></script>
    </body>
</html>