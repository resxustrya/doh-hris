<?php $__env->startSection('content'); ?>
    <div class="alert alert-jim" id="inputText">
        <h2 class="page-header">Job Order DTR</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="btn-group">
                    <button class="btn btn-success" onclick="date_modal();">Generate New
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="page-divider">

        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('plugin'); ?>
    <script src="<?php echo e(asset('resources/plugin/daterangepicker/moment.min.js')); ?>"></script>
    <script src="<?php echo e(asset('resources/plugin/daterangepicker/daterangepicker.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('resources/plugin/daterangepicker/daterangepicker-bs3.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    @parent
    <script>
        function date_modal()
        {
            $('#generate_dtr').modal('show');
        }
    </script>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>