@extends('layouts.app')
@section('content')
    <div class="col-md-12 wrapper">
        <div class="alert alert-jim">
            <h3 class="page-header">Compensatory Time Off
            </h3>
            <form class="form-inline" method="POST" action="{{ asset('form/cdo_list') }}" onsubmit="return searchDocument();" id="searchForm">
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search here.." name="keyword" value="{{ Session::get('keyword') }}" autofocus>
                    <button  type="submit" name="search" value="search" class="btn btn-default"><i class="fa fa-search"></i> Search</button>
                </div>
            </form>
            <div class="clearfix"></div>
            <div class="page-divider"></div>
            <div class="row">
                <div class="col-md-12">
                    @if(Session::get('added'))
                        <div class="alert alert-success">
                            <i class="fa fa-check"></i> Successfully Added!
                        </div>
                        <?php Session::forget('added'); ?>
                    @endif
                    @if(Session::get('deleted'))
                        <div class="alert alert-danger">
                            <i class="fa fa-check"></i> Successfully Deleted!
                        </div>
                        <?php Session::forget('deleted'); ?>
                    @endif
                    @if(Session::get('updated'))
                        <div class="alert alert-info">
                            <i class="fa fa-check"></i> Successfully Updated!
                        </div>
                        <?php Session::forget('updated'); ?>
                    @endif
                    @if(isset($cdo) and count($cdo) >0)
                        <div class="table-responsive">
                            <table class="table table-list table-hover table-striped">
                                <thead>
                                <tr>
                                    <th width="8%"></th>
                                    <th width="20%">Route #</th>
                                    <th width="15%">Prepared Date</th>
                                    <th width="20%">Document Type</th>
                                    <th>Subject</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cdo as $row)
                                    <tr>
                                        <td><a href="#track" data-link="{{ asset('form/track/'.$row->route_no) }}" data-route="{{ $row->route_no }}" data-toggle="modal" class="btn btn-sm btn-success col-sm-12" style="background-color: darkmagenta;color:white;"><i class="fa fa-line-chart"></i> Track</a></td>
                                        <td><a class="title-info" data-backdrop="static" data-route="{{ $row->route_no }}" data-link="{{ asset('cdo/view') }}" href="#document_form" data-toggle="modal">{{ $row->route_no }}</a></td>
                                        <td>{{ date('M d, Y',strtotime($row->date)) }}<br>{{ date('h:i:s A',strtotime($row->date)) }}</td>
                                        <td>CTO</td>
                                        <td>{{ $row->subject }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $cdo->links() }}
                    @else
                        <div class="alert alert-danger" role="alert">Documents records are empty.</div>
                    @endif
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

    </script>
@endsection