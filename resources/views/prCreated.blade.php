@extends('layouts.app')
@section('content')
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('resources/img/favicon.png') }}">
    <meta http-equiv="cache-control" content="max-age=0" />
    <title>HRIS</title>
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('resources/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/assets/css/bootstrap-theme.min.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/assets/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="{{ asset('resources/assets/css/ie10-viewport-bug-workaround.css') }}" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{ asset('resources/assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/assetes/css/upload.css') }}" rel="stylesheet" >
    <link href="{{ asset('resources/plugin/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}" rel="stylesheet">
    <!-- bootstrap datepicker -->
    <!--DATE RANGE-->
    <link href="{{ asset('resources/plugin/daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('resources/plugin/clockpicker/dist/jquery-clockpicker.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('resources/plugin/clockpicker/dist/bootstrap-clockpicker.min.css') }}" />
    <script src="{{ asset('resources/angular/angular.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/datepicer/css/bootstrap-datepicker3.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/datepicer/css/bootstrap-datepicker3.standalone.css') }}" />
</head>
<script src="{{ asset('resources/assets/js/jquery.min.js') }}"></script>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<!-- DATE RANGE SELECT -->
<script src="{{ asset('resources/plugin/daterangepicker/moment.min.js') }}"></script>
<script src="{{ asset('resources/plugin/daterangepicker/daterangepicker.js') }}"></script>

<script src="{{ asset('resources/assets/js/jquery-validate.js') }}"></script>
<script src="{{ asset('resources/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('resources/assets/datepicer/js/bootstrap-datepicker.js') }}"></script>
<!-- CLOCK PICKER -->
<script src="{{ asset('resources/plugin/clockpicker/dist/jquery-clockpicker.min.js') }}"></script>
<script src="{{ asset('resources/plugin/clockpicker/dist/bootstrap-clockpicker.min.js') }}"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="{{ asset('resources/assets/js/ie10-viewport-bug-workaround.js') }}"></script>
<script>var loadingState = '<center><img src="{{ asset('resources/img/spin.gif') }}" width="150" style="padding:20px;"></center>'; </script>
<!-- bootstrap datepicker -->
<script src="{{ asset('resources/assets/js/script.js') }}?v=1"></script>
<script src="{{ asset('resources/assets/js/form-justification.js') }}"></script>
<script src="{{ asset('resources/plugin/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
@yield('plugin')

        <!-- SELECT CHOOSEN -->
<script src="{{ asset('resources/plugin/chosen/chosen.jquery.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('resources/plugin/select2/select2.min.css') }}" />
    <script src="{{ asset('resources/plugin/select2/select2.full.min.js') }}"></script>
    <span id="so_append" data-link="{{ asset('so_append') }}"></span>
    <span id="inclusive_name_page" data-link="{{ asset('inclusive_name_page') }}"></span>
    <div class="col-md-12 wrapper">
        <div class="alert alert-jim">
            <h3>Office Order</h3>
            <div class="container">
                <div class="row">
                    <div class="col-md-11">
                        <form action="{{ asset('so_add') }}" method="POST" id="form_route">
                            {{ csrf_field() }}
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <td class="col-md-1"><img height="130" width="130" src="{{ asset('resources/img/doh.png') }}" /></td>
                                        <td class="col-lg-10" style="text-align: center;">
                                            Repulic of the Philippines <br />
                                            <strong>DEPARTMENT OF HEALTH REGIONAL OFFICE NO. VII</strong><br />
                                            Osmeña Boulevard, Cebu City, 6000 Philippines <br />
                                            Regional Director's Office Tel. No. (032) 253-635-6355 Fax No. (032) 254-0109 <br />
                                            Official Website:<a target="_blank" href="http://www.ro7.doh.gov.ph"><u>http://www.ro7.doh.gov.ph</u></a> Email Address: dohro7{{ '@' }}gmail.com
                                        </td>
                                        <td class="col-md-10"><img height="130" width="130" src="{{ asset('resources/img/ro7.png') }}" /> </td>
                                    </tr>
                                </table>
                                <table class="table table-hover table-form table-striped">
                                    <tr>
                                        <td colspan="3">
                                            <span>Footer Body</span>
                                            <textarea class="form-control" id="textarea1" name="footer_body" rows="8" style="resize:none;" required></textarea>
                                        </td>
                                    </tr>
                                    <td class="col-sm-8">
                                        <select class="form-control select2" name="inclusive_name[]" multiple="multiple" data-placeholder="Select a name" required>
                                            @foreach($users as $row)
                                                <option value="{{ $row['id'] }}">{{ $row['fname'].' '.$row['mname'].' '.$row['lname'] }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </table>
                                <div class="modal-footer">
                                    <a href="{{ asset('/form/so_list') }}" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</a>
                                    <button type="submit" class="btn btn-success"><i class="fa fa-send"></i> Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

@section('css')
    @@parent
    <style>
        .underline {
            border-bottom: 1px solid #000000;
            width: 50px;
        }
    </style>
@endsection
@section('js')
    @parent
    <script>
        $("#textarea").wysihtml5();
        $("#textarea1").wysihtml5();
        $(".select2").select2();
        $('.datepickercalendar').datepicker({
            autoclose: true
        });
        //rusel
        $('#inclusive1').daterangepicker();
        var count = 1;
        function add_inclusive(){
            event.preventDefault();
            count++;
            var url = $("#so_append").data('link')+"?count="+count;
            $.get(url,function(result){
                $(".p_inclusive_date").append(result);
            });
        }
        $.get($('#inclusive_name_page').data('link'),function(result){
            $('.select2').select2({}).select2('val', result);
            console.log(result);
        });
    </script>
@endsection