<?php $__env->startSection('content'); ?>
    <div class="alert alert-jim" id="inputText">
        <h2 class="page-header">Working Schedule</h2>

        <div class="clearfix"></div>
        <div class="page-divider"></div>
        <div class="row">
            <div class="col-md-8 col-md-offset-1">
                <form action="<?php echo e(asset('edit/work-schedule/' .$sched->id)); ?>" method="POST">
                    <?php echo e(csrf_field()); ?>

                    <div class="modal-body">
                        <table class="table table-hover table-form table-striped">
                            <tr class="alert-info">
                                <td class="col-sm-3"><label>Description</label></td>
                                <td class="col-sm-1">:</td>
                                <td class="col-sm-5"><input  value="<?php echo e($sched->description); ?>"  name="description" class="form-control" required></td>
                            </tr>
                            <tr>
                                <td class="col-sm-3"><label>AM Time In </label></td>
                                <td class="col-sm-1">:</td>
                                <td class="col-sm-5"><input id="input-a" value="<?php echo e($sched->am_in); ?>" data-default="20:48" name="am_in" class="form-control clock" required></td>
                            </tr>
                            <tr>
                                <td class="col-sm-3"><label>AM Time Out</label></td>
                                <td class="col-sm-1">:</td>
                                <td class="col-sm-5"><input id="input-b" value="<?php echo e($sched->am_out); ?>" data-default="20:48" name="am_out" class="form-control clock" required></td>
                            </tr>
                            <tr>
                                <td class="col-sm-3"><label>PM Time In</label></td>
                                <td class="col-sm-1">:</td>
                                <td class="col-sm-5"><input id="input-c" value="<?php echo e($sched->pm_in); ?>" data-default="20:48" name="pm_in" class="form-control clock" required></td>
                            </tr>
                            <tr>
                                <td class="col-sm-3"><label>PM Time Out</label></td>
                                <td class="col-sm-1">:</td>
                                <td class="col-sm-5"><input id="input-d" value="<?php echo e($sched->pm_out); ?>" data-default="20:48" name="pm_out" class="form-control clock" required></td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <a type="button" class="btn btn-default" href="<?php echo e(asset('work-schedule')); ?>"><i class="fa fa-times"></i> Cancel</a>
                        <button type="submit" class="btn btn-success"><i class="fa fa-send"></i> Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
            'default' : '<?php echo e($sched->am_in); ?>'
        });
        var input = $('#input-b');
        input.clockpicker({
            autoclose: true,
            placement : 'top',
            align : 'left',
            donetext : 'Ok',
            'default' : '<?php echo e($sched->am_out); ?>'
        });
        var input = $('#input-c');
        input.clockpicker({
            autoclose: true,
            placement : 'top',
            align : 'left',
            donetext : 'Ok',
            'default' : '<?php echo e($sched->pm_in); ?>'
        });
        var input = $('#input-d');
        input.clockpicker({
            autoclose: true,
            placement : 'top',
            align : 'left',
            donetext : 'Ok',
            'default' : '<?php echo e($sched->pm_out); ?>'
        });
        $('.clock').keyup(function(){
            $(this).val(null);
        });
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>