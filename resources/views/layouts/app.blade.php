
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('resources/img/favicon.png') }}">
    <meta http-equiv="cache-control" content="max-age=0" />
    <title>HRIS</title>
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('resources/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/assets/css/bootstrap-theme.min.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/assets/css/font-awesome.min.css') }}" rel="stylesheet">
    <!--CHOSEN SELECT -->
    <link href="{{ asset('resources/plugin/chosen/chosen.css') }}" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="{{ asset('resources/assets/css/ie10-viewport-bug-workaround.css') }}" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{ asset('resources/assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/assetes/css/upload.css') }}" rel="stylesheet" >
    <link href="{{ asset('resources/plugin/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}" rel="stylesheet">
    <!-- bootstrap datepicker -->
    <!--DATE RANGE-->
    <link href="{{ asset('resources/plugin/daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('resources/plugin/clockpicker/dist/jquery-clockpicker.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('resources/plugin/clockpicker/dist/bootstrap-clockpicker.min.css') }}" />
    <script src="{{ asset('resources/angular/angular.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/datepicer/css/bootstrap-datepicker3.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/datepicer/css/bootstrap-datepicker3.standalone.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('resources/plugin/Lobibox old/lobibox.css') }}" />
    <script src="{{ asset('resources/assets/js/jquery.min.js') }}"></script>
    <!-- SELECT 2 -->
    <link rel="stylesheet" type="text/css" href="{{ asset('resources/plugin/select2/select2.min.css') }}" />
    <title>
        @yield('title','Home')
    </title>
    @yield('css')
    <style>

        body {
            background: url('{{ asset('resources/img/backdrop.png') }}'), -webkit-gradient(radial, center center, 0, center center, 460, from(#ccc), to(#ddd));
        }
        .loading {
            opacity:0.4;
            background:#ccc url('{{ asset('resources/img/spin.gif')}}') no-repeat center;
            position:fixed;
            width:100%;
            height:100%;
            top:0px;
            left:0px;
            z-index:1000;
            display: none;
        }

    </style>
</head>
@section('head-js')
        <!--DATE RANGE-->
@show
<body  class="ng-cloak">
<div class="loading"></div>

<!-- Fixed navbar -->

<nav class="navbar navbar-default navbar-static-top">
    <div class="header" style="background-color:#2F4054;padding:10px;">
        <div class="col-md-4">
            <span class="title-info">Welcome,</span> <span class="title-desc">{{ Auth::user()->fname }} {{ Auth::user()->lname }}</span>
        </div>
        <div class="col-md-4">
            <span class="title-info">Section:</span>
            <span class="title-desc">
            </span>
        </div>
        <div class="col-md-4">
            <span class="title-info">Date:</span> <span class="title-desc">{{ date('M d, Y') }}</span>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="header" style="background-color:#9900cc;padding:15px;">
        <div class="container">
            <img src="{{ asset('resources/img/banner.png') }}" class="img-responsive" />
        </div>
    </div>
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"></a>
        </div>

        <div id="navbar" class="navbar-collapse collapse">
            @if(Auth::user()->usertype == "1")
                @include('layouts.admin-menu')
            @elseif(Auth::user()->usertype == "0")
                @include('layouts.personal')
            @endif
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container">
    <div class="loading"></div>
        @yield('content')
    <div class="clearfix"></div>
    @include('modal')
</div> <!-- /container -->
<footer class="footer">
    <div class="container">
        <p>Copyright &copy; 2017 DOH-RO7 All rights reserved</p>
    </div>
</footer>

        <!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<!-- LOBIBOX JS -->
<script src="{{ asset('resources/plugin/Lobibox old/Lobibox.js') }}"></script>
<!-- DATE RANGE SELECT -->
<script src="{{ asset('resources/plugin/daterangepicker/moment.min.js') }}"></script>
<script src="{{ asset('resources/plugin/daterangepicker/daterangepicker.js') }}"></script>

<script src="{{ asset('resources/assets/js/jquery-validate.js') }}"></script>
<script src="{{ asset('resources/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('resources/assets/datepicer/js/bootstrap-datepicker.js') }}"></script>
<!-- CLOCK PICKER -->
<script src="{{ asset('resources/plugin/clockpicker/dist/jquery-clockpicker.min.js') }}"></script>
<script src="{{ asset('resources/plugin/clockpicker/dist/bootstrap-clockpicker.min.js') }}"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="{{ asset('resources/assets/js/ie10-viewport-bug-workaround.js') }}"></script>
<script>var loadingState = '<center><img src="{{ asset('resources/img/spin.gif') }}" width="150" style="padding:20px;"></center>'; </script>
<!-- bootstrap datepicker -->
<script src="{{ asset('resources/assets/js/script.js') }}?v=1"></script>
<script src="{{ asset('resources/assets/js/form-justification.js') }}"></script>
<script src="{{ asset('resources/plugin/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
@yield('plugin')
<!-- SELECT 2 -->
<script src="{{ asset('resources/plugin/select2/select2.full.min.js') }}"></script>
<!-- CHOSEN SELECT -->
<script src="{{ asset('resources/plugin/chosen/chosen.jquery.js') }}"></script>

@section('js')

@show
</body>
</html>
