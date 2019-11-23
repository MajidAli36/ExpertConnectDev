@extends('layouts.black_layout') 
@section('content')

<div class="content">
    <div class="inner">
        <div class="signup">
            <div class="signup-left">
                <div class="form-div">
                        <h1>Forgot Password</h1>

                        
                        <div class="show_errors">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                        </div>
                        <form class="form-horizontal" id="forget_password" method="POST" action="{{ url('/verify-reset-token') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="token" value="<?php echo $_GET['token'];?>">
                            <div class="">
                                <div class="fileds">
                                    <input id="newPassword" type="password"  name="password" placeholder="Please enter your new password">
                                </div>
                            </div>
                            <div class="">
                                <div class="fileds">
                                    <input id="confirm_password" type="password"  name="confirmPassword" placeholder="Confirm your password">
                                </div>
                            </div>
                            <button type="submit">Change Password</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

<script>
    $(document).ready(function(){
        $('body').addClass('login-page');
        $( "#forget_password" ).submit(function( event ) {
            if($('#newPassword').val() == $('#confirm_password').val() && $('#newPassword').val() != ''){
                $( "#forget_password" ).submit();
            }else{
                event.preventDefault();                
                $('.show_errors').html('');
                if($('#newPassword').val() == ''){
                    $('.show_errors').html('<div class="alert alert-danger">Password and Confirm Password can\'t be empty</div>');  
                }else{
                    $('.show_errors').html('<div class="alert alert-danger">Password and Confirm Password not Match</div>');  
                }
                
            }
        });
    });
</script>
@endpush  
 
 