<?php
    ini_set('max_execution_time', 0);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv="cache-control" content="max-age=0" />
    <link rel="icon" href="{{ asset('resources/img/favicon.png') }}">
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('resources/assets/css/bootstrap.pdf.css') }}" rel="stylesheet">
    <title>
        JO Daily Attendance Report
    </title>
    <style>

    </style>
</head>

<body>
@for($i = 0; $i < count($lists); $i++)

    <div id="box" style="height: 800px;width: 100%;padding:2px;margin-top: 10px;">
        {{ $lists[$i]['dtr_id'] }}

    </div>

@endfor

<script src="{{ asset('resources/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('resources/assets/js/bootstrap.min.js') }}"></script>
</body>
</html>
