<?php $__env->startSection('content'); ?>
    <div class="col-md-12 wrapper">
        <div class="alert alert-jim">
            <h3 class="page-header">Leave Documents
            </h3>
            <form class="form-inline" method="POST" action="<?php echo e(asset('search')); ?>" onsubmit="return searchDocument();" id="searchForm">
                <?php echo e(csrf_field()); ?>

                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search ID and or NAME" name="keyword" value="<?php echo e(Session::get('keyword')); ?>" autofocus>
                    <button  type="submit" name="search" value="search" class="btn btn-default"><i class="fa fa-search"></i> Search</button>
                    <a class="btn btn-success" href="<?php echo e(asset('form/leave')); ?>">Create new</a>
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
                        <?php if(isset($leaves) and count($leaves) >0): ?>
                            <div class="table-responsive">
                                <table class="table table-list table-hover table-striped">
                                    <thead>
                                     <tr>
                                        <td>Date Created</td>
                                        <td>Application for Leave</td>
                                        <td><span class="glyphicon glyphicon-cog" aria-hidden="true"></span></td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($leaves as $leave): ?>
                                        <tr>
                                            <td><?php echo e($leave->date_filling); ?></td>
                                            <td><?php echo e($leave->vication_leave_type); ?></td>
                                            <td><a class="btn btn-success" href="<?php echo e(asset('leave/update')); ?>">Update</a> </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php echo e($leaves->links()); ?>


                        <?php else: ?>
                            <div class="alert alert-danger" role="alert">Documents records are empty.</div>
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