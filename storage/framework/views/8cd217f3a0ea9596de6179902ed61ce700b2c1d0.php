<?php $__env->startSection('content'); ?>
<div class="col-md-12 wrapper">
    <div class="alert alert-jim">
        <h3 class="page-header">Employee Attendance
        </h3>
        <form class="form-inline" method="GET" action="<?php echo e(asset('search')); ?>"  id="searchForm">
            <?php echo e(csrf_field()); ?>

            <div class="form-group">
                <input type="text" class="form-control" placeholder="Search ID and or NAME" name="keyword" autofocus>
                <button  type="submit" name="search" value="search" class="btn btn-default"><i class="fa fa-search"></i> Search</button>
                <div class="btn-group">
                    <div class="input-group input-daterange">
                        <span class="input-group-addon">From</span>
                        <input type="text" class="form-control" name="from" value="2012-04-05">
                        <span class="input-group-addon">To</span>
                        <input type="text" class="form-control" name="to" value="2012-04-19">
                        <span class="input-group-addon"></span>
                        <button type="submit" name="filter" class="btn btn-success form-control" value="Filter">
                            <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Filters
                        </button>
                    </div>
                </div>
            </div>
        </form>
        <div class="clearfix"></div>
        <div class="page-divider"></div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <?php if(isset($lists) and count($lists) >0): ?>
                        <div class="table-responsive">
                            <table class="table table-list table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>Userid</th>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Transaction date</th>
                                    <th>Transaction time</th>
                                    <th>Event Type</th>
                                    <th>Terminal</th>
                                    <th><i class="fa fa-cog" aria-hidden="true"></i></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($lists as $list): ?>
                                    <tr>
                                        <td><?php echo e($list->userid); ?></td>
                                        <td><?php echo e($list->lastname); ?></td>
                                        <td><?php echo e($list->department); ?> </td>
                                        <td>
                                            <?php echo e(date('l', strtotime($list->datein))); ?>

                                            <?php echo e(date("M",strtotime($list->datein)).'. ' . $list->date_d .' , ' .$list->date_y); ?>

                                        </td>
                                        <td><?php echo e(date("h:i A", strtotime($list->time))); ?></td>
                                        <td><?php echo e($list->event); ?></td>
                                        <td><?php echo e($list->terminal); ?></td>
                                        <td>
                                            <a class="btn btn-default" href="<?php echo e(asset('edit/attendance/' .$list->dtr_id)); ?>">Edit</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <?php echo e($lists->links()); ?>


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
@parent

<script>
    $('.input-daterange input').each(function() {
        $(this).datepicker("clearDates");
    });

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>