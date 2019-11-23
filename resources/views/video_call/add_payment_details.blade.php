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
<body> <!-- Google Tag Manager (noscript) --> <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T6MQWFH" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript> <!-- End Google Tag Manager (noscript) -->
	@include('common.navbar_style_1')
	<header class="header" style="background-image:url({{ url(isset($current_request['expertProfile']->data->profile_details->image)?$current_request['expertProfile']->data->profile_details->image:'') }});">
		<div class="container">
			<div class="row">
				<div class="col-12">
				<?php 
					echo '<script>console.log('.json_encode($current_request).')</script>';
				?>
				<h2>Book a video call with {{ $current_request['expertProfile']->data->profile_details->name }}</h2>
				@if(isset($current_request['expertProfile']->data->profile_details->price))
					<p><b>${{ number_format($current_request['expertProfile']->data->profile_details->price,2)}} </b> for 10 min</p>
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
					@if (session('success'))
						<div class="alert alert-success" style="color: #3c763d;background-color: #dff0d8;border-color: #d6e9c6;padding: 15px;margin-bottom: 20px;border: 1px solid transparent;border-radius: 4px;">
								{{ session('success') }}
						</div>
					@endif
					@if (session('error'))
						<div class="alert alert-danger" style="color: #d61b1b;background-color: #f2dede;border-color: ##ebccd1;padding: 15px;margin-bottom: 20px;border: 1px solid transparent;border-radius: 4px;">
							{{ session('error') }}
						</div>
					@endif

					<ul class="step list-inline ">
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
						<li class="list-inline-item">
							<a href="#">
								<span><img  src="{{ url('homepage/images/ball_icon.png')}}" alt="#"></span><br>
								review & PAy
							</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="row">
				<form method="POST" action="{{ url('review-payment-details') }}" onSubmit="checkShipingAddr()">
					<div class="col-12">
						<div class="input_form" style="border-bottom: 1px solid black;margin-bottom: 45px;padding-bottom: 45px;">
							<div class="row">
								<div class="col-12 col-sm-6">
									<label class="label" for="paypal">Paypal<span color="red" style="font-size: 12px;"> (Comming Soon)</span>
									  <input type="radio" class="payment" id="paypal" name="payment" disabled="disabled">
									  <span class="checkmark"></span>
									</label>
								</div>
								<div class="col-12 col-sm-6">
									<img  src="{{ url('homepage/images/paypal_icon.png')}}" alt="#" class="paypalimg">
								</div>
							</div>
						</div>
						<div class="input_form">
							<div class="row">
								<div class="col-12 col-sm-6">
									<label class="label" for="credit">Credit card
									  <input type="radio" class="payment" id="credit" name="payment">
									  <span class="checkmark"></span>
									</label>
								</div>
								<div class="col-12 col-sm-6">
									<ul class="list-inline">
										<li class="list-inline-item"><a href="#"><img  src="{{ url('homepage/images/card_1.png')}}" alt="#"></a></li>
										<li class="list-inline-item"><a href="#"><img  src="{{ url('homepage/images/card_2.png')}}" alt="#"></a></li>
										<li class="list-inline-item"><a href="#"><img  src="{{ url('homepage/images/card_3.png')}}" alt="#"></a></li>
										<li class="list-inline-item"><a href="#"><img  src="{{ url('homepage/images/card_4.png')}}" alt="#"></a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="col-12">
						<div class="paypal">
							
						</div>
						<div class="credit" style="display: none;">
							<h5>Your card details</h5>
							<div class="input_form">
								<label>Card holder’s name</label>
								<input type="text" placeholder="Name on the card" name="credit_card_holder_name" required>
							</div>
							<div class="input_form">
								<label>Card number</label>
								<input type="number" placeholder="Credit card number" name="card_number" required>
							</div>
							<div class="row">
								<div class="col-12 col-sm-4">
									<div class="input_form">
										<label>CVV</label>
										<input type="number" placeholder="3/4 digit CVV"  name="cvv" required>
									</div>
								</div>
								<div class="col-12 col-sm-4">
									<div class="input_form">
										<label>Expiry Month</label>
										<select name="exp_month" required>
											<option value="01">01</option>
											<option value="02">02</option>
											<option value="03">03</option>
											<option value="04">04</option>
											<option value="05">05</option>
											<option value="06">06</option>
											<option value="07">07</option>
											<option value="08">08</option>
											<option value="09">09</option>
											<option value="10">10</option>
											<option value="11">11</option>
											<option value="12">12</option>
										</select>
									</div>
								</div>
								<div class="col-12 col-sm-4">
									<div class="input_form">
										<label>Expiry Year*</label>
										<select name="exp_year" required>
											<option value="2018">2018</option>
											<option value="2019">2019</option>
											<option value="2020">2020</option>
											<option value="2021">2021</option>
											<option value="2022">2022</option>
											<option value="2023">2023</option>
											<option value="2024">2024</option>
											<option value="2025">2025</option>
											<option value="2026">2026</option>
											<option value="2027">2027</option>
											<option value="2028">2028</option>
											<option value="2029">2029</option>
											<option value="2030">2030</option>
											<option value="2031">2031</option>
											<option value="2032">2032</option>
										</select>
									</div>
								</div>
							</div>
							<div>
		                        <h5>Billing Address</h5>
								<div class="row">
									<div class="col-12 col-sm-6">
										<div class="input_form">
											<label>First name*</label>
											<input type="text" placeholder="First Name" name="billing_first_name" required>
										</div>
									</div>
									<div class="col-12 col-sm-6">
										<div class="input_form">
											<label>last name*</label>
											<input type="text" placeholder="Last Name" name="billing_last_name" required>
										</div>
									</div>
								</div>
								<div class="row upperAddress">
									<div class="col-12 col-sm-4">
										<div class="input_form">
											<label>Country*</label>
											<select name="billing_state_country" class="country"  required>
												<option disabled selected>Please Select a Country</option>
													<?php 
													$country = $Country->data->country_details;
													foreach($country as $country_det){?>
														<option <?php if(isset($userProfile->user_details->country) && $country_det->id == $userProfile->user_details->country->id){echo "selected";}?> value="<?php echo $country_det->id?>"><?php echo $country_det->name;?></option>
													<?php }?>
											</select>
										</div>
									</div>
									<div class="col-12 col-sm-4">
										<div class="input_form" >
											<label>State*</label>
											<select name="billing_state" class="state" required>
												<option value="" selected disabled>Please Select a State</option>
											</select>
										</div>
									</div>
									<div class="col-12 col-sm-4">
										<div class="input_form" >
											<label>City*</label>
											<!-- <select name="billing_city" class="city"  required>
												<option value="" selected disabled>Please Select a City</option>
											</select> -->
											<input type="text" placeholder="City" name="b_city" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-12 col-sm-8">
										<div class="input_form">
											<label>Billing Address*</label>
											<input type="text" placeholder="Street address" name="billing_address" required>
										</div>
									</div>
									<div class="col-12 col-sm-4">
										<div class="input_form">
											<label>Billing Zip Code*</label>
											<input type="text" placeholder="Zip code" name="billing_zipcode" required>
										</div>
									</div>
								</div>
							</div>
							<div class="input_form">
								<label class="label2" for="billing">Shipping Address same as billing address
								  <input type="checkbox" name="billing" id="billing" required>
								  <span class="checkmark"></span>
								</label>
							</div>
							<div class="billing_info">
		                        <h5>Shipping Address</h5>
								<div class="row">
									<div class="col-12 col-sm-6">
										<div class="input_form">
											<label>First name*</label>
											<input type="text" placeholder="First Name" name="shipping_first_name">
										</div>
									</div>
									<div class="col-12 col-sm-6">
										<div class="input_form">
											<label>last name*</label>
											<input type="text" placeholder="Last Name" name="shipping_last_name">
										</div>
									</div>
								</div>
								<div class="row lowerAddress">
									<div class="col-12 col-sm-4">
										<div class="input_form">
											<label>Country*</label>
											<select name="shipping_country" class="country"  >
												<option disabled selected>Please Select a Country</option>
													<?php 
													$country = $Country->data->country_details; 
													foreach($country as $country_det){?>
														<option <?php if(isset($userProfile->user_details->country) && $country_det->id == $userProfile->user_details->country->id){echo "selected";}?> value="<?php echo $country_det->id?>"><?php echo $country_det->name;?></option>
													<?php }?>
											</select>
										</div>
									</div>
									<div class="col-12 col-sm-4">
										<div class="input_form" >
											<label>State*</label>
											<select name="shipping_state" class="state">
												<option value="" selected disabled>Please Select a State</option>
											</select>
										</div>
									</div>
									<div class="col-12 col-sm-4">
										<div class="input_form" >
											<label>City*</label>
											<!-- <select name="shipping_city" class="city"  >
												<option value="" selected disabled>Please Select a City</option>
											</select> -->
											<input type="text" placeholder="City" name="s_city" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-12 col-sm-8">
										<div class="input_form">
											<label>shipping Address*</label>
											<input type="text" placeholder="Street address" name="shipping_address">
										</div>
									</div>
									<div class="col-12 col-sm-4">
										<div class="input_form">
											<label>shipping Zip Code*</label>
											<input type="text" placeholder="Zip code" name="shipping_zipcode">
										</div>
									</div>
								</div>
							</div>
							<input type="hidden" value= "<?php echo csrf_token() ?>" name="_token">							
                    		<input type="hidden" name="_method" value="post">
							<div class="text-center">
								<button class="btn_white">cancel</button>
								<button class="btn_submit btn_yellow" type="submit"><span>Review Order</span></button>
							</div>
                        </div>
						
					</div>
				</form>
			</div>
		</div>
	</section>
	@include('common.footer_style_1')

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
			z-index:9999999;
		}
		.loader .wrap p{
			font-weight: 900;
			margin-top:10px;
		}
	</style>
	<div class="loader">
		<div class="wrap">
			<img src="/img/logo.png" class="">
			<p>Loading...</p>
		</div>
	</div>
	
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<!-- <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script> -->
<script src="{{url('homepage/js/video-call.js')}}"></script>

<script src="{{ asset('js/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('js/custom/common.js')}}" type="text/javascript"></script>
	

<script type="text/javascript">
function checkShipingAddr(){
	if($('#billing:checked').length>0){
		makeSameAddress();
	}
	return true;
}
var lockUpdate = false;
function makeSameAddress(){
	lockUpdate = true;
		$('.lowerAddress .country').html($('.upperAddress .country').html());
		$('.lowerAddress .state').html($('.upperAddress .state').html());
		$('.lowerAddress .city').html($('.upperAddress .city').html());

		$('.lowerAddress .country').val($('.upperAddress .country').val());
		$('.lowerAddress .state').val($('.upperAddress .state').val());
		$('.lowerAddress .city').val($('.upperAddress .city').val());

		$('input[name="shipping_first_name"]').val($('input[name="billing_first_name"]').val());
		$('input[name="shipping_last_name"]').val($('input[name="billing_last_name"]').val());
		$('input[name="shipping_address"]').val($('input[name="billing_address"]').val());
		$('input[name="shipping_zipcode"]').val($('input[name="billing_zipcode"]').val());
		$('input[name="s_city"]').val($('input[name="b_city"]').val());
	lockUpdate = false;
}



		$(document).on('change','.upperAddress .country',function(){
			var method = "POST";
			var url = "/get-state";
			var data = {country_id:$('.upperAddress .country').val(),_token : '<?php echo csrf_token() ?>'};
			startAjax(method,url,data,function(data){
				handelStateResponse(data,'.upperAddress')
			});
		});

		$(document).on('change','.upperAddress .state',function(){
			var method = "POST";
			var url = "/get-city";
			var data = {state_id:$('.upperAddress .state').val().split("--")[0],_token : '<?php echo csrf_token() ?>'};
			startAjax(method,url,data,function(data){
				// handelCityResponse(data,'.upperAddress');
			});
		});

		$(document).on('change','.lowerAddress .country',function(){
			if(!lockUpdate){
				var method = "POST";
				var url = "/get-state";
				var data = {country_id:$('.lowerAddress .country').val(),_token : '<?php echo csrf_token() ?>'};
				startAjax(method,url,data,function(data){
					handelStateResponse(data,'.lowerAddress')
				});
			}
		});

		$(document).on('change','.lowerAddress .state',function(){
			if(!lockUpdate){
				var method = "POST";
				var url = "/get-city";
				var data = {state_id:$('.lowerAddress .state').val().split("--")[0],_token : '<?php echo csrf_token() ?>'};
				startAjax(method,url,data,function(data){
					// handelCityResponse(data,'.lowerAddress');
				});
			}
		});


function handelStateResponse(response,selector){
    if(response){
		if(!selector){ selector = "";}
		selector += " ";
        $(selector + ' .state option').remove();
        if(response.data.state_details.length > 0){
            response.data.state_details.forEach(function(value,key){
                $(selector + ' .state').append("<option value='"+value.id+"--"+value.name+"'>"+value.name+"</option>");
            })
            $(selector + ' .state').trigger('change');
            $(selector + ' .state').parents('.fields').show();
        }else{
            $(selector + ' .state').trigger('change');
            $(selector + ' .state').parents('.fields').hide();
            $(selector + ' .city').parents('.fields').hide();
        }
    }
}

function handelCityResponse(response,selector){
    if(response){
		if(!selector){ selector = "";}
		selector += " ";
        $(selector + ' .city option').remove();
        if(response.data.city_details.length > 0){
            response.data.city_details.forEach(function(value,key){
                $(selector + ' .city').append("<option value='"+value.id+"--"+value.name+"'>"+value.name+"</option>");
            })
            $(selector + ' .city').parents('.fields').show();
        }else{
            $(selector + ' .city').parents('.fields').hide();
        }
    }
}
</script>
</body>
</html>