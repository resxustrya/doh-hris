<?php
$total = 0;
$item_no = 1;
?>
        <!DOCTYPE html>
<html>
<title>Office Order</title>
<head>
    <link href="{{ asset('resources/assets/css/print.css') }}" rel="stylesheet">
    <style>
        html {
            margin-top: 10px;
            margin-right: 50px;
            margin-left: 50px;
            margin-bottom: 50px;
            font-size:x-small;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }
        #border{
            border-collapse: collapse;
            border: none;
        }
        #border-top{
            border-collapse: collapse;
            border-top: none;
        }
        #border-right{
            border-collapse: collapse;
            border:1px solid #000;
        }
        #border-bottom{
            border-collapse: collapse;
            border-bottom: none;
        }
        #border-bottom-t{
            border-collapse: collapse;
            border-top:1px solid red;
            border-bottom:1px solid red;
        }
        #border-left{
            border-collapse: collapse;
            border:1px solid #000;
        }
        .align{
            text-align: center;
        }
        .align-top{
            vertical-align : top;
        }
        .table1 {
            width: 100%;
        }
        .table1 td {
            border:1px solid #000;
        }
        .footer {
            width: 100%;
            text-align: center;
            position: fixed;
        }
        .footer {
            bottom: 15px;
        }
        .pagenum:before {
            content: counter(page);
        }
        .pagenum:before {
            content: counter(page);
        }
        .new-times-roman{
            font-family: "Times New Roman", Times, serif;
            font-size: 11.5pt;
        }
    </style>
</head>
<div class="footer">
    <hr>
    <div style="position:absolute; left: 30%;" class="align">
        <?php echo DNS1D::getBarcodeHTML(Session::get('route_no'),"C39E",1,28) ?>
        <font class="route_no">{{ Session::get('route_no') }}</font>
    </div>
</div>
    <body>
        <div class="new-times-roman">
            <table class="letter-head" cellpadding="0" cellspacing="0">
                <tr>
                    <td id="border" class="align"><img src="{{ asset('resources/img/doh.png') }}" width="100"></td>
                    <td width="90%" id="border">
                        <div class="align small-text" style="margin-top:-10px;font-size: 10.5pt">
                            Republic of the Philippines<br>
                            <strong>DEPARTMENT OF HEALTH REGIONAL OFFICE VII</strong><br>
                            Osmeña Boulevard, Cebu City, 6000 Philippines<br>
                            Regional Director’s Office Tel. No. (032) 253-6355 Fax No. (032) 254-0109<br>
                            Official Website: http://www.ro7.doh.gov.ph Email Address: dohro7@gmail.com<br>
                        </div>
                    </td>
                    <td id="border" class="align"><img src="{{ asset('resources/img/ro7.png') }}" width="100"></td>
                </tr>
            </table>
            <hr>

            <table class="letter-head" cellpadding="0" cellspacing="0">
                <tr>
                    <td colspan="4" id="border">{{ date('d M Y',strtotime($office_order->prepared_date)) }}</td>
                </tr>
                <tr>
                    <td colspan="4" id="border"><b>OFFICE ORDER&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</b></td>
                </tr>
                <tr>
                    <td colspan="4" id="border">No.<h2 style="display: inline;"><u>&nbsp;&nbsp;&nbsp;{{ sprintf('%04u',$office_order->id) }}&nbsp;&nbsp;&nbsp;</u></h2>{{ 's,'.date('Y',strtotime($office_order->prepared_date)) }}&nbsp;&nbsp;<b>)</b></td>
                </tr>
                <tr>
                    <td colspan="4" id="border"><b>SUBJECT:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>{{ $office_order->subject }}</u></td>
                </tr>
                <tr>
                    <td colspan="4" id="border">{!! nl2br($office_order->header_body) !!}</td>
                </tr>
                <tr>
                    <td width="20%" id="border"></td>
                    <td id="border"><b>Name</b></td>
                    <td id="border"><b>Designation</b></td>
                    <td width="20%" id="border"></td>
                </tr>
                <?php $count = 0; ?>
                @foreach($name as $row)
                <?php $count++; ?>
                <tr>
                    <td width="20%" id="border"></td>
                    <td id="border">{{ $count.'. '.$row['fname'].' '.$row['mname'].' '.$row['lname'] }}</td>
                    <td id="border">{{ \App\Http\Controllers\pdoController::designation_search($row['designation'])['description'] }}</td>
                    <td width="20%" id="border"></td>
                </tr>
                @endforeach
            </table>
            <table class="letter-head" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="20%" id="border"></td>
                    <td><b>Dates</b></td>
                    <td><b>Areas</b></td>
                    <td width="20%" id="border"></td>
                </tr>
                @foreach($inclusive_date as $row)
                <tr>
                    <td width="20%" id="border"></td>
                    <td>{{ date('M d, Y',strtotime($row->start)).' to '.date('M d, Y',strtotime('-1 day',strtotime($row->end))) }}</td>
                    <td>{{ $row->area }}</td>
                    <td width="20%" id="border"></td>
                </tr>
                @endforeach
            </table>
            <table class="letter-head" cellpadding="0" cellspacing="0">
                <tr>
                    <td colspan="3" id="border">{!! nl2br($office_order->footer_body) !!}</td>
                </tr>
                <tr>
                    <td id="border"></td>
                </tr>
                <tr>
                    <td colspan="3" id="border">
                        <b><u>
                            {{ $office_order->approved_by }}
                        </u></b><br>
                        @if($office_order->approved_by == 'Jaime S. Bernadas, MD, MGM, CESO III')
                            Director IV
                        @else
                            Director III
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>