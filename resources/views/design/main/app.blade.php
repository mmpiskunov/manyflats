<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!--================ Basic page needs ================-->
    <title>@yield('title') - {{ config('app.name', '') }}</title>
    <meta charset="UTF-8">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <!--================ Mobile specific metas ================-->
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <!--================ Favicon ================-->
    @include('design.favicon')
    <!--================ Google web fonts ================-->
    <link href="https://fonts.googleapis.com/css?family=Hind:300,400,500,600,700%7CNoto+Serif:400,700%7Cfamily=Open+Sans:300,400,600,700,800&display=swap"
          rel="stylesheet">
    <!--================ Vendor CSS ================-->
    <link rel="stylesheet" href="/css/fontawesome-all.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="/css/linearicons.css">
    <link rel="stylesheet" href="/vendors/arcticmodal/jquery.arcticmodal-0.3.css">
    <link rel="stylesheet" href="/vendors/owl-carousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="/vendors/fancybox/jquery.fancybox.min.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/animate.min.css">
    <!--================ Theme CSS ================-->
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/responsive.css">
    @yield('css')
    <!--================ Vendor JS ================-->
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body class="mad-body--scheme-brown">

{{-- <div class="mad-preloader"></div> --}}

<div id="mad-page-wrapper" class="mad-page-wrapper">
    @include('design.main.header')

    @yield('content')

    @include('design.footer')
</div>

@yield('auth-modal')

<script src="/vendors/modernizr.js"></script>
<script src="/vendors/jquery-3.3.1.min.js"></script>
<script src="/vendors/jquery.easing.1.3.min.js"></script>
<script src="/vendors/instafeed.min.js"></script>
<script src="/vendors/instafeed.wrapper.min.js"></script>
<script src="/vendors/monkeysan.accordion.js"></script>
<script src="/vendors/jquery.parallax-1.1.3.min.js"></script>
<script src="/vendors/monkeysan.tabs.min.js"></script>
<script src="/vendors/monkeysan.jquery.nav.1.0.min.js"></script>
<script src="/vendors/owl-carousel/owl.carousel.min.js"></script>
<script src="/vendors/arcticmodal/jquery.arcticmodal-0.3.min.js"></script>
{{-- <script src="https://maps.google.com/maps/api/js?key=AIzaSyDPJ88B-Zo1HKezgfAvKyAVqAGzkqR3Og0&amp;amp;libraries=geometry&amp;amp;v=3.20"></script> --}}
<script src="/vendors/fancybox/jquery.fancybox.min.js"></script>
<script src="/vendors/monkeysan.validator.min.js"></script>
<script src="/vendors/handlebars-v4.0.5.min.js"></script>
<script src="/vendors/mad.customselect.js"></script>
<script src="/vendors/retina.min.js"></script>
<script src="/js/modules/mad.sticky-header-section.min.js"></script>
<script src="/js/modules/mad.newsletter-form.min.js"></script>
<script src="/js/mad.app.js"></script>
@yield('js')

</body>
</html>
