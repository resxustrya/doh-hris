<?php

?>
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo e(asset('resources/img/favicon.png')); ?>">
    <meta http-equiv="cache-control" content="max-age=0" />
    <title>HRIS</title>
    <!-- Bootstrap core CSS -->
    <link href="<?php echo e(asset('resources/assets/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('resources/assets/css/bootstrap-theme.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('resources/assets/css/font-awesome.min.css')); ?>" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="<?php echo e(asset('resources/assets/css/ie10-viewport-bug-workaround.css')); ?>" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?php echo e(asset('resources/assets/css/style.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('resources/assetes/css/upload.css')); ?>" rel="stylesheet" >
    <!-- bootstrap datepicker -->
    <link href="<?php echo e(asset('resources/plugin/datepicker/datepicker3.css')); ?>" rel="stylesheet">
    <script src="<?php echo e(asset('resources/angular/angular.js')); ?>"></script>
    <title>
        <?php echo $__env->yieldContent('title','Home'); ?>
    </title>

    <!--DATE RANGE-->
    <link href="<?php echo e(asset('resources/plugin/daterangepicker/daterangepicker-bs3.css')); ?>" rel="stylesheet">
    <!--CHOOSEN SELECT -->
    <link href="<?php echo e(asset('resources/plugin/chosen/chosen.css')); ?>" rel="stylesheet">

    <?php echo $__env->yieldContent('css'); ?>
    <style>
        body {
            background: url('<?php echo e(asset('resources/img/backdrop.png')); ?>'), -webkit-gradient(radial, center center, 0, center center, 460, from(#ccc), to(#ddd));
        }
        .loading {
            opacity:0.4;
            background:#ccc url('<?php echo e(asset('resources/img/spin.gif')); ?>') no-repeat center;
            position:fixed;
            width:100%;
            height:100%;
            top:0px;
            left:0px;
            z-index:1000;
            display: none;
        }

    </style>
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="<?php echo e(asset('resources/assets/js/ie-emulation-modes-warning.js')); ?>"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body  class="ng-cloak">

<!-- Fixed navbar -->

<nav class="navbar navbar-default navbar-static-top">
    <div class="header" style="background-color:#2F4054;padding:10px;">
        <div class="col-md-4">
            <span class="title-info">Welcome,</span> <span class="title-desc"><?php echo e(Auth::user()->fname); ?> <?php echo e(Auth::user()->lname); ?></span>
        </div>
        <div class="col-md-4">
            <span class="title-info">Section:</span>
            <span class="title-desc">
            </span>
        </div>
        <div class="col-md-4">
            <span class="title-info">Date:</span> <span class="title-desc"><?php echo e(date('M d, Y')); ?></span>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="header" style="background-color:#00CC99;padding:15px;">
        <div class="container">
            <img src="<?php echo e(asset('resources/img/banner.png')); ?>" class="img-responsive" />
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
            <ul class="nav navbar-nav">
                <li><a href="<?php echo e(url('/home')); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
                <li><a href="<?php echo e(URL::to('upload')); ?>"><i class="fa fa-plus"></i> Upload File</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-file"></i> Manage DTR<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo e(asset('/change/password')); ?>"><i class="fa fa-unlock"></i>&nbsp;&nbsp; Change Password</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo e(url('/logout')); ?>"><i class="fa fa-sign-out"></i>&nbsp;&nbsp; Logout</a></li>
                    </ul>
                </li>
                <li><a href="<?php echo e(URL::to('document/logs')); ?>"><i class="fa fa-print"></i> Print</a></li>
                <?php if(Auth::user()->user_priv==1): ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-gear"></i> Settings<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo e(asset('/users')); ?>"><i class="fa fa-users"></i>&nbsp;&nbsp; Users</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo e(asset('/designation')); ?>"><i class="fa fa-arrow-right"></i>&nbsp;&nbsp; Designation</a></li>
                            <li><a href="<?php echo e(asset('/section')); ?>"><i class="fa fa-arrow-right"></i>&nbsp;&nbsp; Section</a></li>
                            <li><a href="<?php echo e(asset('/division')); ?>"><i class="fa fa-arrow-right"></i>&nbsp;&nbsp; Division</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo e(asset('document/filter')); ?>"><i class="fa fa-filter"></i>&nbsp;&nbsp; Filter Documents</a></li>
                        </ul>
                    </li>
                <?php endif; ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> Account<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo e(asset('/change/password')); ?>"><i class="fa fa-unlock"></i>&nbsp;&nbsp; Change Password</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo e(url('/logout')); ?>"><i class="fa fa-sign-out"></i>&nbsp;&nbsp; Logout</a></li>
                    </ul>
                </li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="#trackDoc" data-toggle="modal"><i class="fa fa-search"></i> Track Document</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container">
    <div class="loading"></div>
        <?php echo $__env->yieldContent('content'); ?>
    <div class="clearfix"></div>
</div> <!-- /container -->
<footer class="footer">
    <div class="container">
        <p>Copyright &copy; 2016 DOH-RO7 All rights reserved</p>
    </div>
</footer>


        <!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="<?php echo e(asset('resources/assets/js/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('resources/assets/js/jquery-validate.js')); ?>"></script>
<script src="<?php echo e(asset('resources/assets/js/bootstrap.min.js')); ?>"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="<?php echo e(asset('resources/assets/js/ie10-viewport-bug-workaround.js')); ?>"></script>
<script>var loadingState = '<center><img src="<?php echo e(asset('resources/img/spin.gif')); ?>" width="150" style="padding:20px;"></center>'; </script>
<!-- bootstrap datepicker -->
<script src="<?php echo e(asset('resources/plugin/datepicker/bootstrap-datepicker.js')); ?>"></script>
<script src="<?php echo e(asset('resources/assets/js/script.js')); ?>?v=1"></script>
<script src="<?php echo e(asset('resources/assets/js/form-justification.js')); ?>"></script>
<?php echo $__env->yieldContent('plugin'); ?>
<script src="<?php echo e(asset('resources/plugin/daterangepicker/moment.min.js')); ?>"></script>
<!-- DATE RANGE SELECT -->
<script src="<?php echo e(asset('resources/plugin/daterangepicker/daterangepicker.js')); ?>"></script>
<!-- SELECT CHOOSEN -->
<script src="<?php echo e(asset('resources/plugin/chosen/chosen.jquery.js')); ?>"></script>

<?php $__env->startSection('js'); ?>

<?php echo $__env->yieldSection(); ?>
</body>
</html>
