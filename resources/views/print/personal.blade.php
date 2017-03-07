<?php
use App\Http\Controllers\PersonalController as personal;
use App\Http\Controllers\DocumentController as document;
use App\Calendar;

if(isset($lists) and count($lists) > 0) {
    $startday = $lists[0]->date_d;
    $endday = $lists[count($lists) -1 ]->date_d;
}
?>
@extends('layouts.app')

@section('content')
    <div class="col-md-12 wrapper">
        <div class="alert alert-jim">
            <h3 class="page-header">Print Monthly Attendance
            </h3>
            <form class="form-inline" method="POST" action="{{ asset('personal/print/filter') }}" id="searchForm">
                {{ csrf_field() }}
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
                        @if(isset($lists) and count($lists) >0)
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
                                            <td class="text-center">LATE | UT</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $temp1 = -0;
                                            $temp2 = -0;
                                            $condition = -0;
                                            $title = '';
                                        ?>
                                        @foreach($lists as $list)
                                            @if($startday <= $endday)
                                                <?php
                                                    $startday >= 1 && $startday < 10 ? $zero='0' : $zero = '';
                                                    $date = explode('-',$list->datein);  $datein = $date[0]."-".$date[1]."-".$zero.$startday;
                                                ?>
                                                <tr>
                                                    <?php
                                                        $am_in =  personal::get_time($datein, 'IN','AM');
                                                        if(!($am_in == '' or $am_in == null)){
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
                                                        $pm_in = personal::get_time($datein, 'IN','PM');
                                                        $pm_out = personal::get_time($datein, 'OUT','PM');
                                                        $late_undertime = personal::late_undertime($am_in,$am_out, $pm_in,$pm_out);
                                                    ?>
                                                        <td class="text-center">{{ $datein }}</td>
                                                        <td class="text-center">{{ $startday ." " .personal::day_name($startday, $list) }}</td>
                                                        @if($ok)
                                                        <td class="text-center" colspan="4"><?php echo $am_out; ?></td>
                                                        @else
                                                        <td class="text-center">{{ $am_in }}</td>
                                                        <td class="text-center"><?php echo $am_out ?></td>
                                                        <td class="text-center">{{  $pm_in }}</td>
                                                        <td class="text-center">{{  $pm_out }}</td>
                                                        @endif
                                                        <td class="text-center">{{ $late_undertime }}</td>

                                                </tr>
                                            @endif
                                           <?php $startday = $startday + 1; ?>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-danger" role="alert">DTR records are empty.</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    @@parent
    <script>
        $('.input-daterange input').each(function() {
            $(this).datepicker("clearDates");
        });

    </script>
@endsection