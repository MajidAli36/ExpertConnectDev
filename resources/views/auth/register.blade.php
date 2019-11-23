@extends('layouts.black_layout')
<style>
input[type="date"]:before {
color: darkgrey;
content: attr(placeholder) !important;
margin-right: 0.5em;
}

</style>
@section('content')
<div class="wrapper">
        <div class="content">
            <div class="inner">
                <div class="signup">
                    <div class="signup-left">
                    <div class="form-div">
                        <h1>Sign up</h1>
                         @if (session('status'))
                                <div class="alert alert-success" style="color: #3c763d;background-color: #dff0d8;border-color: #d6e9c6;padding: 15px;margin-bottom: 20px;border: 1px solid transparent;border-radius: 4px;">
                                    {{ session('status') }}
                                </div>
                            @endif
                            @if (session('message'))
                                <div class="alert alert-danger" style="color: #d61b1b;background-color: #f2dede;border-color: ##ebccd1;padding: 15px;margin-bottom: 20px;border: 1px solid transparent;border-radius: 4px;">
                                    {{ session('message') }}
                                </div>
                          @endif
                        <form class="form-horizontal" method="POST" id="rg-form" action="{{ url('register') }}">
                        {{ csrf_field() }}
                        <div class="{{ $errors->has('firstname') ? ' has-error' : '' }}">
                            <div class="fileds fullName">
                                <div class="firstname">
                                    <input type="text" id="name" name="firstname"  value="{{ old('firstname') }}"  autofocus placeholder="First Name">
                                    <div class="error-msg" style="display: none;">The field is required.</div>
                                @if ($errors->has('firstname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                                @endif
                                </div>

                                <div class="lastname">
                                    <input type="text" id="lastname" name="lastname" placeholder="Last Name" value="{{ old('lastname') }}">
                                    <div class="error-msg"></div>
                                      @if ($errors->has('lastname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                                </div>

                            </div>
                        </div>

                        <div class="{{ $errors->has('user_email') ? ' has-error' : '' }}">
                             <div class="fileds">
                                <input id="email" type="text" placeholder="Email" name="user_email" value="{{ old('user_email') }}" />
                                <div class="error-msg">The field is required.</div>
                            </div>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('user_email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="fileds">
                            <input type="text" name="user_contactno" placeholder="Mobile Phone" value="{{ old('user_contactno') }}">
                            <div class="error-msg">The field is required.</div>
                        </div>
                         @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('user_contactno') }}</strong>
                                </span>
                         @endif

                        <div class="fileds">

                            <input type='date' id="dob" name="user_dob" placeholder="Birthday"  value="2018-09-30" hidden="hidden">
                            <div class="error-msg">The field is required.</div>
                        </div>
                          @if ($errors->has('user_dob'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('user_dob') }}</strong>
                                </span>
                         @endif

                        <div class="fileds gender">
                            <div class="female">
                                <input id="gender-female" type="radio" name="user_gender" value="female">
                                <label for="gender-female"><span class="checkmark"></span>Female</label>
                            </div>
                            <div class="male">
                                <input id="gender-male" type="radio" name="user_gender" value="male">
                                <label for="gender-male"><span class="checkmark"></span>Male</label>
                            </div>
                            <div class="error-msg">The field is required.</div>
                        </div>

                        <div class="{{ $errors->has('user_password') ? ' has-error' : '' }}">
                           <div class="fileds">
                                <input id="password" type="password" placeholder="Password" name="user_password" >
                                <div class="error-msg">The field is required.</div>
                            </div>
                                @if ($errors->has('user_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('user_password') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="fileds">
                                <input id="password-confirm" type="password" placeholder="Confirm Password" name="password_confirmation" >
                                <div class="error-msg">The field is required.</div>
                        </div>
						<br/>
						<div class="g-recaptcha" data-sitekey="6Lc-C8AUAAAAAO1RL_o74Ad4Z5jWuaxxhcpLCYPX"></div>
						<br/>
                            <h3>By sign up you agree to the<a href="{{url('terms-conditions')}}" target="_blank">Terms & Conditions</a></h3>
                            <button type="submit" id="btn-submit">Sign up</button>
                        </form>
                        <div class="or"><span>Or</span></div>
                        <div class="social-login">
                            <form method="post" action="{{url('fb-login')}}" id="facebook_login">
                                {{ csrf_field() }}
                                <a href="javascript:void(0)" onClick="$('#facebook_login').submit();" class="fb-btn" type="submit">Facebook Sign in now</a>
                            </form>
                            <form method="post" action="{{url('g-login')}}" id="google_login">
                                {{ csrf_field() }}
                                <a href="javascript:void(0)" class="google-btn" onClick="$('#google_login').submit();" type="submit">Google Sign in now</a>
                            </form>
                        </div>
                        <h3>Already have an account? <a href="{{ url('login') }}">Sign in here</a></h3>
                    </div>
                    </div>
                    <!-- <div class="signup-right"></div> -->
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script src="{{ asset('js/bootstrap-datepicker.js')}}" type="text/javascript"></script>
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script type="text/javascript">
        $(document).ready(function (){
            $('form').validate({onkeyup: false}); //while using remote validation, remember to set onkeyup false
            $('body').addClass('login-page');
        });

		$('#btn-submit').click(function(e){
		      e.preventDefault();
			  var $captcha = $('#recaptcha'),
				  response = grecaptcha.getResponse();
  
			  if (response.length === 0) {
				$('.msg-error').text( "reCAPTCHA is mandatory" );
				alert("Please select 'I'm not a robot.'");
			  } else {
				$('#rg-form').submit();
			  }
		})
    </script>
    @endpush
@endsection
