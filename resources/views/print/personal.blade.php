<?php
use App\Http\Controllers\PersonalController as personal;

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
                                        @foreach($lists as $list)
                                            @if($startday <= $endday)
                                                <?php $date = explode('-',$list->datein);  $datein = $date[0]."-".$date[1]."-".$startday ?>
                                                <tr>
                                                    <?php
                                                        $am_in =  personal::get_time($datein, 'IN','AM');
                                                    ?>
                                                    <td class="text-center">{{ $datein }}</td>
                                                    <td class="text-center">{{ $startday ." " .personal::day_name($startday, $list) }}</td>
                                                    <td class="text-center">{{  personal::get_time($datein, 'IN','AM') }}</td>
                                                    <td class="text-center">{{  (!($am_in == '' or $am_in == null)) ? personal::get_time($datein, 'OUT', 'AM') : '' }}</td>
                                                    <td class="text-center">{{  personal::get_time($datein, 'IN','PM') }}</td>
                                                    <td class="text-center">{{  personal::get_time($datein, 'OUT','PM') }}</td>
                                                    <td class="text-center">{{  personal::late($am_in) }}</td>
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