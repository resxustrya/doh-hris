<?php $__env->startSection('content'); ?>
    <div class="col-md-12 wrapper">
        <div class="alert alert-jim">
            <h3 class="page-header">Office Order
            </h3>
            <form class="form-inline" method="POST" action="<?php echo e(asset('search')); ?>" onsubmit="return searchDocument();" id="searchForm">
                <?php echo e(csrf_field()); ?>

                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search ID and or NAME" name="keyword" value="<?php echo e(Session::get('keyword')); ?>" autofocus>
                    <button  type="submit" name="search" value="search" class="btn btn-default"><i class="fa fa-search"></i> Search</button>
                    <a class="btn btn-success" href="<?php echo e(asset('form/so')); ?>" style="background-color: darkmagenta;color: white;">Create new</a>
                </div>
            </form>
            <div class="clearfix"></div>
            <div class="page-divider"></div>
            <div class="row">
                <div class="col-md-12">
                    <?php if(isset($office_order) and count($office_order) >0): ?>
                        <div class="table-responsive">
                            <table class="table table-list table-hover table-striped">
                                <thead>
                                <tr>
                                    <th width="8%"></th>
                                    <th width="20%">Route #</th>
                                    <th width="15%">Prepared Date</th>
                                    <th width="20%">Document Type</th>
                                    <th>Remarks</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($office_order as $so): ?>
                                    <tr>
                                        <td><a href="#track" data-link="<?php echo e(asset('')); ?>" data-toggle="modal" class="btn btn-sm btn-success col-sm-12" style="background-color: darkmagenta;color:white;"><i class="fa fa-line-chart"></i> Track</a></td>
                                        <td><a class="title-info" data-route="<?php echo e($so->route_no); ?>" data-link="<?php echo e(asset('/form/info/'.$so->route_no)); ?>" href="#document_info" data-toggle="modal"><?php echo e($so->route_no); ?></a></td>
                                        <td>March 14,2017</td>
                                        <td>Office Order</td>
                                        <td><?php echo e($so->subject); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <?php echo e($office_order->links()); ?>

                    <?php else: ?>
                        <div class="alert alert-danger" role="alert">Documents records are empty.</div>
                    <?php endif; ?>
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
        $('a[href="#leave').click(function(){
            var id = $(this).data('id');
            var url = $(this).data('link');
            $.get(url +'/' +id , function(data){
                $('#document_form').modal('show');
                $('.modal-body').html(data);
            });
        });
        //document information
        $("a[href='#document_info']").on('click',function(){
            var route_no = $(this).data('route');
            $('.modal_content').html(loadingState);
            $('.modal-title').html('Route #: '+route_no);
            var url = $(this).data('link');
            setTimeout(function(){
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(data) {
                        $('.modal_content').html(data);
                        $('#reservation').daterangepicker();
                        var datePicker = $('body').find('.datepicker');
                        $('input').attr('autocomplete', 'off');
                    }
                });
            },1000);

        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>