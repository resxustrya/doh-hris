<?php $__env->startSection('content'); ?>
    <div class="alert alert-jim" id="inputText">
        <h2 class="page-header">Working Schedule</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="btn-group">
                    <a class="btn btn-success" href="<?php echo e(asset('create/work-schedule')); ?>">
                        <i class="fa fa-plus"></i>  Add New
                    </a>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="page-divider"></div>
        <?php if(Session::has('new_hour')): ?>
            <div class="alert alert-success">
                <strong><?php echo e(Session::get('new_hour')); ?></strong>
            </div>
        <?php endif; ?>
        <?php if(isset($hours) and count($hours)): ?>

            <div class="table-responsive">
                <table class="table table-list table-hover table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Description</th>
                            <th>AM Time In</th>
                            <th>AM Time Out</th>
                            <th>PM Time In</th>
                            <th>PM Time Out</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <?php foreach($hours as $hour): ?>
                        <tr>
                            <td><?php echo e($hour->id); ?></td>
                            <td><?php echo e($hour->description); ?></td>
                            <td><?php echo e($hour->am_in); ?></td>
                            <td><?php echo e($hour->am_out); ?></td>
                            <td><?php echo e($hour->pm_in); ?></td>
                            <td><?php echo e($hour->pm_out); ?></td>
                            <td>
                                <a class="btn btn-default" href="<?php echo e(asset('edit/work-schedule/' . $hour->id)); ?>">Update</a>
                                <a class="btn btn-danger" href="<?php echo e(asset('delete/work-schedule/' . $hour->id)); ?>">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <?php echo e($hours->links()); ?>

        <?php else: ?>
            <div class="alert alert-danger">
                <strong><i class="fa fa-times fa-lg"></i>No flixe time records.</strong>
            </div>
        <?php endif; ?>
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
        var input = $('#input-a');
        input.clockpicker({
            autoclose: true,
            placement : 'top',
            align : 'left',
            donetext : 'Ok',
            'default' : '12:00'
        });
    </script>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>