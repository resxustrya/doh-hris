<style>
    .table-info tr td:first-child {
        font-weight:bold;
        color: #2b542c;
    }
</style>
<form action="<?php echo e(asset('form/cdo_addv1')); ?>" method="POST" class="form-submit">
    <?php echo e(csrf_field()); ?>

    <div class="modal-body">
        <table>
            <tr>
                <td class="col-md-1"><img height="130" width="130" src="<?php echo e(asset('resources/img/ro7.png')); ?>" /></td>
                <td class="col-lg-10" style="text-align: center;">
                    Repulic of the Philippines <br />
                    <strong>DEPARTMENT OF HEALTH REGIONAL OFFICE NO. VII</strong><br />
                    Osmeña Boulevard, Cebu City, 6000 Philippines <br />
                    Regional Director's Office Tel. No. (032) 253-635-6355 Fax No. (032) 254-0109 <br />
                    Official Website:<a target="_blank" href="http://www.ro7.doh.gov.ph"><u>http://www.ro7.doh.gov.ph</u></a> Email Address: dohro7<?php echo e('@'); ?>gmail.com
                    <strong>APPLICATION FOR COMPENSATORY TIME OFF</strong>
                </td>
                <td class="col-md-10"><img height="130" width="130" src="<?php echo e(asset('resources/img/ro7.png')); ?>" /> </td>
            </tr>
        </table>
        <table class="table table-hover table-form table-striped">
            <tr>
                <td class="col-sm-3"><label>Name</label></td>
                <td class="col-sm-1"><strong>:</strong></td>
                <td class="col-sm-8"><input type="text" class="form-control" value="<?php echo e(Auth::user()->fname); ?> <?php echo e(Auth::user()->lname); ?>" required readonly></td>
            </tr>
            <tr>
                <td class="col-sm-3"><label>Date</label></td>
                <td class="col-sm-1"><strong>:</strong></td>
                <td class="col-sm-8"><input class="form-control datepickercalendar" value="<?php echo e(date('m/d/Y')); ?>" name="date" required></td>
            </tr>
            <tr>
                <td class="col-sm-3"><label>Subject</label></td>
                <td class="col-sm-1"><strong>:</strong></td>
                <td class="col-sm-8"><textarea class="form-control" name="subject" rows="3" style="resize:none;" required></textarea></td>
            </tr>
            <tr>
                <td class="col-sm-3"><label>Inclusive Dates:</label></td>
                <td class="col-sm-1"><strong>:</strong></td>
                <td class="col-sm-8">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control" id="inclusive1" name="inclusive_dates" placeholder="Input date range here..." required>
                    </div>
                </td>
            </tr>
        </table>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
            <button type="submit" class="btn btn-success btn-submit" style="color:white;"><i class="fa fa-send"></i> Submit</button>
        </div>
    </div>
</form>
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