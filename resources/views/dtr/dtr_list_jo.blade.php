@extends('layouts.app')

@section('content')
    <div class="alert alert-jim" id="inputText">
        <h2 class="page-header">Job Order DTR</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="btn-group">
                    <button class="btn btn-success" onclick="date_modal();">Generate New
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="page-divider">

        </div>
    </div>

@endsection
@section('plugin')
    <script src="{{ asset('resources/plugin/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('resources/plugin/daterangepicker/daterangepicker.js') }}"></script>
@endsection

@section('css')
    <link href="{{ asset('resources/plugin/daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet">
@endsection
@section('js')
    @@parent
    <script>
        function date_modal()
        {
            $('#generate_dtr').modal('show');
        }
    </script>
@endsection



