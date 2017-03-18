<?php $__env->startSection('content'); ?>
    <div class="alert alert-jim" id="inputText">
        <h2 class="page-header">Filtered DTR</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="btn-group">
                    <button class="btn btn-success" id="date_modal">Generate New
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="page-divider"></div>
        <div class="page-divider">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <?php if(isset($lists) and count($lists) >0): ?>
                            <div class="table-responsive">
                                <table class="table table-list table-hover table-striped">
                                    <thead>
                                    <tr>
                                        <th>Report ID</th>
                                        <th>Filename</th>
                                        <th>Date Generated</th>
                                        <th>Time Generated</th>
                                        <th><i class="fa fa-cog" aria-hidden="true"></i></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($lists as $list): ?>
                                        <tr>
                                            <td><?php echo e($list->id); ?></td>
                                            <td><?php echo e($list->filename); ?></td>
                                            <td><?php echo e($list->date_created); ?> </td>
                                            <td><?php echo e($list->time_created); ?> </td>
                                            <td>
                                                <a class="btn btn-success" href="<?php echo e(asset('').'/FPDF/pdf-files/'.$list->filename); ?>">View</a>
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

        $('#date_modal').click(function(){

            $('#generate_dtr').modal({
                backdrop: 'static',
                keyboard: false,
                show: true
            });
        });

        (function(){
            $('#loading_dtr').hide();

            $('#dtr_filter').submit(function(e){
                e.preventDefault();
                var url = $(this).attr('action');
                var data = {
                    filter_range : $("input[name='filter_range']").val(),
                    _token : $("input[name='_token']").val()
                };

                $.ajax({
                    url: url,
                    type: 'POST',
                    data : data,
                    success: function(res) {
                        $('#generate_dtr').fadeOut(1000);
                        $('#document_form').modal('show');
                    }
                });
            });

        })();

        $('#dtr_filter').submit(function(event){
            $(this).fadeOut(1000);
            $('#loading_dtr').show();
        });

    </script>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>