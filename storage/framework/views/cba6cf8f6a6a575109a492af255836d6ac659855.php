
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
    <link rel="icon" href="<?php echo e(asset('resources/img/favicon.png')); ?>">
    <!-- Bootstrap core CSS -->
    <link href="<?php echo e(asset('resources/assets/css/bootstrap.pdf.css')); ?>" rel="stylesheet">
    <title>
       Application fo Leave
    </title>
</head>

<body>

<table border="2" style="width: 100%;">
    <thead></thead>
    <tbody>
    <tr>
        <th style="width: 100%;text-align: center; font-size: x-large;">APPLICATION FOR LEAVE</th>
    </tr>
    </tbody>
</table>
<table border="2" style="width: 100%;border-top: 0px;" >
    <tr>
        <td>
            <p style="padding: 10px;">
                Office/Agency <br /><b><?php echo e($leave->office_agency); ?></b>
            </p>
        </td>
        <td>
            <div style="padding: 10px;">
                <span class="col-sm-3">(2.) Name</span>
                <span class="col-sm-3 tab1">(Last)</span>
                <span class="col-sm-3">(First)</span>
                <span class="col-sm-3">(M.I.)</span>
            </div>
            <div style="padding: 10px;">
                <span class="col-sm-3">&nbsp;</span>
                <span class="col-sm-3 tab1"><b><?php echo e($leave->lastname); ?></b></span>
                <span class="col-sm-3"><b><?php echo e($leave->firstname); ?></b></span>
                <span class="col-sm-3"><b><?php echo e($leave->middlename); ?></b></span>
            </div>
        </td>
    </tr>
</table>
<table border="2" style="width: 100%;border-top: 0px;">
    <tr>
        <td>
            <p style="padding: 10px;">
                (3.) Date of Filling<br /><b><?php echo e($leave->date_filling); ?></b>
            </p>
        </td>
        <td>
            <p style="padding: 10px;">
                (4.) Position<br /><b><?php echo e($leave->position); ?></b>
            </p>
        </td>
        <td>
            <p style="padding: 10px;">
                (5.) Salary (Monthly)<br /><b><?php echo e($leave->salary); ?></b>
            </p>
        </td>
    </tr>
</table>
<table border="2" style="width: 100%;">
    <thead></thead>
    <tbody>
    <tr>
        <th style="width: 100%;text-align: center; font-size: x-large;">DETAILS OF APPLICATION</th>
    </tr>
    </tbody>
</table>
<table border="2" style="width: 100%;" >
    <thead></thead>
    <tbody>
    <tr>
        <td style="width: 50%;">
            <div style="padding:10px;width: 100%;">
                <strong>(6a) TYPE OF LEAVE</strong>
                <br /><br />
                <table border="0" style="width: 100%;">
                    <thead>
                    <tr><th></th><th></th></tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td style="width: 20%;">
                            <?php if($leave->leave_type == "Vication"): ?>
                                <strong><span style="font-family: DejaVu Sans;">&#10004; </span></strong>
                            <?php else: ?>
                                <span style="text-decoration: underline;width: 20%;" aria-hidden="true">&nbsp;</span>
                            <?php endif; ?>
                        </td>
                        <td><strong>VACATION</strong></td>
                    </tr>
                    <tr>
                        <td style="width: 20%;">
                            <?php if($leave->leave_type == "To_sake_employement"): ?>
                                <strong><span style="font-family: DejaVu Sans;">&#10004; </span></strong>
                            <?php else: ?>
                                <span style="text-decoration: underline;width: 20%;" aria-hidden="true">&nbsp;</span>
                            <?php endif; ?>
                        </td>
                        <td><strong>TO SAKE EMPLOYEMENT</strong></td>
                    </tr>
                    <tr>
                        <td style="width: 20%;">
                            <?php if($leave->leave_type == "Others"): ?>
                                <strong><span style="font-family: DejaVu Sans;">&#10004; </span></strong>
                            <?php else: ?>
                                <span style="text-decoration: underline;width: 20%;" aria-hidden="true">&nbsp;</span>
                            <?php endif; ?>
                        </td>
                        <td><strong>OTHERS (specify)</strong></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            <?php if(isset($leave->leave_type_others_1)): ?>
                                <span class="tab2"><em><?php echo e($leave->leave_type_others_1); ?></em></span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 20%;">
                            <?php if($leave->leave_type == "Sick"): ?>
                                <strong><span style="font-family: DejaVu Sans;">&#10004; </span></strong>
                            <?php else: ?>
                                <span style="text-decoration: underline;width: 20%;" aria-hidden="true">&nbsp;</span>
                            <?php endif; ?>
                        </td>
                        <td><strong>SICK</strong></td>
                    </tr>
                    <tr>
                        <td style="width: 20%;">
                            <?php if($leave->leave_type == "Maternity"): ?>
                                <strong><span style="font-family: DejaVu Sans;">&#10004; </span></strong>
                            <?php else: ?>
                                <span style="text-decoration: underline;width: 20%;" aria-hidden="true">&nbsp;</span>
                            <?php endif; ?>
                        </td>
                        <td><strong>MATERNITY</strong></td>
                    </tr>
                    <tr>
                        <td style="width: 20%;">
                            <?php if($leave->leave_type == "Others2"): ?>
                                <strong><span style="font-family: DejaVu Sans;">&#10004; </span></strong>
                            <?php else: ?>
                                <span style="text-decoration: underline;width: 20%;" aria-hidden="true">&nbsp;</span>
                            <?php endif; ?>
                        </td>
                        <td><strong>OTHERS (specify)</strong></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            <?php if(isset($leave->leave_type_others_2)): ?>
                                <span class="tab2"><em><?php echo e($leave->leave_type_others_2); ?></em></span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <strong>(6c) NUMBER OF WORKING DAYS APPLIED <br /> FOR :
                    <?php if(isset($leave->applied_num_days)): ?>
                        <span style="text-decoration: underline;" class="tab2"><?php echo e($leave->applied_num_days); ?></span>
                    <?php endif; ?>
                </strong>
                <div style="padding:10px;width: 100%;">
                    <strong class="col-md-4">Inclusive Dates : </strong>
                    <strong class="col-md-5">
                        <?php echo e($leave->inc_from); ?> - <?php echo e($leave->inc_to); ?>

                    </strong>
                </div>
            </div>
        </td>
        <td style="width: 50%;">
            <div style="padding:10px;width: 100%;">
                <strong>(6a) TYPE OF LEAVE</strong>
                <br />
                <span>(1) In case of vacation leave</span>
                <table border="0" style="width: 100%;">
                    <thead>
                    <tr><th></th><th></th></tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td style="width: 20%;">
                            <?php if($leave->vication_loc == "local"): ?>
                                <strong><span style="font-family: DejaVu Sans;">&#10004; </span></strong>
                            <?php else: ?>
                                <span style="text-decoration: underline;width: 20%;" aria-hidden="true">&nbsp;</span>
                            <?php endif; ?>
                        </td>
                        <td><strong> Within the Philippines</strong></td>
                    </tr>
                    <tr>
                        <td>
                            <?php if($leave->vication_loc == "abroad"): ?>
                                <strong><span style="font-family: DejaVu Sans;">&#10004; </span></strong>
                            <?php else: ?>
                                <span style="text-decoration: underline;width: 20%;" aria-hidden="true">&nbsp;</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <strong class="col-sm-6">
                                Abroad (specify)
                            </strong>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            <?php if(isset($leave->abroad_others)): ?>
                                <span class="tab2"><em><?php echo e($leave->abroad_others); ?></em></span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <br />
                <span>(1) In case of sick leave</span>
                <table border="0" style="width: 100%;">
                    <thead>
                    <tr><th></th><th></th></tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td style="width: 20%;">
                            <?php if($leave->sick_loc == "in_hostpital"): ?>
                                <strong><span style="font-family: DejaVu Sans;">&#10004; </span></strong>
                            <?php else: ?>
                                <span style="text-decoration: underline;width: 20%;" aria-hidden="true">&nbsp;</span>
                            <?php endif; ?>
                        </td>
                        <td><strong> In Hospital</strong></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            <em>
                                <?php if(isset($leave->in_hospital_specify)): ?>
                                    <?php echo e($leave->in_hospital_specify); ?>

                                <?php else: ?>
                                    <strong><hr /></strong>
                                <?php endif; ?>
                            </em>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php if($leave->sick_loc == "out_patient"): ?>
                                <strong><span style="font-family: DejaVu Sans;">&#10004; </span></strong>
                            <?php else: ?>
                                <span style="text-decoration: underline;width: 20%;" aria-hidden="true">&nbsp;</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <strong class="col-sm-6">Out-patient (specify)</strong>
                        </td>
                    </tr>
                    <tr>
                        <em>
                            <?php if(isset($leave->out_patient_specify)): ?>
                                <?php echo e($leave->out_patient_specify); ?>

                            <?php else: ?>
                                <strong><hr /></strong>
                            <?php endif; ?>
                        </em>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div style="padding:10px;width: 100%;">
                <strong>(6d) COMMUTATION</strong>
                <br />
                <table border="0" style="width: 100%;">
                    <thead><th></th></thead>
                    <tbody>
                    <tr>
                        <td>
                            <?php if($leave->com_requested == "yes"): ?>
                                <strong class="col-sm-1">
                                    <strong><span style="font-family: DejaVu Sans;">&#10004; </span></strong>
                                </strong>
                                <strong class="col-sm-6">
                                    Requested
                                </strong>
                            <?php else: ?>
                                <strong class="col-sm-1">
                                    <strong><span style="font-family: DejaVu Sans;">&#10004; </span></strong>
                                </strong>
                                <strong class="col-sm-6">
                                    Not Requested
                                </strong>
                            <?php endif; ?>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div style="padding:10px;width: 100%;">
                <br />
                <p style="border-top: solid 2px black; width: 100%;text-align: center;">Signature</p>
            </div>
        </td>
    </tr>
    </tbody>
</table>
<table border="2" style="width: 100%;">
    <thead></thead>
    <tbody>
    <tr>
        <th style="width: 100%;text-align: center; font-size: x-large;">DETAILS OF ACTION ON APPLICATION</th>
    </tr>
    </tbody>
</table>
<table border="2" style="width: 100%;" >
    <thead></thead>
    <tbody>
    <tr>
        <td style="width: 50%;">
            <div class="row" style="padding:10px;">
                <div class="col-md-12">
                    <strong>(6a) CERTIFICATION OF LEAVE CREDITS <br />AS OF : <span style="text-decoration: underline;"><?php echo e($leave->credit_date); ?></span></strong>
                    <div class="row">
                        <div class="col-md-12">
                            <br />
                            <table border="2" style="width: 100%; text-align: center;">
                                <thead>
                                <tr>
                                    <th style="text-align: center;">Vacation</th>
                                    <th style="text-align: center;">Sick</th>
                                    <th style="text-align: center;">Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td height="60"></td>
                                    <td height="60"></td>
                                    <td height="60"></td>
                                </tr>
                                <tr>
                                    <td class="col-md-1"><b><?php echo e((isset($leave->vication_total) ? $leave->vication_total : 0)); ?></b> Days</td>
                                    <td class="col-md-1"><b><?php echo e((isset($leave->sick_total) ? $leave->sick_total : 0)); ?></b> Days</td>
                                    <td class="col-md-1"><b><?php echo e((isset($leave->over_total) ? $leave->over_total : 0)); ?></b> Days</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <br />
                    <u style="text-decoration: underline solid; color: #000; width: 100%;"><b>REBECCA Q. BULAWAN</b></u>
                    <br />
                    <strong>ADMINISTRATIVE OFFICER V</strong>
                </div>
            </div>
        </td>
        <td style="width: 50%;">
            <div style="padding: 10px;width:100%;">
                <strong>(7b) RECOMMENDATION</strong>
                <br />
                <table style="width:100%;">
                    <thead></thead>
                    <tbody>
                        <tr>
                            <td>
                                <?php if($leave->reco_approval == "approve"): ?>
                                    <strong><span style="font-family: DejaVu Sans;">&#10004; </span></strong>
                                <?php else: ?>
                                    <span style="text-decoration: underline;width: 20%;" aria-hidden="true">&nbsp;</span>
                                <?php endif; ?>
                            </td>
                            <td> <strong>Approval</strong></td>
                        </tr>
                        <tr>
                            <td>
                                <?php if($leave->reco_approval == "disapprove"): ?>
                                    <strong><span style="font-family: DejaVu Sans;">&#10004; </span></strong>
                                <?php else: ?>
                                    <span style="text-decoration: underline;width: 20%;" aria-hidden="true">&nbsp;</span>
                                <?php endif; ?>
                            </td>
                            <td><strong class="col-sm-6">Disapproval</strong></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Due to:</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>
                                <span class="tab2">
                                    <?php if(isset($leave->disaprove_due_to)): ?>
                                        <em><?php echo e($leave->disaprove_due_to); ?></em>
                                    <?php endif; ?>
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </td>
    </tr>
    </tbody>
</table>
<table border="2" style="width: 100%;">
    <thead></thead>
    <tbody>
    <tr>
        <td style="width: 50%;">
            <div style="padding: 10px;width:100%;">
                <strong>(7c) APPROVE FOR :</strong>
                <br />
                <br />
                <table style="width: 60%;">
                    <tr>
                        <td><strong style="text-decoration: underline;"><?php echo e((isset($leave->a_days_w_pay) ? $leave->a_days_w_pay : 0)); ?></strong></td>
                        <td>day(s) with pay</td>
                    </tr>
                    <tr>
                        <td><strong style="text-decoration: underline;"><?php echo e((isset($leave->a_days_wo_pay) ? $leave->a_days_wo_pay : 0)); ?></strong></td>
                        <td>day(s) without pay</td>
                    </tr>
                    <tr>
                        <td><strong style="text-decoration: underline;"><?php echo e((isset($leave->a_others) ? $leave->a_others : 0)); ?></strong></td>
                        <td>others(specify)</td>
                    </tr>
                </table>
            </div>
        </td>
        <td style="width: 50%;">
            <div style="padding: 10px; width: 100%;">
                <strong>DISAPPROVED DUE TO :</strong>
                <br />
                <br />
                <?php if(isset($leave->disaprove_due_to)): ?>
                    <em><?php echo e($leave->disaprove_due_to); ?></em>
                <?php endif; ?>
            </div>
        </td>
    </tr>
    </tbody>
</table>
<table border="2" style="width: 100%;" >
    <tr>
        <td>
            <div class="row" style="padding: 10px; text-align: center;">
                <strong><em><b>By Authority of the Secretary of Health</b></em></strong>
            </div>
            <table style="width: 100%;">
                <thead></thead>
                <tbody>
                <tr>
                    <td style="padding: 10px;">
                        <br /><br />
                        <p class="text-center" style="border-top: solid 2px black; width: 50%;">Date</p>
                    </td>
                    <td style="padding: 10px;">
                        <br /><br />
                        <p class="text-center" style="border-top: solid 2px black; width: 70%;">Authorized Official</p>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
</table>



<style>

</style>

<script src="<?php echo e(asset('resources/assets/js/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('resources/assets/js/bootstrap.min.js')); ?>"></script>
</body>
</html>
