<?php

use App\Http\Controllers\PersonalController as personal;
use App\Http\Controllers\DocumentController as document;
use App\Calendar;

ini_set('max_execution_time', 0);
ini_set('memory_limit','1000M');
ini_set('max_input_time','300000');

if(isset($lists) and count($lists) > 0) {
    $day1 = explode('-',$date_from);
    $day2 = explode('-',$date_to);

    $startday = floor($day1[2]);
    $endday = $day2[2];
}
?>



<?php if(isset($lists) and count($lists) >0): ?>
    <div class="table-responsive">
        <table class="table table-list table-hover table-striped">
            <thead>
            <tr>
                <th class="col-sm-3" style="text-align: center;">AM</th>
                <th class="col-sm-3" style="text-align: center;">PM</th>
            </tr>
            </thead>
        </table>
        <table border="1" class="table table-list table-hover table-striped">
            <thead>
            <tr>
                <td class="text-center">Date</td>
                <td class="text-center">DAY</td>
                <td class="text-center">IN</td>
                <td class="text-center">OUT</td>
                <td class="text-center">IN</td>
                <td class="text-center">OUT</td>
                <td class="text-center">LATE</td>
                <td class="text-center">UNDERTIME</td>
            </tr>
            </thead>
            <tbody>
            <?php
            $temp1 = -0;
            $temp2 = -0;
            $condition = -0;
            $title = '';
            $am_out = '';
            $ok = false;
            $logs = null;
            $ok = false;
            $index = 0;
            $log_date = "";
            ?>
            <?php for($d = $startday; $d <= $endday; $d++): ?>
                <?php
                $d >= 1 && $d < 10 ? $zero='0' : $zero = '';
                $datein = $day1[0]."-".$day1[1]."-".$zero.$d;

                if($index != count($lists)) {
                    if($datein == $lists[$index]['datein']){
                        $log_date = $lists[$index]['datein'];
                        $logs = $lists[$index];
                        $index = $index + 1;
                    }
                }

                $am_out = '';
                $am_in =  personal::get_time($datein, 'IN','AM');
                if(!($logs['am_in'] == '' or $logs['am_in'] == null)){
                    $am_out = personal::get_time($datein, 'OUT', 'AM');
                    //flag for calendar
                    $ok = false;
                } else {
                    $condition = floor(strtotime($datein) / (60 * 60 * 24));
                    $check_calendar = document::check_calendar();
                    foreach($check_calendar as $check)
                    {
                        if(isset(Calendar::where('route_no',$check->route_no)
                                        ->where('start',$datein)
                                        ->first()->title)) {
                            $title = Calendar::where('route_no',$check->route_no)
                                    ->where('start',$datein)
                                    ->orWhere('end',$datein)
                                    ->get()
                                    ->first();
                            $temp1 = floor(strtotime($title->start) / (60 * 60 * 24));
                            $temp2 = floor(strtotime($title->end) / (60 * 60 * 24));
                        }
                        if($condition < $temp2 and $title != ''){
                            $am_out = "<p style='color:red;'>".$title->title."</p>";
                            $ok = true;
                            break;
                        }
                        else {
                            $am_out = '';
                            $ok = false;
                        }
                    }
                }

                if($datein == $log_date)
                {
                    $am_in = $logs['am_in'];
                    $am_out = $logs['am_out'];
                    $pm_in = $logs['pm_in'];
                    $pm_out = $logs['pm_out'];

                    $late = personal::late($am_in, $pm_in);
                    $ut = personal::undertime($am_out,$pm_out);
                } else {
                    $am_in = '';
                    $am_out = '';
                    $pm_in = '';
                    $pm_out = '';
                    $late = '';
                    $ut = personal::undertime($am_out,$pm_out);
                }
                ?>
                <tr>
                    <td class="text-center"><?php echo e($datein); ?></td>
                    <td class="text-center"><?php echo e(personal::day_name($datein)); ?></td>
                    <?php if($ok): ?>
                        <td class="text-center" colspan="4"><?php echo e(isset($am_out) ? $am_out : ''); ?></td>
                    <?php else: ?>
                        <td class="text-center"><?php echo e(isset($am_in) ? $am_in : ''); ?></td>
                        <td class="text-center"><?php echo e(isset($am_out) ? $am_out : ''); ?></td>
                        <td class="text-center"><?php echo e(isset($pm_in) ? $pm_in : ''); ?></td>
                        <td class="text-center"><?php echo e(isset($pm_out) ? $pm_out : ''); ?></td>
                    <?php endif; ?>
                    <td class="text-center"><?php echo e(isset($late) ? $late : ''); ?></td>
                    <td class="text-center"><?php echo e(isset($ut) ? $ut : ''); ?></td>
                </tr>
            <?php endfor; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <div class="alert alert-danger" role="alert">DTR records are empty.</div>
<?php endif; ?>
<div class="modal-footer">
    <form action="<?php echo e(asset('personal/filter/save')); ?>" method="POST">
        <input type="hidden" name="date_from" value="<?php echo e($date_from); ?>" />
        <input type="hidden" name="date_to" value="<?php echo e($date_to); ?>" />
        <?php echo e(csrf_field()); ?>

        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" href="<?php echo e(asset('')); ?>" class="btn btn-success"><i class="fa fa-barcode"></i> Save</button>
    </form>

</div>



