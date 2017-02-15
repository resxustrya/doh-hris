<?php
use App\Http\Controllers\PersonalController as personal;

if(isset($lists) and count($lists) > 0) {
    $startday = $lists[0]['date_d'];
    $endday = $lists[count($lists) -1 ]['date_d'];
}
?>


<?php $__env->startSection('content'); ?>
    <div class="col-md-12 wrapper">
        <div class="alert alert-jim">
            <h3 class="page-header">Print Monthly Attendance
            </h3>
            <form class="form-inline" method="POST" action="<?php echo e(asset('personal/print/filter')); ?>" id="searchForm">
                <?php echo e(csrf_field()); ?>

                <div class="form-group">
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
                                            <th class="col-sm-2" style="text-align: center;">AM</th>
                                            <th class="col-sm-2" style="text-align: center;">PM</th>
                                            <th class="col-sm-2" style="text-align: center;">UNDERTIME<br />Late | UT</th>
                                        </tr>
                                    </thead>
                                </table>
                                <table border="1" class="table table-list table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <td class="col-sm-1 text-center">Date</td>
                                            <td class="col-sm-1 text-center">DAY</td>
                                            <td class="col-sm-2 text-center">IN</td>
                                            <td class="col-sm-2 text-center">OUT</td>
                                            <td class="col-sm-2 text-center">IN</td>
                                            <td class="col-sm-2 text-center">OUT</td>
                                            <td class="col-sm-2 text-center">LATE | UT</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 0; ?>
                                        <?php for(; $startday <= $endday;): ?>
                                            <?php
                                                $date = explode('-',$lists[$i]['datein']);
                                                $datein = $date[0]."-".$date[1]."-".$startday;
                                            ?>
                                            <tr>
                                                <td class="col-sm-2 text-center"><?php echo e($lists[$i]['date']); ?></td>
                                                <td class="col-sm-2 text-center"><?php echo e($startday ." " .personal::day_name($datein)); ?></td>
                                                <td class="col-sm-2 text-center"><?php echo e(personal::get_time($datein, 'IN')); ?></td>
                                                <td class="col-sm-2 text-center"><?php echo e(personal::get_time($datein, 'OUT')); ?></td>
                                                <td class="col-sm-2 text-center"><?php echo e(personal::get_time($datein, 'IN')); ?></td>
                                                <td class="col-sm-2 text-center"><?php echo e(personal::get_time($datein, 'OUT')); ?></td>
                                                <td class="col-sm-2 text-center"><?php echo e(personal::get_time($datein, 'OUT')); ?></td>
                                            </tr>
                                           <?php $startday = $startday + 1; $i++ ?>
                                        <?php endfor; ?>
                                    </tbody>
                                </table>
                            </div>
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