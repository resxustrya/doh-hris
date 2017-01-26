<?php
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\PersonalController as personal;
if(Session::has('filter_list')) {
    $lists = Session::get('filter_list');
}
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
                                            <th class="col-sm-2" style="text-align: center;">AM</th>
                                            <th class="col-sm-2" style="text-align: center;">PM</th>
                                            <th class="col-sm-2" style="text-align: center;">UNDERTIME<br />Late | UT</th>
                                        </tr>
                                    </thead>
                                </table>
                                <table class="table table-list table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <td class="col-sm-1">Date</td>
                                            <td class="col-sm-1">DAY</td>
                                            <td class="col-sm-2">IN</td>
                                            <td class="col-sm-2">OUT</td>
                                            <td class="col-sm-2">IN</td>
                                            <td class="col-sm-2">OUT</td>
                                            <td class="col-sm-2">LATE | UT</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($lists as $list)
                                            @if($startday <= $endday)
                                                <tr>
                                                    <td>{{ $list->datein }}</td>
                                                    <td>{{ $startday ." " .personal::day_name($startday, $list) }}</td>
                                                    <td>{{  personal::get_time($list->datein, 'IN') }}</td>
                                                    <td>{{  personal::get_time($list->datein, 'OUT') }}</td>
                                                    <td>{{  personal::get_time($list->datein, 'IN') }}</td>
                                                    <td>{{  personal::get_time($list->datein, 'OUT') }}</td>
                                                    <td>{{  personal::get_time($list->datein, 'OUT') }}</td>
                                                </tr>
                                            @endif
                                           <?php $startday = $startday + 1; ?>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{ $lists->links() }}
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