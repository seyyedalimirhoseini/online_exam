<!DOCTYPE html>
<html lang="en">

<!-- Basic -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

<!-- Site Metas -->
<title>@yield('title')</title>
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="author" content="">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://fonts.googleapis.com/css?family=Gelasio:400,700|Long+Cang&display=swap" rel="stylesheet">    <!-- Site Icons -->
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon" href="images/apple-touch-icon.png">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="/front/css/bootstrap.min.css">
<!-- Site CSS -->
<link rel="stylesheet" href="/front/style.css">
<!-- Responsive CSS -->
<link rel="stylesheet" href="/front/css/responsive.css">
<!-- Custom CSS -->
<link rel="stylesheet" href="/front/css/custom.css">
<script src="/front/js/modernizr.js"></script> <!-- Modernizr -->

<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
@yield('css')
</head>
{{--<body id="" class="politics_version" >--}}
<body id="show" class="politics_version" >

<!-- LOADER -->
<div id="preloader">
    <div class="loader">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
</div><!-- end loader -->
<!-- END LOADER -->

<!-- Navigation -->

@include('front.layouts.partials.nav')


<div id="services" class="section lb">

    <div class="container">

        <div class="row">
{{--            <div id="show" style="width:100%;height:20%;background-color:#33d9b2;color:#218c74"></div>--}}



            @yield('content')

        </div><!-- end row -->
    </div><!-- end container -->
</div><!-- end section -->











@include('Front.layouts.partials.footer')

<a href="#" id="scroll-to-top" class="dmtop global-radius"><i class="fa fa-angle-up"></i></a>

<!-- ALL JS FILES -->
<script src="/front/js/all.js"></script>
<!-- Camera Slider -->
<script src="/front/js/jquery.mobile.customized.min.js"></script>
<script src="/front/js/jquery.easing.1.3.js"></script>
<script src="/front/js/parallaxie.js"></script>
<script src="/front/js/slick.min.js"></script>
<script src="/front/js/animated-slider.js"></script>
<!-- Contact form JavaScript -->
<script src="/front/js/jqBootstrapValidation.js"></script>
<script src="/front/js/contact_me.js"></script>
<!-- ALL PLUGINS -->
<script src="/front/js/custom.js"></script>


@yield('script')
</body>
</html>
