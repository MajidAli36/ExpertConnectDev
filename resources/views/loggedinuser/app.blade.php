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
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700|Roboto:400,700" rel="stylesheet">
    <link href="{{ asset('css/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.popVideo.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
            <!-- Start of expertconnect Zendesk Widget script -->
        <script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=9bf94185-1aa3-4b3c-b514-2f1686f4df39"> </script>
        <!-- End of expertconnect Zendesk Widget script -->

    {{-- <link href="{{ asset('css/slick-theme.css') }}" rel="stylesheet"> --}}


      @stack('styles')
      <link href="{{ asset('css/media-screen.css') }}" rel="stylesheet">
<!-- Google Tag Manager --> <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0], j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src= 'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f); })(window,document,'script','dataLayer','GTM-T6MQWFH');</script> <!-- End Google Tag Manager --></head>
<body class="">
 @include('loggedinuser.header')
    {{-- <div id="app"> --}}
        @yield('content')
    {{-- </div> --}}
 @include('loggedinuser.footer')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/slick.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/jquery.simplePopup.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/custom.js') }}" type="text/javascript"></script>

    <script src="{{ asset('js/jquery.popVideo.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/slick-lightbox.js') }}" type="text/javascript"></script>

 <script type="text/javascript">
 </script>
    @stack('scripts')                   
</body>
</html>
