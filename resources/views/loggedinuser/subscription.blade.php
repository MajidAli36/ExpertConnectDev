
@extends('loggedinuser.app')
@push('styles')
<link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css" type="text/css" />
<link rel="stylesheet" href="css/subscription.css" type="text/css" />
@endpush

@section('content')
<?php

?>
<div id="home">
		<div class="banner subscription-bg" style="background-image: url(img/subscription-bg-img.jpg);">
			<div class="dashboard-banner">
        <div class="dashboard-banner-text content">
	        <h2>Subscriptions</h2>
	        <p>SIGN UP for our comprehensive video library and learn from the legends of the sport!</p>
        </div>
     	</div>
		</div>
	</div>
	<div class="wrapper">
   	<div class="tab-div">
   		<div class="tab-data">
		   	<ul>
		        <li class="clickme month-plan"><span>Option A</span></li>
		        <li class="clickme year-plan"><span>Option B</span></li>
		    </ul>
		    <div class="tab-container">
		        <div class="list show-tab">
					<div class="subscription-content">
						@if(!empty($subscription_details))
								<?php
								Log::debug($subscription_details);
								$sdetails = $subscription_details[0];
								Log::debug(json_encode($sdetails->offerDetails[1]));
								$val = $sdetails->offerDetails[1];
							 ?>
									<div class="sub-text by-month">
										<h2>${{$val->discountedPrice}}</h2>
										<br>
										{{--<strong>{{$val->additionalData}} MONTH</strong>--}}
										<strong>{{$val->descriptionValue}}</strong>
										{{--@if ($val->displayValue != "")

											<ul>
											<li>{{$val->displayValue}}</li>
											<li>{{$val->descriptionValue}}</li>
										</ul>
										@endif--}}

										<br><br><br><br><br>
										<div class="sub-btn">
											<button class="selectPlan" option-value="{{$val->couponCode}}" data-plan="{{$val->displayValue}}" data-value="${{$val->discountedPrice}}"><span>Subscribe</span></button>
										</div>
									</div>
									<?php
										$val = $sdetails->offerDetails[0];
								 ?>
									<div class="sub-text by-month">
										<h2>${{$val->discountedPrice}}</h2>
										<br>
										{{--<strong>{{$val->additionalData}} MONTH</strong>--}}
										<strong>{{$val->descriptionValue}}</strong>
										{{--@if ($val->displayValue != "")

											<ul>
											<li>{{$val->displayValue}}</li>
											<li>{{$val->descriptionValue}}</li>
										</ul>
										@endif--}}

										<br><br><br><br><br>
										<div class="sub-btn">
											<button class="selectPlan" option-value="{{$val->couponCode}}" data-plan="{{$val->displayValue}}" data-value="${{$val->discountedPrice}}"><span>Subscribe</span></button>
										</div>
									</div>
						@endif
						{{-- <div class="sub-text by-year">
							<h2>$100</h2>
							<strong>12 Months</strong>
							<ul>
								<li>Lorem ipsum dolor sit amet</li>
								<li>Lorem ipsum dolor sit amet</li>
								<li>Lorem ipsum dolor sit amet</li>
								<li>Lorem ipsum dolor sit amet</li>
								<li>Lorem ipsum dolor sit amet</li>
							</ul>
							<div class="sub-btn">
								<button><span>xSubscribe</span></button>
							</div>
						</div> --}}
						<h3><a href="{{ url('subscription-conditions') }}" target="_blank"> Subscription Terms of Service</a></h3>
						<p> <ul style="list-style-type: disc; font-size: 20px;
    color: #8d8d8d;
    line-height: 40px;
    padding: 0 0 30px;">
											<li>
														OVER 300 INSTRUCTIONAL VIDEOS CREATED BY GRAND SLAM CHAMPIONS AND CELEBRITY COACHES
											</li>
											<li>
												A NEW INSTRUCTIONAL VIDEO EVERY WEEK PRESENTED BY A NEW STAR INSTRUCTOR (STARTING NOVEMBER 1, 2018)
											</li>
											<li>
													TOPICS INCLUDE TECHNIQUE, TACTICS, TENNIS SPECIFIC FITNESS, INJURY PREVENTION, NUTRITION, EQUIPMENT, MENTAL TRAINING, COLLEGE COUNSELING FOR TENNIS PLAYERS AND SO MUCH MUCH MORE...
											</li>
											<li>
													RELIABLE AND DETAILED INSTRUCTIONS FOR ALL DIFFERENT AGES AND SKILL LEVELS
											</li>
											<li>
													NOW AVAILABLE FOR A PROMOTIONAL FEE OF ONLY $99.99/yr (OR $9.99/mo), WITH USE OF A PROMO CODE
											</li>
											<li>
												GET KEY TIPS FROM OUR LEGENDARY EXPERTS AND TAKE YOUR GAME TO THE NEXT LEVEL
											</li>
								</ul>
							</p>
					</div>
	        	</div>
		    </div>
	    </div>
    </div>
		<div class="payment-popup height-zero">
			<div class="step step-one">
				<div class="payment">
					<div class="payment-content">
						<h2>Review and Pay</h2>
						<form method="POST" onsubmit="return false;" id="paymentForm" class="form-validate" enctype="multipart/form-data">
							<div class="form-fields card-detail">
								<div class="form-item card-number">
									<label><span>Card Number</span><img src="img/cards-img.jpg" alt=""></label>
									<input type="text" class="cardError" name="card_no" placeholder="" required id="card_no">
								</div>
								<div class="form-item card-cvc">
									<label>CVC</label>
									<input type="text" name="cvvNumber" placeholder="" class="cardError" required id="cvvNumber">
								</div>
								<div class="form-item card-month" >
									<label>Expiry Month</label>
									<select name="ccExpiryMonth" class="cardError" required id="ccExpiryMonth">
										<option value="">Month</option>
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
								<div class="form-item card-year">
									<label>Expiry Year</label>
									<input type="text"  name="ccExpiryYear" placeholder="yyyy" class="cardError" required id="ccExpiryYear">
								</div>
							</div>
							<div class="form-fields coupon-box">
								<div class="form-item">
									<label>Promo Code</label>
									<input type="text" placeholder="" name="couponcode" id="couponcode" >
									<button id="coupon-btn">Apply</button>
									<img id="couponLoader" src="{{ url('/img/preloader.gif') }}" style="display: none;
																																									    height: 90%;
																																									    width: 35%;
																																									    float: right;
																																									    margin-top: -32px;"/>
									<br> <br>
									<label id="couponMessage" style="text-align: 'center';"></label>
								</div>
							</div>
							<!-- <div class="billing-add">
								<h3>Billing Address</h3>
								<div class="form-fields">
									<div class="form-item">
										<label>First Name</label>
										<input type="text" placeholder="" name="firstName" required id="firstName">
									</div>
									<div class="form-item">
										<label>Last Name</label>
										<input type="text" placeholder="" name="lastName" required id="lastName">
									</div>
								</div>
								<div class="form-fields">
									<div class="form-item street">
										<label>Billing Street</label>
										<input type="text" placeholder="" name="line1" required id="line1">
									</div>
									<div class="form-item city">
										<label>City</label>
										<input type="text" placeholder="" name="city" required id="city">
									</div>
									<div class="form-item state">
										<label>State</label>
										<select name="state" required id="state">
											<option value="N/A">State</option>
					                        <option value="AL">Alabama</option>
					                        <option value="AK">Alaska</option>
					                        <option value="AZ">Arizona</option>
					                        <option value="AR">Arkansas</option>
					                        <option value="CA">California</option>
					                        <option value="CO">Colorado</option>
					                        <option value="CT">Connecticut</option>
					                        <option value="DE">Delaware</option>
					                        <option value="DC">District Of Columbia</option>
					                        <option value="FL">Florida</option>
					                        <option value="GA">Georgia</option>
					                        <option value="HI">Hawaii</option>
					                        <option value="ID">Idaho</option>
					                        <option value="IL">Illinois</option>
					                        <option value="IN">Indiana</option>
					                        <option value="IA">Iowa</option>
					                        <option value="KS">Kansas</option>
					                        <option value="KY">Kentucky</option>
					                        <option value="LA">Louisiana</option>
					                        <option value="ME">Maine</option>
					                        <option value="MD">Maryland</option>
					                        <option value="MA">Massachusetts</option>
					                        <option value="MI">Michigan</option>
					                        <option value="MN">Minnesota</option>
					                        <option value="MS">Mississippi</option>
					                        <option value="MO">Missouri</option>
					                        <option value="MT">Montana</option>
					                        <option value="NE">Nebraska</option>
					                        <option value="NV">Nevada</option>
					                        <option value="NH">New Hampshire</option>
					                        <option value="NJ">New Jersey</option>
					                        <option value="NM">New Mexico</option>
					                        <option value="NY">New York</option>
					                        <option value="NC">North Carolina</option>
					                        <option value="ND">North Dakota</option>
					                        <option value="OH">Ohio</option>
					                        <option value="OK">Oklahoma</option>
					                        <option value="OR">Oregon</option>
					                        <option value="PA">Pennsylvania</option>
					                        <option value="RI">Rhode Island</option>
					                        <option value="SC">South Carolina</option>
					                        <option value="SD">South Dakota</option>
					                        <option value="TN">Tennessee</option>
					                        <option value="TX">Texas</option>
					                        <option value="UT">Utah</option>
					                        <option value="VT">Vermont</option>
					                        <option value="VA">Virginia</option>
					                        <option value="WA">Washington</option>
					                        <option value="WV">West Virginia</option>
					                        <option value="WI">Wisconsin</option>
					                        <option value="WY">Wyoming</option>
										</select>
									</div>
									<div class="form-item zip">
										<label>Zip</label>
										<input type="text" placeholder="" name="postal_code" required id="zip">
									</div>
								</div>
							</div> -->
							<div class="form-fields action-btn">
								<div class="form-item">
									<button class="review-btn">Review Order</button>
								</div>
							</div>
						</div>
						<div class="payment-img">
							<img src="img/payment-img.jpg" alt="">
						</div>
					</div>
				</div>
				<div class="step step-two">
					<div class="payment">
						<div class="payment-content">
							<h2>Review your order</h2>
							<p><strong>Plan Name : <span id="option"> </span> </strong></p>
							<p><strong>Payment Method : </strong>Card</p>
							<!--p><strong>Billing Address : </strong>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium perspiciatis velit eum atque.</p-->
							<p><strong>Total Amount : </strong><span id="finalTotal"> </span></p>
							<div class="form-item check-box">
								<input type="checkbox" id="checkedTerms" onClick="enableSubmit(this)"><span>I accept and agree to the <a href="{{url('terms-conditions')}}" target="_blank">Terms of Use </a> and <a href="{{url('privacy-policy')}}" target="_blank">Privacy Policy</a>.</span>
							</div>
							<div class="form-fields action-btn">
								<div class="form-item">
									<button class="cancel-btn">Go back</button>
									<button class="submit-btn" disabled="disabled" style="float:right;">Place Order</button>
									<img id="couponLoaderSubmit" src="{{ url('/img/preloader.gif') }}" style="display: none;
																																												    height: 100%;
																																												    width: 46%;
																																												    float: right;
																																												    margin-top: -45px;
																																														"/>
								<h3><span id="failureStatus"></span></h3>

								</div>
							</div>
						</div>
						<div class="payment-img">
							<img src="img/payment-img.jpg" alt="">
						</div>
					</div>
				</div>
			</form>
			<div class="step step-three thank-you">
				<div class="payment">
					<div class="payment-content">
						<h3>Booking Status: <br/> <span id="paymentStatus"></span> </h3>
						<p> <strong> Name: <span id="username"></span></strong> </p>
						<!--p><strong>Booking code :</strong> <span id="transactionCode"> </span> </p-->
						<p><strong>Payment Method : </strong>Card</p>
						<p><strong>Total Amount : </strong><span id="paymentTotal"></span></p> <br><br/>
						<div class="payment-retry" style="display:none">
							<button class="payment-cancel-btn" style="width: 48%;
																										    display: inline-block;
																										    background: #cc3340;
																										    border-color: #979e3e;
																										    color: #000;
																										    height: 38px;
																										    border: 1px solid #676768;
																										    border-radius: 5px;
																										    padding: 0 10px;">Cancel</button>

							<button class="payment-retry-btn" style="  float:right;
																													width: 48%;
																											    display: inline-block;
																											    background: #bdc92b;
																											    border-color: #979e3e;
																											    color: #000;
																											    padding: 1%;
																											    height: 38px;
																											    border: 1px solid #676768;
																											    border-radius: 5px;
																											    padding: 0 10px;">Retry</button>
						</div>
					</div>
					<div class="payment-img">
						<img src="img/payment-img.jpg" alt="">
					</div>
				</div>
			</div>
		</div>
	</div>


@endsection

@push('scripts')
<script src="js/jquery.mCustomScrollbar.concat.min.js" type="text/javascript"></script>
<script type="text/javascript">
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
var plan;
var coupon;
var option;
var price = 0;
var discount = 0;
var verifiedCode = false;
$("document").ready(function(){

	$(".selectPlan").click(function(){
		plan= $(this).attr("data-plan");
		option = $(this).attr("option-value");
		price= $(this).attr("data-value");
		price = parseFloat(price.substring(1));
		discount = 0;
		console.log(price);
		$('#couponMessage').html('');
		$('#option').html(option);
	});


	 $("#coupon-btn").click(function(){
		 $('#couponLoader').css('display','block');
		 $('#couponMessage').html('');
		 $('#coupon-btn').css('display','none');
 		var CouponCode= $("#couponcode").val();
		if (discount !=0)
			price = parseFloat(price)+parseFloat(discount);
 		// console.log(CouponCode);
 		$.ajax({
 		    url: "{{ url('applyCoupon') }}",
 		    type: 'POST',
 		    data: {_token: CSRF_TOKEN,"coupon":CouponCode,"plan": plan},
 		    dataType: 'JSON',
 		    success: function (data) {
					//console.log(data);

			 		 $('#couponLoader').css('display','none');
					 $('#coupon-btn').css('display','block');
					 $('#couponMessage').html(data.message);
					if(data.success){
						coupon = CouponCode;
						verifiedCode = true;

						// console.log(price);
						// console.log(parseFloat(data.discount));
						// console.log(parseFloat(data.discount)/100 * price);
						discount = (parseFloat(data.discount)/100 *price).toFixed(2);
						price = parseFloat(price) - parseFloat(discount);
						// console.log(discount);
						// console.log(price);
						$('#couponMessage').html(""+data.discount+"% "+data.message );

					}
 		    }
 			});
		});

	$(".submit-btn").click(function(){
		var customerDetails= $("#paymentForm").serialize();
		console.log(customerDetails);
		$("#failureStatus").html("");
		$('.submit-btn').css('display','none');
		$('#couponLoaderSubmit').css('display','block');
		$.ajax({
		    url: "{{ url('stripetoken') }}",
		    type: 'POST',
		    data: {_token: CSRF_TOKEN,"plan":plan,"customerDetails":customerDetails},
		    dataType: 'JSON',
		    success: function (data) {
					console.log(data);
		    	if(data.status=="true"){
                  console.log(data);
		             	proceedPayment(data);
		    	}else{
		    		$(".step").removeClass("active");
            $(".step-one").addClass("active");
            $(".cardError").css({"border-color":"red"});
						$('.submit-btn').css('display','block');
						$('#couponLoaderSubmit').css('display','none');
		    	}
		    },
		    error: function(data){
					$('#couponLoaderSubmit').css('display','none');
					$('.submit-btn').css('display','block');
					$("#failureStatus").html("Error processing your card. Please re-enter the payment information or try a different credit card");
				}

		});
	});

	function proceedPayment(data){
		console.log(data);
		$.ajax({
            url: "{{ url('sendstripetoken') }}",
            type: 'POST',
            data: {_token: CSRF_TOKEN,"plan":data.plan,"token":data.token,"username": data.username,"code":coupon, "verifiedCode": verifiedCode, "price": price},
            dataType: 'JSON',
            success: function (data) {
							console.log(data);
							$('.submit-btn').css('display','block');
							$('#couponLoaderSubmit').css('display','none');
							$(".step").removeClass("active");
							$(".step-three").addClass("active");
							$("#username").html(data.username);
							$("#paymentStatus").html(data.message);
							console.log(price);
							$('#paymentTotal').html("$"+price);
            	if(data.success){
								$("#paymentStatus").html(data.message+" Redirecting...");
								window.setTimeout(function(){
							        window.location.href = "{{url('videolibrary')}}";
							    }, 5000);
							}else {
								$(".payment-retry").css("display","block");
							}
            },
				    error: function(data){
							$('#couponLoaderSubmit').css('display','none');
							$('.submit-btn').css('display','block');
							$("#failureStatus").html("Error processing your card. Please re-enter the payment information or try a different credit card");
				    }
        });
	}

	$('body').removeClass();
    $('body').addClass('subscription-page');
	$(".same-add input").click(function(){
		if($(this).attr('checked',false)){
			$(".shipping-add").toggle();
		}
	});

	$(".review-btn").click(function(){
		if ( 	($.trim($('#card_no').val()) !== '') &&
  				($.trim($('#cvvNumber').val()) !== '') &&
					($.trim($('#ccExpiryMonth').val()) !== '') &&
					($.trim($('#ccExpiryYear').val()) !== '') //&&
					// ($.trim($('#firstName').val()) !== '') &&
					// ($.trim($('#lastName').val()) !== '') &&
					// ($.trim($('#line1').val()) !== '') &&
					// ($.trim($('#city').val()) !== '') &&
					// ($.trim($('#state').val()) !== '') &&
					// ($.trim($('#zip').val()) !== '')
				) {

			$(".step").removeClass("active");
			$(".step-two").addClass("active");
			console.log(price);
			$('#finalTotal').html("$"+price);
		}
	});

	$(document).on("click", ".simplePopupClose", function(){
		$(".step").removeClass("active");
		$("#paymentForm")[0].reset();
	});

	$(document).on("click", ".cancel-btn", function(){
		$(".step").removeClass("active");
		$(".step-one").addClass("active");
	});

	$(document).on("click", ".payment-retry-btn", function(){
		$(".step").removeClass("active");
		$(".step-one").addClass("active");
	});

	$(document).on("click", ".payment-cancel-btn", function(){
			$(".step").removeClass("active");
			$(".simplePopupBackground").css("display","none");
			$(".payment-popup").css("display","none");
			$("#paymentForm")[0].reset();
	});

	enableSubmit = function(val) {
		//var cancelBtn = document.getElementByClassName('submit-btn')
    if (val.checked == true)
        $(".submit-btn").removeAttr('disabled');
    else
        $(".submit-btn").attr('disabled','disabled');
   }

	$(".same-add input").click(function(){
	});
	if($(window).width() < 768){
		$(".month-plan").click(function(){
			$(".sub-text").hide();
			$(".by-month").show();
		});
		$(".year-plan").click(function(){
			$(".sub-text").hide();
			$(".by-year").show();
		});
	}
	$(window).resize(function(){
		if($(window).width() < 768){
			$(".month-plan").click(function(){
				$(".sub-text").hide();
				$(".by-month").show();
			});
			$(".year-plan").click(function(){
				$(".sub-text").hide();
				$(".by-year").show();
			});
		}
	});
});



</script>
@endpush
