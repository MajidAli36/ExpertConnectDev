@extends('layouts.black_layout') 
@push('styles')

@endpush

@section('content')

<div class="wrapper">
    <div class="content">
        <div class="inner">
            <div class="signup">
                <div class="signup-left">

                    <div class="form-div">
                        <form class="form-horizontal" method="POST" name="userlogin" action="{{ url('login') }}" id="user_login">
                            {{ csrf_field() }}
                            <h1>Login</h1>
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
                            <div class="{{ $errors->has('email') ? ' has-error' : '' }}">

                                <div class="fileds">
                                    <input id="email" placeholder="Email" type="email" class="form-control" name="email" value="{{ old('email') }}"  autofocus>

                                    @if ($errors->has('email'))
                                    <span class="help-block error-msg" style="display: block;">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="{{ $errors->has('password') ? ' has-error' : '' }}">
                                <div class="fileds">
                                    <input id="password" type="password" class="form-control" name="password" placeholder="Password">

                                    @if ($errors->has('password'))
                                    <span class="help-block error-msg" style="display: block;">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div> 
                            <h3 class="forgot-link"><a href="{{ url('password_request') }}">
                                    Forgot Your Password?
                                </a></h3>
                            <button type="submit">Login</button>
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
                        <h3>Don’t have an account yet? <a href="{{ url('register') }}">Sign up here</a></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push('scripts')
  <script type="text/javascript">
    $(document).ready(function ()

    {

        $("#user_login").validate(
                {

                    rules: {

                        'email': {

                            required: true,
                             email: true,

                                   },

                        'password': {

                    
                            minlength: 3

                                  
                                  }

                 
              

           },

                    messages: {


                        'email': {

                            required: "The Email is required!",

                            email: "Please enter a valid email address!",

                            

                                },

                        'password': {

                            required: "The Web Address is required!"

                            },

                        
                             },

                });
        $('body').addClass('login-page');

    });
            

</script>
            <style type="text/css">
                    #user_login label.error {
                        color: red;
                        vertical-align: top;
                        margin-bottom: 10px;
                        margin-top: -9px;
                        padding-top: 0px;
                        width: 100%;
                        display: inline;
                        font-size: 12px;
                    }

                    input.error,
                    select.error,
                    textarea.error {
                        border: 1px solid #e86b52!important;
                    }
                </style>

                @endpush 
