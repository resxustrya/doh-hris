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
            border: 1px solid black;
        }
        .table-info tr td{
            font-weight:bold;
            color: #2b542c;
        }
    </style>
</head>
<body>
    <form action="" method="post">
    <div class="new-times-roman table-responsive">
        <table class="table" cellpadding="0" cellspacing="0">
            <tr>
                <td class="align"><img src="<?php echo e(asset('resources/img/doh.png')); ?>" width="100"></td>
                <td width="90%" >
                    <div class="align small-text">
                        Republic of the Philippines<br>
                        <strong>DEPARTMENT OF HEALTH REGIONAL OFFICE VII</strong><br>
                        Osmeña Boulevard, Cebu City, 6000 Philippines<br>
                        Regional Director’s Office Tel. No. (032) 253-6355 Fax No. (032) 254-0109<br>
                        Official Website: http://www.ro7.doh.gov.ph Email Address: dohro7@gmail.com<br>
                        <strong>APPLICATION FOR COMPENSATORY TIME OFF</strong>
                    </div>
                </td>
                <td class="align"><img src="<?php echo e(asset('resources/img/ro7.png')); ?>" width="100"></td>
            </tr>
        </table>
        <table class="table table-hover table-striped">
            <tr>
                <td class="col-sm-1">SECTION: </td>
                <td>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-universal-access"></i>
                        </div>
                        <input type="text" value="<?php echo e($data['section']); ?>" class="form-control" readonly>
                    </div>
                </td>
                <td class="col-sm-1">CLUSTER: </td>
                <td >
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-universal-access"></i>
                        </div>
                        <input type="text" value="<?php echo e($data['division']); ?>" class="form-control" readonly>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="col-sm-1">Prepared Date: </td>
                <td>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar-o"></i>
                        </div>
                        <input class="form-control datepickercalendar" value="<?php echo e(date('m/d/Y')); ?>" name="prepared_date" required>
                    </div>
                </td>
                <td></td>
                <td></td>
            </tr>
        </table>
        <table class="table table-hover table-striped">
            <tr>
                <td class="col-sm-7">
                    <table class="table table-list table-hover table-striped table-info">
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                        </tr>
                        <tr>
                            <td>
                                <i class="fa fa-user"></i>
                                <?php echo e($data['name']); ?>

                            </td>
                            <td>
                                <i class="fa fa-user-secret"></i>
                                <?php echo e($data['position']); ?>

                            </td>
                        </tr>
                    </table>
                </td>
                <td class="col-sm-7">
                    <table class="table table-list table-hover table-striped">
                        <tr>
                            <td colspan="2">NUMBER OF WORKING DAY/S APPLIED FOR:</td>
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
        <table class="table table-hover table-striped">
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
                            <td class="col-sm-6">
                                <input type="checkbox" class="form-control input-sm">
                            </td>
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
        <table class="table">
            <tr>
                <td class="col-sm-7">
                    <table width="100%">
                        <tr><td class="align"><strong>THERESA Q. TRAGICO</strong></td></tr>
                        <tr><td class="align">Administrative Officer V</td></tr>
                        <tr><td class="align">Personel Section</td></tr>
                    </table>
                </td>
                <td>
                    <table width="100%">
                        <tr>
                            <td class="align">
                                <select  class="chosen-select-static form-control" name="requested_by" required>
                                    <option value="">Select name</option>
                                    <option value="haha">Select Name 1</option>
                                    <option value="haha">Select Name 2</option>
                                    <option value="haha">Select Name 3</option>
                                </select>
                            </td>
                        </tr>
                        <tr><td class="align">Immediate Supervisor</td></tr>
                        <tr><td class="align"><input type="text" class="form-control"></td></tr>
                        <tr><td class="align">Division/Cluster Chief</td></tr>
                    </table>
                </td>
            </tr>
        </table>
        <hr>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
            <button type="submit" class="btn btn-success btn-submit" style="color:white;"><i class="fa fa-send"></i> Submit</button>
        </div>
    </div>
    </form>
</body>
<script>
    $('.chosen-select-static').chosen();

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
