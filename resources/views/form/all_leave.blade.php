@extends('layouts.app')


@section('content')
    <div class="col-md-12 wrapper">
        <div class="alert alert-jim">
            <h3 class="page-header">Leave Documents
            </h3>
            <form class="form-inline" method="POST" action="{{ asset('search') }}" onsubmit="return searchDocument();" id="searchForm">
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search ID and or NAME" name="keyword" value="{{ Session::get('keyword') }}" autofocus>
                    <button  type="submit" name="search" value="search" class="btn btn-default"><i class="fa fa-search"></i> Search</button>
                    <a class="btn btn-success" href="{{ asset('form/leave') }}">Create new</a>
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
                        @if(isset($leaves) and count($leaves) >0)
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
                                    @foreach($leaves as $leave)
                                        <tr>
                                            <td>{{ $leave->date_filling }}</td>
                                            <td>{{ $leave->vication_leave_type }}</td>
                                            <td><a class="btn btn-success" href="{{ asset('leave/update') }}">Update</a> </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{ $leaves->links() }}

                        @else
                            <div class="alert alert-danger" role="alert">Documents records are empty.</div>
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
