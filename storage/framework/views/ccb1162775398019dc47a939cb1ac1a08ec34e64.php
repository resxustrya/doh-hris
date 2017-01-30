<?php $__env->startSection('content'); ?>
    <div class="col-md-12 wrapper">
        <div class="alert alert-jim">
            <h3 class="page-header">Create application for Leave
            </h3>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-11">
                        <form action="<?php echo e(asset('form/leave')); ?>" method="POST">
                            <?php echo e(csrf_field()); ?>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group has-success">
                                        <label class="control-label" for="inputSuccess1">(1.) Office/Agency</label>
                                        <input type="text" class="form-control" id="inputSuccess1">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group has-success">
                                        <label class="control-label" for="inputSuccess1">(2.)  Last Name</label>
                                        <input type="text" class="form-control" id="inputSuccess1">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group has-success">
                                        <label class="control-label" for="inputSuccess1">First Name</label>
                                        <input type="text" class="form-control" id="inputSuccess1">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group has-success">
                                        <label class="control-label" for="inputSuccess1">Middle Name</label>
                                        <input type="text" class="form-control" id="inputSuccess1">
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group has-success  input-daterange">
                                        <label class="control-label" for="inputSuccess1">(3.) Date of Filling</label>
                                        <input type="text" class="form-control" name="from" value="2012-04-05">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group has-success">
                                        <label class="control-label" for="inputSuccess1">(4.)  Position</label>
                                        <input type="text" class="form-control" id="inputSuccess1">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group has-success">
                                        <label class="control-label" for="inputSuccess1">(5.)Salary (Monthly)</label>
                                        <input type="text" class="form-control" id="inputSuccess1">
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
                                                                <input type="radio" id="checkboxSuccess" value="option1">
                                                                Vacation
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="has-success">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="radio" id="checkboxSuccess" value="option1">
                                                                To seek employement
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="has-success">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="radio" id="checkboxSuccess" value="option1">
                                                                Others(Specify)
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="has-success">
                                                        <div class="form-group has-success">
                                                            <textarea type="text" class="form-control" maxlength="200" id="inputSuccess1"></textarea>
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
                                                                <input type="radio" id="checkboxSuccess" value="option1">
                                                                Sick
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="has-success">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="radio" id="checkboxSuccess" value="option1">
                                                                Maternity
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="has-success">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="radio" id="checkboxSuccess" value="option1">
                                                                Others(Specify)
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="has-success">
                                                        <div class="form-group has-success">
                                                            <textarea type="text" class="form-control" maxlength="200" id="inputSuccess1"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <strong>(6c.)Number of working days applied <br />For :</strong>
                                        <input type="text" name="num_days" />
                                        <div class="form-group">
                                            <label class="control-label" for="inputSuccess1">Inclusive Dates :</label>
                                            <div class="input-group input-daterange">
                                                <span class="input-group-addon">From</span>
                                                <input type="text" class="form-control" name="from" value="2012-04-05">
                                                <span class="input-group-addon">To</span>
                                                <input type="text" class="form-control" name="to" value="2012-04-19">
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
                                                                <input type="radio" id="checkboxSuccess" value="option1">
                                                                Within the Philippines
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="has-success">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="radio" id="checkboxSuccess" value="option1">
                                                                Abroad (specify)
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="has-success">
                                                        <div class="form-group has-success">
                                                            <textarea type="text" class="form-control" maxlength="200" id="inputSuccess1"></textarea>
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
                                                                <input type="radio" id="checkboxSuccess" value="option1">
                                                                In Hospital (sepecify)
                                                                <input type="text" name="a" />
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="has-success">
                                                        <div class="form-group has-success">
                                                            <textarea type="text" class="form-control" maxlength="200" id="inputSuccess1"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <strong>(6d) Communication</strong>
                                        <div class="has-success">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="radio" id="checkboxSuccess" value="option1">
                                                    Requested
                                                </label>
                                                <label>
                                                    <input type="radio" id="checkboxSuccess" value="option1">
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
                                        <strong>(7a) Certification of leave credits <br /> as of : <input type="text" name="as_of" /> </strong>
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
                                                                <input type="text" name="vation_total"> days
                                                            </td>
                                                            <td>
                                                                <input type="text" name="vation_total"> days
                                                            </td>
                                                            <td>
                                                                <input type="text" name="vation_total"> days
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
                                                                <input type="text" name="a" size="5"/>
                                                                day(s) with pay
                                                            </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="text" name="a" size="5"/>
                                                                day(s) without pay
                                                            </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="text" name="a" size="5"/>
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
                                                                <input type="radio" id="checkboxSuccess" value="option1">
                                                                Approval
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="has-success">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="radio" id="checkboxSuccess" value="option1">
                                                                Disapproval
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="has-success">
                                                        <div class="form-group has-success">
                                                            Due to :
                                                            <textarea type="text" class="form-control" maxlength="200" id="inputSuccess1"></textarea>
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
            $(this).datepicker("clearDates");
        });

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>