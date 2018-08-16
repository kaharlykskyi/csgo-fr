<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>GoodGames | ADMIN</title>

    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- Fontfaces CSS-->
    <link href="{{asset('admin-content/css/font-face.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin-content/vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin-content/vendor/font-awesome-5/css/fontawesome-all.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin-content/vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{asset('admin-content/vendor/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{asset('admin-content/vendor/animsition/animsition.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin-content/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin-content/vendor/wow/animate.css" rel="stylesheet')}}" media="all">
    <link href="{{asset('admin-content/vendor/css-hamburgers/hamburgers.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin-content/vendor/slick/slick.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin-content/vendor/select2/select2.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin-content/vendor/perfect-scrollbar/perfect-scrollbar.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin-content/vendor/vector-map/jqvmap.min.css')}}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{asset('admin-content/css/theme.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('css/jquery.bracket.min.css')}}" rel="stylesheet" media="all">

    <script src="{{asset('admin-content/js/ckeditor/ckeditor.js')}}"></script>
    <!-- Jquery JS-->
    <script src="{{asset('admin-content/vendor/jquery-3.2.1.min.js')}}"></script>

    <script src="https://code.jquery.com/jquery-migrate-3.0.1.min.js"></script>

    <script src="{{asset('js/jquery.bracket.min.js')}}"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <script src="{{asset('js/bootstrap-datetimepicker.js')}}"></script>

    <link href="{{asset('css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" media="all">

    <script src="{{asset('admin-content/vendor/jqDynaForm/jqDynaForm.js')}}"></script>

    <link href="{{asset('admin-content/vendor/jqDynaForm/jqDynaForm.css')}}" rel="stylesheet" media="all">

    <style>
        .datetimepicker{
            top: 295px !important;
        }
        #score .footer,#score .delete{
            display: none !important;
        }
    </style>

</head>

<body>

<div class="page-wrapper">
    <!-- HEADER DESKTOP-->
        @component('admin_area.component.header_desktop')

        @endcomponent
    <!-- END HEADER DESKTOP-->
    <!-- MENU SIDEBAR-->
        @component('admin_area.component.sidebar')

        @endcomponent
    <!-- END MENU SIDEBAR-->

    <!-- PAGE CONTAINER-->
    <div class="page-container2">
        @yield('content')
    </div>
</div>



<!-- Bootstrap JS-->
<script src="{{asset('admin-content/vendor/bootstrap-4.1/popper.min.js')}}"></script>
<script src="{{asset('admin-content/vendor/bootstrap-4.1/bootstrap.min.js')}}"></script>
<!-- Vendor JS       -->
<script src="{{asset('admin-content/vendor/slick/slick.min.js')}}">
</script>
<script src="{{asset('admin-content/vendor/wow/wow.min.js')}}"></script>
<script src="{{asset('admin-content/vendor/animsition/animsition.min.js')}}"></script>
<script src="{{asset('admin-content/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js')}}">
</script>
<script src="{{asset('admin-content/vendor/counter-up/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('admin-content/vendor/counter-up/jquery.counterup.min.js')}}">
</script>
<script src="{{asset('admin-content/vendor/circle-progress/circle-progress.min.js')}}"></script>
<script src="{{asset('admin-content/vendor/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
<script src="{{asset('admin-content/vendor/chartjs/Chart.bundle.min.js')}}"></script>
<script src="{{asset('admin-content/vendor/select2/select2.min.js')}}">
</script>
<script src="{{asset('admin-content/vendor/vector-map/jquery.vmap.js')}}"></script>
<script src="{{asset('admin-content/vendor/vector-map/jquery.vmap.min.js')}}"></script>
<script src="{{asset('admin-content/vendor/vector-map/jquery.vmap.sampledata.js')}}"></script>
<script src="{{asset('admin-content/vendor/vector-map/jquery.vmap.world.js')}}"></script>

<!-- Main JS-->
<script src="{{asset('admin-content/js/main.js')}}"></script>

</body>

</html>
<!-- end document-->