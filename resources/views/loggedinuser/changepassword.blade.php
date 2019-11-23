{{-- @guest --}}
{{-- {{ return view('login'); }} --}}
{{-- @else --}}
@extends('loggedinuser.app')
@push('styles')
	<link rel="stylesheet" href="css/dashboard.css" type="text/css" />
@endpush

@section('content')

<div class="content">
        <div class="inner">
            <div class="signup">
                <div class="signup-left">
                <div class="form-div">
                        <h1>Change Password</h1>
                    <form class="form-horizontal" method="POST" action="{{ url('changepassword') }}">
                    {{ csrf_field() }} 
                  
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
        
                	<div class="{{ $errors->has('current-password') ? ' has-error' : '' }}">
                        <div class="fileds">
                            <input id="password" type="password" class="form-control" name="current-password" required placeholder="Current Password">
                            <div class="error-msg">The field is required.</div>
                             @if ($errors->has('current-password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('current-password') }}</strong>
                                    </span>
                                @endif
                        </div>
                    </div>
                    <div class="{{ $errors->has('password') ? ' has-error' : '' }}">
                        <div class="fileds">
                            <input id="password" type="password" class="form-control" name="password" required placeholder="Password">
                            <div class="error-msg">The field is required.</div>
                             @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>
                    </div>

                    <div class="{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <div class="fileds">
                            <input id="password-confirm" type="password"  class="form-control" name="password_confirmation" required placeholder="Confirm Password">
                            <div class="error-msg">The field is required.</div>
                             @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                        </div>
                    </div>
                        <button type="submit">Confirm</button>
                    </form>
                </div>
                </div>
                <div class="signup-right"></div>
            </div>
        </div>
    </div>

@endsection
{{-- @endguest --}}