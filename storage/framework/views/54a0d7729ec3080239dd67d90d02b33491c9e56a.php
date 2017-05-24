<title>Office Order</title>
<head>
    <style>
        .align{
            text-align: center;
        }
        .new-times-roman{
            font-family: "Times New Roman", Times, serif;
            font-size: 11.5pt;
            padding: 15px;;
        }
        #border{
            border-collapse: collapse;
            border: none;
        }
    </style>
</head>
<body>
    <div class="new-times-roman table-responsive">
        <table class="table" cellpadding="0" cellspacing="0">
            <tr>
                <td id="border" class="align"><img src="<?php echo e(asset('resources/img/doh.png')); ?>" width="100"></td>
                <td width="90%" id="border">
                    <div class="align small-text" style="margin-top:-10px;font-size: 10.5pt">
                        Republic of the Philippines<br>
                        <strong>DEPARTMENT OF HEALTH REGIONAL OFFICE VII</strong><br>
                        Osmeña Boulevard, Cebu City, 6000 Philippines<br>
                        Regional Director’s Office Tel. No. (032) 253-6355 Fax No. (032) 254-0109<br>
                        Official Website: http://www.ro7.doh.gov.ph Email Address: dohro7@gmail.com<br>
                        <strong>APPLICATION FOR COMPENSATORY TIME OFF</strong>
                    </div>
                </td>
                <td id="border" class="align"><img src="<?php echo e(asset('resources/img/ro7.png')); ?>" width="100"></td>
            </tr>
        </table>
        <table class="table">
            <tr>
                <td id="border">SECTION_______</td>
                <td id="border" width="40%">CLUSTER_______</td>
                <td id="border">PREPARED DATE______</td>
            </tr>
        </table>
        <table class="table">
            <tr>
                <td class="col-sm-7">
                    <table class="table table-list table-hover table-striped">
                        <tr>
                            <th colspan="2">Name</th>
                            <th>Position</th>
                        </tr>
                    </table>
                </td>
                <td>
                    <table class="table table-list table-hover table-striped">
                        <tr>
                            <td colspan="2">NUMBER OF WORKING DAY/S APPLIED FOR:</td>
                        </tr>
                        <tr>
                            <td class="col-sm-4"><input type="text" class="form-control" readonly></td>
                            <td>day/s</td>
                        </tr>
                        <tr>
                            <td class="col-sm-4">Inlusive Dates:</td>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control" id="inclusive1" name="inclusive[]" placeholder="Input date range here..." required>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table class="table">
            <tr>
                <td class="col-sm-7">
                    <table class="table table-list table-hover table-striped">
                        <tr>
                            <td colspan="3"><strong>CERTIFICATION OF COMPENSATORY OVERTIME CREDITS</strong></td>
                        </tr>
                        <tr>
                            <td>Beginning Balance</td>
                            <td>Less Applied for</td>
                            <td>Remaining Balance</td>
                        </tr>
                        <tr>
                            <td><input type="text" class="form-control"></td>
                            <td><input type="text" class="form-control"></td>
                            <td><input type="text" class="form-control"></td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table class="table table-list table-hover table-striped">
                        <tr>
                            <th colspan="2">RECOMENDATION:</th>
                        </tr>
                        <tr>
                            <td class="col-sm-6"><input type="checkbox" class="form-control input-sm"></td>
                            <td>Approval</td>
                        </tr>
                        <tr>
                            <td class="col-sm-6"><input type="checkbox" class="form-control input-sm"></td>
                            <td>Disapproval</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <hr>
    </div>
</body>
<script>
    $('.datepickercalendar').datepicker({
        autoclose: true
    });
    $(function(){
        $("body").delegate("#inclusive1","focusin",function(){
            $(this).daterangepicker();
        });
    });
    $('.form-submit').on('submit',function(){
        $('.btn-submit').attr("disabled", true);
    });
</script>
