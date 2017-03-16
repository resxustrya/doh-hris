<?php $__env->startSection('content'); ?>
    <div class="alert alert-jim" id="inputText">
        <h2 class="page-header">Working Schedule</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="btn-group">
                    <a class="btn btn-success dropdown-toggle" data-toggle="dropdown" data-link= "<?php echo e(asset('create/work-schedule')); ?>" href="#flixe">
                        <i class="fa fa-plus"></i>  Add New
                    </a>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="page-divider"></div>
        <?php if(isset($hours) and count($hours)): ?>
            <div class="table-responsive">
                <table class="table table-list table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Time From</th>
                            <th>Time To</th>
                        </tr>
                    </thead>
                    <?php foreach($hours as $hour): ?>
                        <tr>
                            <td><?php echo e($hour->from); ?></td>
                            <td><?php echo e($hour->to); ?></td>
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
        $('a[href="#flixe"]').click(function(event){
            event.preventDefault();
            var url = $(this).data('link');
            $.get(url,'',function(response){
               $('#new_form').modal('show');
               $('.modal-body').html(response);
            });
        });
    </script>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>