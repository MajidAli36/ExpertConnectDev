<?php
//echo json_encode($current_request);
?>
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
	<title>Expert Connect</title>
	<!-- Start of expertconnect Zendesk Widget script -->
    <script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=9bf94185-1aa3-4b3c-b514-2f1686f4df39"> </script>
    <!-- End of expertconnect Zendesk Widget script -->	
	
<!-- Google Tag Manager --> <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0], j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src= 'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f); })(window,document,'script','dataLayer','GTM-T6MQWFH');</script> <!-- End Google Tag Manager --></head>
<body class="video-call-review">
<header class="header" style="background-image:url({{ url(isset($current_request['expertProfile']->data->profile_details->image)?$current_request['expertProfile']->data->profile_details->image:'') }});">	<div class="container">
			<div class="row">
				<div class="col-12">
					<h2>Book a video call with {{ $current_request['expertProfile']->data->profile_details->name }}</h2>
					@if(isset($current_request['expertProfile']->data->profile_details->price))
						<p><b>${{ number_format($current_request['expertProfile']->data->profile_details->price,2) }} </b> for 10 min</p>
					@endif
				</div>
			</div>
		</div>
	</header>
	<section class="booking_section">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<h4>{{ $current_request['userProfile']->data->user_details->name }},</h4>
					<p>You are just a two steps away from connecting with your favourite expert.</p>
					<ul class="step list-inline">
						<li class="list-inline-item active">
							<a href="#">
								<span><img  src="{{ url('homepage/images/ball_icon.png')}}" alt="#"></span><br>
								FIll in the details
							</a>
						</li>
						<li class="list-inline-item active">
							<a href="#">
								<span><img  src="{{ url('homepage/images/ball_icon.png')}}" alt="#"></span><br>
								ADD card
							</a>
						</li>
						<li class="list-inline-item active">
							<a href="#">
								<span><img  src="{{ url('homepage/images/ball_icon.png')}}" alt="#"></span><br>
								review & PAy
							</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="row">
				<form method="POST" action="{{ url('makePayment') }}">
					<div class="col-12">
					
						<div class="review_box">
							<h5>Card details</h5>
							<div class="row">
								<div class="col-12 col-sm-4">
									<p>Card number:</p>
								</div>
								<div class="col-12 col-sm-8">
									<p><span>
										@if((!empty($current_request['card_data']['card_number'])))
											{{ $current_request['card_data']['card_number'] }}
										<img  src="{{ url('homepage/images/card_2.png')}}" alt="#">
										@endif
									</span></p>
								</div>
							</div>
							<div class="row">
								<div class="col-12 col-sm-4">
									<p>Expiry:</p>
								</div>
								<div class="col-12 col-sm-8">
									<p><span>
										@if(isset($current_request['card_data']['card_number']))
											{{$current_request['card_data']['exp_month']}}
										@endif/@if(isset($current_request['card_data']['exp_year']))
											{{$current_request['card_data']['exp_year']}}
										@endif
									</span></p>
								</div>
							</div>
							<div class="row">
								<div class="col-12 col-sm-4">
									<p>CVV:</p>
								</div>
								<div class="col-12 col-sm-8">
									<p><span>
									@if(isset($current_request['card_data']['cvv']))
										{{ $current_request['card_data']['cvv'] }}
									@endif</span></p>
								</div>
							</div>
							<div class="row">
								<div class="col-12 col-sm-4">
									<p>Card holder’s name:</p>
								</div>
								<div class="col-12 col-sm-8">
									<p><span>{{ isset($current_request['card_data']['credit_card_holder_name'])?$current_request['card_data']['credit_card_holder_name']:'' }}</span></p>
								</div>
							</div>
						</div>
						<div class="review_box">
							<h5>billing details</h5>
							<div class="row">
								<div class="col-12 col-sm-4">
									<p>First Name:</p>
								</div>
								<div class="col-12 col-sm-8">
									<p><span>{{ isset($current_request['billing_data']['billing_first_name'])?$current_request['billing_data']['billing_first_name']:'' }}</span></p>
								</div>
							</div>
							<div class="row">
								<div class="col-12 col-sm-4">
									<p>last name:</p>
								</div>
								<div class="col-12 col-sm-8">
									<p><span>{{ isset($current_request['billing_data']['billing_last_name'])?$current_request['billing_data']['billing_last_name']:'' }}</span></p>
								</div>
							</div>
							<div class="row">
								<div class="col-12 col-sm-4">
									<p>billing address:</p>
								</div>
								<div class="col-12 col-sm-8">
									<p><span>{{ isset($current_request['billing_data']['billing_address'])?$current_request['billing_data']['billing_address']:'' }}</span></p>
								</div>
							</div>
							<div class="row">
								<div class="col-12 col-sm-4">
									<p>City:</p>
								</div>
								<div class="col-12 col-sm-8">
									<p><span>{{ isset($current_request['billing_data']['billing_city'])?$current_request['billing_data']['billing_city']:'' }}</span></p>
								</div>
							</div>
							<div class="row">
								<div class="col-12 col-sm-4">
									<p>State:</p>
								</div>
								<div class="col-12 col-sm-8">
									<p><span>{{ isset($current_request['billing_data']['billing_state'])?$current_request['billing_data']['billing_state']:'' }}</span></p>
								</div>
							</div>
							<div class="row">
								<div class="col-12 col-sm-4">
									<p>ZIp code:</p>
								</div>
								<div class="col-12 col-sm-8">
									<p><span>{{ isset($current_request['billing_data']['zipCode'])?$current_request['billing_data']['zipCode']:'' }}</span></p>
								</div>
							</div>
						</div>
						<div class="review_box">
							<h5>Shipping details</h5>
							<div class="row">
								<div class="col-12 col-sm-4">
									<p>First Name:</p>
								</div>
								<div class="col-12 col-sm-8">
									<p><span>{{ isset($current_request['shipping_data']['shipping_first_name'])?$current_request['shipping_data']['shipping_first_name']:'' }}</span></p>
								</div>
							</div>
							<div class="row">
								<div class="col-12 col-sm-4">
									<p>last name:</p>
								</div>
								<div class="col-12 col-sm-8">
									<p><span>{{ isset($current_request['shipping_data']['shipping_last_name'])?$current_request['shipping_data']['shipping_last_name']:'' }}</span></p>
								</div>
							</div>
							<div class="row">
								<div class="col-12 col-sm-4">
									<p>shipping address:</p>
								</div>
								<div class="col-12 col-sm-8">
									<p><span>{{ isset($current_request['shipping_data']['shipping_address'])?$current_request['shipping_data']['shipping_address']:'' }}</span></p>
								</div>
							</div>
							<div class="row">
								<div class="col-12 col-sm-4">
									<p>City:</p>
								</div>
								<div class="col-12 col-sm-8">
									<p><span>{{ isset($current_request['shipping_data']['shipping_city'])?$current_request['shipping_data']['shipping_city']:'' }}</span></p>
								</div>
							</div>
							<div class="row">
								<div class="col-12 col-sm-4">
									<p>State:</p>
								</div>
								<div class="col-12 col-sm-8">
									<p><span>{{ isset($current_request['shipping_data']['shipping_state'])?$current_request['shipping_data']['shipping_state']:'' }}</span></p>
								</div>
							</div>
							<div class="row">
								<div class="col-12 col-sm-4">
									<p>ZIP code:</p>
								</div>
								<div class="col-12 col-sm-8">
									<p><span>{{ isset($current_request['shipping_data']['shipping_zipcode'])?$current_request['shipping_data']['shipping_zipcode']:'' }}</span></p>
								</div>
							</div>
							
						</div>
						<div class="input_form">
							<label class="label2">I accept the terms and conditions*
							  <input type="checkbox" name="check" required>
							  <span class="checkmark"></span>
							</label>
						</div>
						<div class="text-center">
							<div class="text-center">
							{{ csrf_field() }}
							<button class="btn_white" type="reset"> CANCEL</button>
							<button class="btn_submit btn_yellow" type="submit"><span>MAKE PAYMENT</span></button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</section>
    @include('common.footer_style_1')
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<!-- <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script> -->
<script type="text/javascript" src="{{url('homepage/js/slick.min.js')}}"></script>
<script type="text/javascript" src="{{url('homepage/js/video-call-review.js')}}"></script>

</body>
</html>