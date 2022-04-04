<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<title>

    @yield('title')


</title>
<!-- Favicon-->
<link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="{{asset('plugins/bootstrap/css/bootstrap.min.css')}}" />
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<!-- Custom Css -->
<link rel="stylesheet" href="{{asset('css/main.css')}}">
<link href="{{asset('css/login.css')}}" rel="stylesheet">

<link rel="stylesheet" href="{{asset('css/themes/all-themes.css')}}"/>
</head>
<body class="login-page authentication">

@yield('contenido')


<div class="theme-bg"></div>
<!-- Jquery Core Js --> 
<script src="{{asset('bundles/libscripts.bundle.js')}}"></script> <!-- Lib Scripts Plugin Js -->
<script src="{{asset('bundles/vendorscripts.bundle.js')}}"></script> <!-- Lib Scripts Plugin Js -->
<script src="{{asset('bundles/mainscripts.bundle.js')}}"></script><!-- Custom Js --> 
</body>

</html>