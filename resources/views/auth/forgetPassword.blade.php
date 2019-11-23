@extends('layouts.black_layout') 
@section('content')

<div class="content">
    <div class="inner">
        <div class="signup">
            <div class="signup-left">
                <div class="form-div">
                        <h1>Forgot Password</h1>

                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form class="form-horizontal" method="POST" action="{{ url('password_request') }}">
                        {{csrf_field()}}
                            <div class="{{ $errors->has('useremail') ? ' has-error' : '' }}">
                                <div class="fileds">
                                    <input id="useremail" type="email"  name="useremail" value="{{ old('email') }}" placeholder="Email">
                                @if ($errors->has('useremail'))
                                    <span class="help-block">
                                        <div class="error-msg" style="display: block;">{{ $errors->first('useremail') }}</div>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <button type="submit">Send Password Reset Link</button>
                        </form>
                    <h3>Remember your password? <a href="{{ url('login') }}">Log In.</a></h3>
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
    });
</script>
@endpush  
 
 