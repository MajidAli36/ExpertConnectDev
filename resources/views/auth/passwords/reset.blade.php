@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="inner">
            <div class="signup">
                <div class="signup-left">
                <div class="form-div">
                        <h1>Reset Password</h1>
                    <form class="form-horizontal" method="POST" action="{{ url('password/reset') }}">
                    {{ csrf_field() }}

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="{{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="fileds">
                            <input id="email" type="text" class="form-control" name="email" placeholder="E-Mail Address" value="{{ $email or old('email') }}" autofocus>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
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

@push('scripts')
<script>
    $(document).ready(function(){
        $('body').addClass('login-page');
    });
</script>
@endpush 
