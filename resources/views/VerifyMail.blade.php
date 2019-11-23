<!DOCTYPE html>
<html>
<head>
    <title>Welcome Email</title>
    <link rel="icon" href="{{ url('/img/favicon.ico') }}" type="image/x-icon" />
    <link rel="shortcut icon" href="{{ url('/img/favicon.png') }}" type="image/png" />
<!-- Google Tag Manager --> <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0], j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src= 'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f); })(window,document,'script','dataLayer','GTM-T6MQWFH');</script> <!-- End Google Tag Manager --></head>
 
<body> <!-- Google Tag Manager (noscript) --> <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T6MQWFH" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript> <!-- End Google Tag Manager (noscript) -->
	{{-- {{ $user = VerifyUser::where('token', $token)->first() }} --}}
<h2>Welcome to the site {{ $user['name'] }}</h2>
<br/>
Your registered email-id is {{ $user['useremail'] }} , Please click on the below link to verify your email account
<br/>
<a href="{{ url( 'user/verify', $user->verifytoken ) }}">Verify Email</a>
</body>
 
</html>