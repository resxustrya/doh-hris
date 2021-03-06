<?php
    use App\Http\Controllers\DocumentController as Doc;
    use App\User;
    $pending = Doc::pendingDocuments();
    $count = 0;
    $duration="duration"."0";
?>
<span id="url" data-link="<?php echo e(asset('date_in')); ?>"></span>
<span id="token" data-token="<?php echo e(csrf_token()); ?>"></span>
<div class="col-md-3 wrapper">
    <div class="panel panel-jim">
        <div class="panel-heading">
            <h3 class="panel-title">PENDING DOCUMENTS</h3>                
        </div> 
        <div class="panel-body"> 
            <?php foreach($pending as $pend): ?>
            <table class="table table-hover table-<?php echo e($pend->id); ?>">
                <thead>
                    <tr><th><?php echo e(Doc::getDocType($pend->route_no)); ?></th></tr>
                </thead>
                <tbody>
                    <tr><td>Route #: <?php echo e($pend->route_no); ?></td></tr>
                    <?php
                        $user = User::find($pend->delivered_by);
                        Session::put('date_in',array($pend->date_in));
                    ?>
                    <tr><td>From: <?php echo e($user->fname.' '.$user->lname); ?></td></tr>
                    <input type="hidden" data-div="div-<?php echo e($pend->id); ?>" class="duration" value="<?php echo e($pend->date_in); ?>">
                    <tr>
                        <td>
                            <body onload=display_duration();>
                                Duration: <font id='<?php echo e($duration); ?>'></font>
                                <?php
                                    $_SESSION['count'][$count] = $pend->date_in;
                                    /*echo $_SESSION['count'][$count]." ".$count;*/
                                    $count++;
                                    $duration = "duration".$count;
                                ?>
                            </body>
                        </td>
                    </tr>
                    <tr><td>
                            <a href="#document_info_pending" data-route="<?php echo e($pend->route_no); ?>" data-link="<?php echo e(asset('document/info/'.$pend->route_no)); ?>" data-toggle="modal" class="btn btn-success btn-xs"><i class="fa fa-bookmark"></i> Details</a>
                            <a href="#remove_pending" data-link="<?php echo e(asset('document/removepending/'.$pend->id)); ?>" data-id="<?php echo e($pend->id); ?>" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Done</a>
                        </td>
                    </tr>
                </tbody>
            </table>
                <input type="hidden" value="<?php echo e(Doc::timeDiff($pend->date_in)); ?>" id="time">
            <?php endforeach; ?>
                <input type="hidden" value="<?php echo e($count); ?>" id="count">
                <script type="text/javascript">
                    function refresh_c(){
                        var refresh=1000; // Refresh rate in milli seconds
                        mytime=setTimeout('display_duration()',refresh)
                    }
                    function display_duration() {
                        refresh_c();
                        var count = $("#count").val();
                        for(var i=count; i>0; i--) {
                            get_duration(i-1,i-1);
                        }
                    }
                    function get_duration(urlCount,durationCount){
                        var url = $("#url").data('link') + "/" + urlCount;
                        $.get(url, function (data) {
                            $("#duration" + durationCount).html(data);
                        });
                    }
                </script>
            <?php if(!count($pending)): ?>
                <div class="alert alert-success text-center">
                    <h4><strong>Congrats!</strong><br>You don't have pending documents.</h4>

                </div>

            <?php endif; ?>
        </div>
    </div>
</div>
