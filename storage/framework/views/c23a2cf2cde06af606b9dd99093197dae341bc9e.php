<?php $__env->startSection('content'); ?>
    <div class="col-md-12 wrapper">
        <div class="alert alert-jim">
            <h3 class="page-header">Compensatory Time Off
            </h3>
            <form class="form-inline" method="POST" action="<?php echo e(asset('form/cdo_list')); ?>" onsubmit="return searchDocument();" id="searchForm">
                <?php echo e(csrf_field()); ?>

                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search here.." name="keyword" value="<?php echo e(Session::get('keyword')); ?>" autofocus>
                    <button  type="submit" name="search" value="search" class="btn btn-default"><i class="fa fa-search"></i> Search</button>
                    <?php /*<a class="btn btn-success" data-dismiss="modal" data-role="cdo" data-backdrop="static" data-toggle="modal" data-target="#form_type" style="background-color: darkmagenta;color: white;"><i class="fa fa-plus"></i> Create new</a>*/ ?>
                    <?php if($type == "list"): ?>
                        <a href="#document_form" data-link="<?php echo e(asset('form/cdov1/form')); ?>" class="btn btn-success" data-dismiss="modal" data-backdrop="static" data-toggle="modal" data-target="#document_form" style="background-color: darkmagenta;color: white;"><i class="fa fa-plus"></i> Create new</a>
                    <?php endif; ?>
                </div>
            </form>
            <div class="clearfix"></div>
            <div class="page-divider"></div>
            <div class="row">
                <div class="col-md-12">
                    <?php if(Session::get('added')): ?>
                        <div class="alert alert-success">
                            <i class="fa fa-check"></i> Successfully Added!
                        </div>
                        <?php Session::forget('added'); ?>
                    <?php endif; ?>
                    <?php if(Session::get('deleted')): ?>
                        <div class="alert alert-danger">
                            <i class="fa fa-check"></i> Successfully Deleted!
                        </div>
                        <?php Session::forget('deleted'); ?>
                    <?php endif; ?>
                    <?php if(Session::get('updated')): ?>
                        <div class="alert alert-info">
                            <i class="fa fa-check"></i> Successfully Updated!
                        </div>
                        <?php Session::forget('updated'); ?>
                    <?php endif; ?>
                    <?php if(isset($cdo) and count($cdo) >0): ?>
                        <div class="table-responsive">
                            <table class="table table-list table-hover table-striped">
                                <thead>
                                <tr>
                                    <th width="8%"></th>
                                    <th width="20%">Route #</th>
                                    <th width="20%">Prepared Name</th>
                                    <th width="15%">Prepared Date</th>
                                    <th width="15%">Document Type</th>
                                    <th>Subject</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($cdo as $row): ?>
                                    <tr>
                                        <td><a href="#track" data-link="<?php echo e(asset('form/track/'.$row->route_no)); ?>" data-route="<?php echo e($row->route_no); ?>" data-toggle="modal" class="btn btn-sm btn-success col-sm-12" style="background-color: darkmagenta;color:white;"><i class="fa fa-line-chart"></i> Track</a></td>
                                        <td><a class="title-info" data-backdrop="static" data-route="<?php echo e($row->route_no); ?>" data-link="<?php echo e(asset('/form/info/'.$row->route_no.'/cdo')); ?>" href="#document_info" data-toggle="modal"><?php echo e($row->route_no); ?></a></td>
                                        <td><?php echo e(\App\Http\Controllers\pdoController::user_search1($row->prepared_name)['fname'].' '.\App\Http\Controllers\pdoController::user_search1($row->prepared_name)['mname'].' '.\App\Http\Controllers\pdoController::user_search1($row->prepared_name)['lname']); ?></td>
                                        <td><?php echo e(date('M d, Y',strtotime($row->prepared_date))); ?><br><?php echo e(date('h:i:s A',strtotime($row->prepared_date))); ?></td>
                                        <td>CTO</td>
                                        <td><?php echo e($row->subject); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <?php echo e($cdo->links()); ?>

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

        $("a[href='#document_form']").on('click',function(){
            $('.modal-title').html('CTO');
            var url = $(this).data('link');
            $('.modal_content').html(loadingState);
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

        $("a[href='#form_type']").on("click",function(){
            <?php
                $asset = asset('form/cdov1');
                $delete = asset('cdo_delete');
                $doc_type = 'CDO';
            ?>
        });

        function soon(){
            alert("Form version 2 is not available, currently develop");
        }

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>