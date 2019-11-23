@extends('user.userProfileLayout')
@section('userProfileContent')
		<div class="wrapper">
			<div class="content">
				<div class="inner phone-verification">
					<div class="profile-data">
						@include('user.userProfileMenu')
						<div class="profile-content content-view enterPhoneWrap">
                           <h3>Phone verification</h3>
                           
                           <div class="alert showErrorMessage" style="display:none;">
								<strong>Success!</strong> Indicates a successful or positive action.
                            </div>
                            
                           <div class="fields">
							  <p>Would you like to receive your meeting confirmation on your phone? it’s easy and free</p>
						   </div>
						   <form name="" method="">
							   <div class="fields">
									<div class="phone-verify">
										<div class="select-box">
											<select name="country_code" id="country_code">
                                                <?php 
                                                foreach($country_Code as $code){
                                                   // die(json_encode($code))?>
													<option value="{{ $code->phonecode }}">+{{$code->phonecode }}</option>
												<?php } ?>
											</select>
										</div>
										<input type="text" id="phone_number" name="phone_number" placeholder="Phone number" required>
									</div>
								</div>
								<div class="fields">
										<button class="SendOtp">Send Otp</button>
								</div>
							</form>
						</div>
						<div class="profile-content content-view verifyPhoneWrap" style="display:none;">
						   <br/><br/><h3>Phone validation</h3>
						   <div class="fields">
							  <p>Please enter the 4 digits code that we sent via SMS to the number you provide</p>
						   </div>
							<div class="alert showErrorMessage" style="display:none;">
								<strong>Success!</strong> Indicates a successful or positive action.
							</div>
						
						  <div class="fields phone-val">
                          <div class="fields-item">
								 <input type="text" id="partitioned" class="otp" name="otp" placeholder="">
                              </div> 
                              <div class="fields-item">
								 <input type="text" id="partitioned" class="otp" name="otp" placeholder="">
                              </div>
                              <div class="fields-item">
								 <input type="text" id="partitioned" class="otp" name="otp" placeholder="">
                              </div>
                              <div class="fields-item">
								 <input type="text" id="partitioned" class="otp" name="otp" placeholder="">
							  </div>
                           </div>
                           <div class="fields">
								<button class="verifyOTP">Verify Otp</button>
						    </div>
						   <div class="fields resent-sms">
							  <a class="resendBtn" href="javascript:void(0)">Re-sent SMS</a>
						   </div>
						   <div class="fields resent-sms">
							  <a href="javascript:void(0)" class="changePhone">Change phone number</a>
						   </div>
						</div>
					</div>
				</div>
			</div>
        </div>
        
<script>
    $(document).on('click','.resendBtn',function(){
        removeErrors();
        sendOtp($('#country_code').val(),$('#phone_number').val(),function(status,message){
            if(status){
                showMessage('SUCCESS',message,'.verifyPhoneWrap ');
            }else{
                showMessage('ERROR',message,'.verifyPhoneWrap ');
            }
        });
    })

    $(document).on('click','.verifyOTP',function(){
        removeErrors();
        var otp = "";
        $('.phone-val .otp').map(function(key,value){
            otp  += $(value).val();
        })
        verifyOtp(otp,function(status,message){
            if(status){
                showMessage('SUCCESS',message);
            }else{
                showMessage('ERROR',message);
            }
        });
    })

    $(document).on('click','.enterPhoneWrap .SendOtp',function(e){
        removeErrors();
        e.preventDefault();
            sendOtp($('#country_code').val(),$('#phone_number').val(),function(status,message){
                if(status){
                    $('.enterPhoneWrap').hide();
                    $('.verifyPhoneWrap').show();
                }else{
                    showMessage('ERROR',message);
                }
            });
    });
	
	$(document).on('keydown','.phone-val input[name^="otp"]',function(e){
        $(this).val('');
    })
    $(document).on('keyup','.phone-val input[name^="otp"]',function(){
        var elem = $('.phone-val .otp');
        var index = $(elem).index($(this));
        if($(this).val().length >= 1){
            if(elem[index + 1]){
                $(this).focusout();
                $(elem[index + 1]).focus();
            }
        }else{
            if(elem[index - 1]){
                $(this).focusout();
                $(elem[index - 1]).focus();
            }
        }
    })
	
	$(document).on('click','.changePhone',function(e){
        removeErrors();
        e.preventDefault();
        $('.enterPhoneWrap').show();
		resetOTP();
        $('.verifyPhoneWrap').hide();
    });
	
	function resetOTP(){
		$('.phone-val input[name^="otp"]').val("");
    }

    /**
     * Send OTP Function
     */
    function sendOtp(code,phone,callback){
        var url = "send-otp";
        startAjax("POST",url,{code:code,phone:phone,_token:"{{csrf_token()}}"},function(resp){
            callback(resp.success,resp.message);
        })
    }
    /**
     * Verify OTP
     */
    function verifyOtp(otp,callback){
        var url = "verify-otp";
        startAjax("POST",url,{otp:otp,_token:"{{csrf_token()}}"},function(resp){
            callback(resp.success,resp.message);
        })
    }

    function removeErrors(){
        $('.showErrorMessage').hide();
    }
</script>
@endsection