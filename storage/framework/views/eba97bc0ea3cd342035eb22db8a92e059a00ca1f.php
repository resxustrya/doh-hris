
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
    <link href="<?php echo e(asset('resources/plugin/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')); ?>" rel="stylesheet">
    <!-- bootstrap datepicker -->

    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('resources/plugin/clockpicker/dist/jquery-clockpicker.min.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('resources/plugin/clockpicker/dist/bootstrap-clockpicker.min.css')); ?>" />
    <script src="<?php echo e(asset('resources/angular/angular.js')); ?>"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('resources/assets/datepicer/css/bootstrap-datepicker3.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('resources/assets/datepicer/css/bootstrap-datepicker3.standalone.css')); ?>" />
    <script src="<?php echo e(asset('resources/assets/js/jquery.min.js')); ?>"></script>
    <title>
        <?php echo $__env->yieldContent('title','Home'); ?>
    </title>

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

</head>
<?php $__env->startSection('head-js'); ?>
        <!--DATE RANGE-->
<?php echo $__env->yieldSection(); ?>
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
    <div class="header" style="background-color:#9900cc;padding:15px;">
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
            <?php if(Auth::user()->usertype == "1"): ?>
                <?php echo $__env->make('layouts.admin-menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php elseif(Auth::user()->usertype == "0"): ?>
                <?php echo $__env->make('layouts.personal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>
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
<?php echo $__env->make('modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="<?php echo e(asset('resources/assets/js/jquery-validate.js')); ?>"></script>
<script src="<?php echo e(asset('resources/assets/js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('resources/assets/datepicer/js/bootstrap-datepicker.js')); ?>"></script>
<!-- CLOCK PICKER -->
<script src="<?php echo e(asset('resources/plugin/clockpicker/dist/jquery-clockpicker.min.js')); ?>"></script>
<script src="<?php echo e(asset('resources/plugin/clockpicker/dist/bootstrap-clockpicker.min.js')); ?>"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="<?php echo e(asset('resources/assets/js/ie10-viewport-bug-workaround.js')); ?>"></script>
<script>var loadingState = '<center><img src="<?php echo e(asset('resources/img/spin.gif')); ?>" width="150" style="padding:20px;"></center>'; </script>
<!-- bootstrap datepicker -->
<script src="<?php echo e(asset('resources/assets/js/script.js')); ?>?v=1"></script>
<script src="<?php echo e(asset('resources/assets/js/form-justification.js')); ?>"></script>
<script src="<?php echo e(asset('resources/plugin/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')); ?>"></script>
<?php echo $__env->yieldContent('plugin'); ?>

<!-- SELECT CHOOSEN -->
<script src="<?php echo e(asset('resources/plugin/chosen/chosen.jquery.js')); ?>"></script>

<?php $__env->startSection('js'); ?>

<?php echo $__env->yieldSection(); ?>
</body>
</html>
