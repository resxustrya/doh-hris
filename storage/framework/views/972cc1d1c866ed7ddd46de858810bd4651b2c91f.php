<?php $__env->startSection('content'); ?>
    <div class="col-md-12 wrapper">
        <div class="alert alert-jim">
            <h3 class="page-header">Edit Application for Leave
            </h3>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-11">
                        <form action="<?php echo e(asset('leave/update/save')); ?>" method="POST">
                            <input type="hidden" name="id" value="<?php echo e($leave->id); ?>" />
                            <?php echo e(csrf_field()); ?>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group has-success">
                                        <label class="control-label" for="inputSuccess1">(1.) Office/Agency</label>
                                        <input type="text" class="form-control" id="inputSuccess1" name="office_agency" value="<?php echo e($leave->office_agency); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group has-success">
                                        <label class="control-label" for="inputSuccess1">(2.)  Last Name</label>
                                        <input type="text" class="form-control" id="inputSuccess1" name="lastname" value="<?php echo e($leave->lastname); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group has-success">
                                        <label class="control-label" for="inputSuccess1">First Name</label>
                                        <input type="text" class="form-control" id="inputSuccess1" name="firstname" value="<?php echo e($leave->firstname); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group has-success">
                                        <label class="control-label" for="inputSuccess1">Middle Name</label>
                                        <input type="text" class="form-control" id="inputSuccess1" name="middlename" value="<?php echo e($leave->middlename); ?>">
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group has-success  input-daterange">
                                        <label class="control-label" for="inputSuccess1">(3.) Date of Filling</label>
                                        <input type="text" class="form-control" name="date_filling" value="<?php echo e($leave->date_filling); ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group has-success">
                                        <label class="control-label" for="inputSuccess1">(4.)  Position</label>
                                        <input type="text" class="form-control" id="inputSuccess1" name="position" value="<?php echo e($leave->position); ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group has-success">
                                        <label class="control-label" for="inputSuccess1">(5.)Salary (Monthly)</label>
                                        <input type="text" class="form-control" id="inputSuccess1" name="salary" value="<?php echo e(sprintf("%.2f",$leave->salary)); ?>">
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <h3 class="text-center">Details of Application</h3>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="alert alert-success">
                                        <strong>(6a) Type of Leave</strong>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="has-success">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="radio" id="checkboxSuccess" value="Vication" name="leave_type" <?php echo e(($leave->leave_type == 'Vication') ? ' checked' : ''); ?> >
                                                                Vacation
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="has-success">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="radio" id="checkboxSuccess" value="To_sake_employement" name="leave_type" <?php echo e($leave->leave_type == "To_sake_employement" ? ' checked' : ''); ?>>
                                                                To seek employement
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="has-success">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="radio" id="radio_others" value="Others" name="leave_type" <?php echo e($leave->leave_type == "Others" ? ' checked' : ''); ?>/>
                                                                Others(Specify)
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="has-success">
                                                        <div class="form-group has-success">
                                                            <textarea type="text" class="form-control" maxlength="200" id="inputSuccess1" name="leave_type_others_1"><?php echo e($leave->leave_type_others_1); ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="has-success">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="radio" id="checkboxSuccess" value="Sick" name="leave_type" <?php echo e($leave->leave_type == "Sick" ? ' checked' : ''); ?> />
                                                                Sick
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="has-success">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="radio" id="checkboxSuccess" value="Maternity" name="leave_type" <?php echo e($leave->leave_type == "Maternity" ? ' checked' : ''); ?> />
                                                                Maternity
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="has-success">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="radio" id="checkboxSuccess" value="Others2" name="leave_type" <?php echo e($leave->leave_type == "Others2" ? ' checked' : ''); ?>>
                                                                Others(Specify)
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="has-success">
                                                        <div class="form-group has-success">
                                                            <textarea type="text" class="form-control" maxlength="200" id="inputSuccess1" name="leave_type_others_2"><?php echo e($leave->leave_type_others_2); ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <strong>(6c.)Number of working days applied <br />For :</strong>
                                        <input type="text" name="applied_num_days" />
                                        <div class="form-group">
                                            <label class="control-label" for="inputSuccess1">Inclusive Dates :</label>
                                            <div class="input-group input-daterange">
                                                <span class="input-group-addon">From</span>
                                                <input type="text" class="form-control" name="inc_from" value="<?php echo e($leave->inc_from); ?>">
                                                <span class="input-group-addon">To</span>
                                                <input type="text" class="form-control" name="inc_to" value="<?php echo e($leave->inc_to); ?>">
                                                <span class="input-group-addon"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="alert alert-success">
                                        <strong>(6b) Where leave will be spent</strong>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="has-success">
                                                        <div class="checkbox">
                                                            <label>(1.)In case of vacation leave</label>
                                                        </div>
                                                    </div>
                                                    <div class="has-success">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="radio" id="checkboxSuccess" value="local" name="vication_loc" <?php echo e($leave->vication_loc == "local" ? ' checked' : ''); ?>>
                                                                Within the Philippines
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="has-success">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="radio" id="checkboxSuccess" value="abroad" name="vication_loc" <?php echo e($leave->vication_loc == "abroad" ? ' checked' : ''); ?> >
                                                                Abroad (specify)
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="has-success">
                                                        <div class="form-group has-success">
                                                            <textarea type="text" class="form-control" maxlength="200" id="inputSuccess1" name="abroad_others"><?php echo e($leave->abroad_others); ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="has-success">
                                                        <div class="checkbox">
                                                            <label>(2.)In case of sick leave</label>
                                                        </div>
                                                    </div>
                                                    <div class="has-success">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="radio" id="checkboxSuccess" value="in_hostpital" name="sick_loc" <?php echo e($leave->sick_loc == "in_hostpital" ? ' checked' : ''); ?>>
                                                                In Hospital (sepecify)
                                                                <input type="text"  name="in_hospital_specify"/>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="has-success">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="radio" id="checkboxSuccess" value="out_patient" name="sick_loc" <?php echo e($leave->sick_loc == "out_patient" ? ' checked' : ''); ?>>
                                                                Out-patient (sepecify)
                                                                <input type="text" name="out_patient_specify" />
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <strong>(6d) Communication</strong>
                                        <div class="has-success">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="radio" id="checkboxSuccess" value="yes" name="com_requested" <?php echo e($leave->com_requested == "yes" ? ' checked' : ''); ?>>
                                                    Requested
                                                </label>
                                                <label>
                                                    <input type="radio" id="checkboxSuccess" value="no" name="com_requested" <?php echo e($leave->com_requested == "no" ? ' checked' : ''); ?>>
                                                    Not Requested
                                                </label>
                                            </div>
                                        </div>
                                        <div class="has-success text-center">
                                            <br />
                                            <br />
                                            <p style="border-top: solid 2px black; width: 100%;">Signature</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <h3 class="text-center">Details of Action on Application</h3>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="alert alert-success">
                                        <div class="form-group has-success  input-daterange">
                                            <label class="control-label" for="inputSuccess1">(7a) Certification of leave credits <br /> as of :</label>
                                            <input type="text" class="form-control" name="credit_date" value="<?php echo e($leave->credit_date); ?>">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tr>
                                                            <th>Vacation</th>
                                                            <th>Sick</th>
                                                            <th>Total</th>
                                                        </tr>
                                                        <tr>
                                                            <td>&nbsp;</td>
                                                            <td>&nbsp;</td>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <input type="text" name="vication_total" value="<?php echo e($leave->vication_total); ?>"> days
                                                            </td>
                                                            <td>
                                                                <input type="text" name="sick_total" value="<?php echo e($leave->sick_total); ?>"> days
                                                            </td>
                                                            <td>
                                                                <input type="text" name="over_total" value="<?php echo e($leave->over_total); ?>"> days
                                                            </td>
                                                        </tr>
                                                    </table>
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
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <hr style="border: dashed; " />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <strong>(7c.) Approved For :</strong>
                                                <div class="form-group">
                                                    <div class="has-success">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="text" name="a_days_w_pay" size="5" value="<?php echo e($leave->a_days_w_pay); ?>"/>
                                                                day(s) with pay
                                                            </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="text" name="a_days_wo_pay" size="5" value="<?php echo e($leave->a_days_wo_pay); ?> "/>
                                                                day(s) without pay
                                                            </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="text" name="a_others" size="5" value="<?php echo e($leave->a_others); ?>" />
                                                                others (specify)
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="alert alert-success">
                                        <strong>(7b.)Recommendation</strong>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="has-success">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="radio" id="checkboxSuccess" value="approve" name="reco_approval" <?php echo e($leave->reco_approval == "approve" ? ' checked' : ''); ?>>
                                                                Approval
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="has-success">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="radio" id="checkboxSuccess" value="disapprove" name="reco_approval" <?php echo e($leave->reco_approval == "disapprove" ? ' checked' : ''); ?>>
                                                                Disapproval
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="has-success">
                                                        <div class="form-group has-success">
                                                            Due to :
                                                            <textarea type="text" class="form-control" maxlength="200" id="inputSuccess1" name="reco_disaprove_due_to"><?php echo e($leave->reco_disaprove_due_to); ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <br />
                                                <br />
                                                <p style="border-top: solid 2px black; width: 100%;">Authorized Official</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <strong>(7d.) DISAPPROVED DUE TO:</strong>
                                                <textarea type="text" class="form-control" maxlength="200" id="inputSuccess1" name="disaprove_due_to"><?php echo e($leave->disaprove_due_to); ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <h3 class="text-center">By Authority of the Secretary of Health</h3>
                                <div class="col-md-12">
                                    <br />
                                    <br /><br />
                                    <div class="row has-success">
                                        <div class="col-md-3">
                                            <p class="text-center" style="border-top: solid 2px black; width: 100%;">Date</p>
                                        </div>

                                        <div class="col-md-6">
                                            <p class="text-center" style="border-top: solid 2px black; width: 100%;">Authorized Official</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <br />
                            <div class="row">
                                <div class="col-md-12 center-block">
                                    <button type="submit" name="submit" class="btn btn-primary btn-lg col-md-5">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    @parent
    <script>
        $('.input-daterange input').each(function() {
            $(this).datepicker({
                format: 'yyyy/mm/dd'
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>