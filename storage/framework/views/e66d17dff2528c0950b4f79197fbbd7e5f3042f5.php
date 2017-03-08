<?php
use Illuminate\Support\Facades\Session;
if(Session::has('lists')){
    $lists = Session::get('lists');
}
?>

<?php $__env->startSection('content'); ?>
    <div class="col-md-12 wrapper">
        <div class="alert alert-jim">
            <h3 class="page-header">Employee monthly attendance
            </h3>
            <div class="container">
                <div class="row">
                    <div class="col-md-11">
                        <div class="row upload-section">
                            <div id="alert" class="ng-cloak alert alert-warning alert-dismissible col-lg-12" role="alert">
                                <strong>Warning!</strong><span id="msg"></span>
                            </div>
                            <div class="alert-success alert col-md-6 col-lg-offset-3">
                                <form action="<?php echo e(asset('print-monthly')); ?>" method="POST" id="filter">
                                    <?php echo e(csrf_field()); ?>

                                    <div class="btn-group">
                                        <div class="input-group input-daterange" >
                                            <span class="input-group-addon">From</span>
                                            <input type="text" class="form-control" name="from" >
                                            <span class="input-group-addon">To</span>
                                            <input type="text" class="form-control" name="to" >
                                            <span class="input-group-addon"></span>
                                            <button type="submit" name="filter" class="btn btn-success form-control" value="Filter">
                                                <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Filters
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="page-divider"></div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <?php if(isset($lists) and count($lists) >0): ?>
                            <div class="row">
                                <div class="col-md-12">
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
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($lists as $list): ?>
                                                <tr>
                                                    <td><?php echo e($list->userid); ?></td>
                                                    <td><?php echo e($list->lastname .", " .$list->lastname); ?></td>
                                                    <td><?php echo e($list->department); ?></td>
                                                    <td><?php echo e(date("M",strtotime($list->datein)).'. ' . $list->date_d .' , ' .$list->date_y); ?></td></td>
                                                    <td><?php echo e(date("h:i A", strtotime($list->time))); ?></td>
                                                    <td><?php echo e($list->event); ?></td>
                                                    <td><?php echo e($list->terminal); ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php echo e($lists->links()); ?>

                                </div>
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
        var is_ok = false;
        error = "";
        $('#alert').hide();
        $('.input-daterange input').each(function() {
            $(this).datepicker("clearDates");
        });

        (function($){
            $('#filter').submit(function(event){

               var from = $('input[name="from"]').val();
               var to = $('input[name="to"]').val();
               if(isEmpty(from) && isEmpty(to)){
                    event.preventDefault();
                   $('#msg').html(null);
                    $('#msg').html("Filter date is empty.");
                    $('#alert').show();
               }

            });

        })($);
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>