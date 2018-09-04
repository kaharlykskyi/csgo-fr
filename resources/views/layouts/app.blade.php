<!DOCTYPE html>
<!--
    Name: GoodGames - Game Portal / Store HTML Template
    Version: 1.4.0
    Author: nK
    Website: https://nkdev.info/
    Purchase: https://themeforest.net/item/goodgames-portal-store-html-gaming-template/17704593?ref=_nK
    Support: https://nk.ticksy.com/
    License: You must have a valid license purchased only from ThemeForest (the above link) in order to legally use the theme for your project.
    Copyright 2018.
-->

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>GoodGames | Community and Store HTML Game Template</title>

    <meta name="description" content="GoodGames - Bootstrap template for communities and games store">
    <meta name="keywords" content="game, gaming, template, HTML template, responsive, Bootstrap, premium">
    <meta name="author" content="_nK">

    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- START: Styles -->

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700%7cOpen+Sans:400,700" rel="stylesheet" type="text/css">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/dist/css/bootstrap.min.css') }}">

    <!-- FontAwesome -->
    <script defer src="{{ asset('vendor/fontawesome-free/js/all.js') }}"></script>
    <script defer src="{{ asset('vendor/fontawesome-free/js/v4-shims.js') }}"></script>

    <!-- IonIcons -->
    <link rel="stylesheet" href="{{ asset('vendor/ionicons/css/ionicons.min.css') }}">

    <!-- Flickity -->
    <link rel="stylesheet" href="{{ asset('vendor/flickity/dist/flickity.min.css') }}">

    <!-- Photoswipe -->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/photoswipe/dist/photoswipe.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/photoswipe/dist/default-skin/default-skin.css') }}">

    <!-- Seiyria Bootstrap Slider -->
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-slider/dist/css/bootstrap-slider.min.css') }}">

    <!-- Summernote -->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/summernote/dist/summernote-bs4.css') }}">

    <!-- GoodGames -->
    <link rel="stylesheet" href="{{ asset('css/goodgames.css') }}">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    <!-- END: Styles -->

    <!-- jQuery -->
    <script src="{{ asset('vendor/jquery/dist/jquery.min.js') }}"></script>

    <script src="https://code.jquery.com/jquery-migrate-3.0.1.min.js"></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <script src="{{asset('js/jquery.bracket.min.js')}}"></script>
    <link href="{{asset('css/jquery.bracket.min.css')}}" rel="stylesheet" media="all">

    <script src="{{asset('plugins/ckeditor/ckeditor.js')}}"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>


<!--
    Additional Classes:
        .nk-page-boxed
-->
<body>


<!--Additional Classes: .nk-header-opaque -->
<header class="nk-header nk-header-opaque">

    <!-- START: Top Contacts -->
@component('common_component.top_contacts')

@endcomponent

<!-- END: Top Contacts -->

    <!--: Navbar
       Additional Classes:
            .nk-navbar-sticky
            .nk-navbar-transparent
            .nk-navbar-autohide-->
@component('common_component.navbar')

@endcomponent
<!-- END: Navbar -->

</header>

<!--
START: Navbar Mobile

Additional Classes:
.nk-navbar-left-side
.nk-navbar-right-side
.nk-navbar-lg
.nk-navbar-overlay-content
-->
@component('common_component.navbar_mob')

@endcomponent
<!-- END: Navbar Mobile -->

<div class="nk-main">

    <div class="nk-gap-2"></div>



    <div class="container">
        <!-- START: Content page -->
        @yield('content')
        <!-- END: Content page  -->

    </div>

    <div class="nk-gap-4"></div>

</div>


<!-- START: Footer -->
@component('common_component.footer')

@endcomponent
<!-- END: Footer -->

<!-- START: Search Modal -->
@component('common_component.search_modal')

@endcomponent
<!-- END: Search Modal -->


@guest
    <!-- START: Login Modal -->
    @component('common_component.login_modal')

    @endcomponent
    <!-- END: Login Modal -->
@endguest


<!-- START: Scripts -->

<!-- Object Fit Polyfill -->
<script src="{{ asset('vendor/object-fit-images/dist/ofi.min.js') }}"></script>

<!-- GSAP -->
<script src="{{ asset('vendor/gsap/src/minified/TweenMax.min.js') }}"></script>
<script src="{{ asset('vendor/gsap/src/minified/plugins/ScrollToPlugin.min.js') }}"></script>

<!-- Popper -->
<script src="{{ asset('vendor/popper.js/dist/umd/popper.min.js') }}"></script>

<!-- Bootstrap -->
<script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>

<!-- Sticky Kit -->
<script src="{{ asset('vendor/sticky-kit/dist/sticky-kit.min.js') }}"></script>

<!-- Jarallax -->
<script src="{{ asset('vendor/jarallax/dist/jarallax.min.js') }}"></script>
<script src="{{ asset('vendor/jarallax/dist/jarallax-video.min.js') }}"></script>

<!-- imagesLoaded -->
<script src="{{ asset('vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>

<!-- Flickity -->
<script src="{{ asset('vendor/flickity/dist/flickity.pkgd.min.js') }}"></script>

<!-- Photoswipe -->
<script src="{{ asset('vendor/photoswipe/dist/photoswipe.min.js') }}"></script>
<script src="{{ asset('vendor/photoswipe/dist/photoswipe-ui-default.min.js') }}"></script>

<!-- Jquery Validation -->
<script src="{{ asset('vendor/jquery-validation/dist/jquery.validate.min.js') }}"></script>

<!-- Jquery Countdown + Moment -->
<script src="{{ asset('vendor/jquery-countdown/dist/jquery.countdown.min.js') }}"></script>
<script src="{{ asset('vendor/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('vendor/moment-timezone/builds/moment-timezone-with-data.min.js') }}"></script>

<!-- Hammer.js -->
<script src="{{ asset('vendor/hammerjs/hammer.min.js') }}"></script>

<!-- NanoSroller -->
<script src="{{ asset('vendor/nanoscroller/bin/javascripts/jquery.nanoscroller.js') }}"></script>

<!-- SoundManager2 -->
<script src="{{ asset('vendor/soundmanager2/script/soundmanager2-nodebug-jsmin.js') }}"></script>

<!-- Seiyria Bootstrap Slider -->
<script src="{{ asset('vendor/bootstrap-slider/dist/bootstrap-slider.min.js') }}"></script>

<!-- Summernote -->
<script src="{{ asset('vendor/summernote/dist/summernote-bs4.min.js') }}"></script>

<!-- nK Share -->
<script src="{{ asset('plugins/nk-share/nk-share.js') }}"></script>

<!-- GoodGames -->
<script src="{{ asset('js/goodgames.min.js') }}"></script>
<script src="{{ asset('js/goodgames-init.js') }}"></script>
<!-- END: Scripts -->



</body>
</html>
