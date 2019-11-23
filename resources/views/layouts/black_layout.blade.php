<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Expert Connect</title>

    <link rel="icon" href="{{ url('/img/favicon.ico') }}" type="image/x-icon" />
    <link rel="shortcut icon" href="{{ url('/img/favicon.png') }}" type="image/png" />

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700|Roboto:400,700" rel="stylesheet">
    <link href="{{ asset('css/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.popVideo.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/media-screen.css') }}" rel="stylesheet">
    <style>
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }
		.alert-success {
			color: #3c763d;
			background-color: #dff0d8;
			border-color: #d6e9c6;
		}
		.alert-danger {
			color: #a94442;
			background-color: #f2dede;
			border-color: #ebccd1;
		}
	</style>
    {{--    <link href="{{ asset('css/slick-theme.css') }}" rel="stylesheet">  --}}
    @stack('styles')
<!-- Google Tag Manager --> <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0], j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src= 'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f); })(window,document,'script','dataLayer','GTM-T6MQWFH');</script> <!-- End Google Tag Manager --></head>
<body> <!-- Google Tag Manager (noscript) --> <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T6MQWFH" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript> <!-- End Google Tag Manager (noscript) -->

 @include('layouts.header')
    <div id="app">
        @yield('content')
    </div>
 @include('layouts.footer')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('js/custom/common.js')}}" type="text/javascript"></script>
   
   
{{-- 
    <script src="{{ asset('js/jquery.popVideo.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/slick-lightbox.js') }}" type="text/javascript"></script>
 --}}
<!--    <script src="{{ asset('js/validationJs/bootstrap.min.js') }}" type="text/javascript"></script>-->
<!--    <script src="{{ asset('js/validationJs/jquery.js') }}" type="text/javascript"></script>-->
    <script src="{{ asset('js/validationJs/jquery.validate.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/validationJs/additional-methods.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/slick.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/jquery.simplePopup.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/custom.js') }}" type="text/javascript"></script>

    @stack('scripts')                   
</body>
</html>
