<?php
use Illuminate\Support\Facades\Session;
if(Session::has('filter_list')) {
    $lists = Session::get('filter_list');
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
                                        <tr class="text-center">
                                            <th>DAYS</th>
                                            <th>AM</th>
                                            <th>PM</th>
                                            <th>UNDERTIME</th>
                                        </tr>
                                    </thead>
                                    <tbody>

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