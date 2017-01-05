<?php $__env->startSection('content'); ?>
<div class="col-md-12 wrapper">
    <div class="alert alert-jim">
        <h3 class="page-header">Employee Attendance
        </h3>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <?php if(isset($lists) and count($lists) >0): ?>
                        <?php foreach($lists as $list): ?>

                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="alert alert-danger" role="alert">DTR records are empty.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('resources/plugin/Chart.js/Chart.min.js')); ?>"></script>
<script>

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>