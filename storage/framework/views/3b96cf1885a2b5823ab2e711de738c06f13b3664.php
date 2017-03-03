<?php $__env->startSection('content'); ?>
    <div class="col-md-12 wrapper">
        <div class="alert alert-jim">
            <h3 class="page-header">Edit Attendance
            </h3>
            <div class="container">
                <div class="row">
                    <div class="col-md-11">
                        <form action="<?php echo e(asset('edit/attendance')); ?>" method="POST">
                            <?php echo e(csrf_field()); ?>

                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-md-2 control-label">User ID</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="col-md-2 form-control" id="inputEmail3" value="<?php echo e($dtr->userid); ?>" name="userid" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-md-2 control-label">Department</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" id="inputEmail3" value="<?php echo e($dtr->department); ?>" readonly name="department" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-md-2 control-label">Firstname</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" id="inputEmail3" name="firstname" value="<?php echo e($dtr->firstname); ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-md-2 control-label">Lastname</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" id="inputEmail3" readonly name="lastname" value="<?php echo e($dtr->lastname); ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label class="control-label col-md-2" for="inputSuccess1">Date In</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" name="datein" value="<?php echo e($dtr->datein); ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-md-2 control-label">Event Time</label>
                                        <div class="col-sm-5">
                                            <input id="input-a" value="<?php echo e($dtr->time); ?>" data-default="20:48" name="time" class="form-control clock" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-md-2 control-label">Event</label>
                                        <div class="col-sm-5">
                                            <select name="event" class="col-md-2 form-control">
                                                <option <?php echo e(($dtr->event == 'IN') ? ' selected' : ''); ?> value="IN">IN</option>
                                                <option <?php echo e(($dtr->event == 'OUT') ? ' selected' : ''); ?> value="OUT">OUT</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-md-2 control-label">Terminal</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="col-md-2 form-control" value="WEB" readonly name="terminal">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-md-2 control-label">Remarks</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="col-md-2 form-control" value="WEB EDITED" readonly name="remarks">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <div class="col-sm-5 col-md-offset-2">
                                            <input type="submit" name="submit" class="btn btn-success" value="Submit">
                                            <a href="<?php echo e(asset('home')); ?>" class="btn btn-default">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
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
            'default' : '<?php echo e($dtr->time); ?>'
        });

        $('.input-daterange input').each(function() {
            $(this).datepicker("clearDates");
        });

    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>