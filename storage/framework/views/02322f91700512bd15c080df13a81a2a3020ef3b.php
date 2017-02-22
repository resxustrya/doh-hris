<form action="<?php echo e(asset('create/flixe')); ?>" method="POST">
    <?php echo e(csrf_field()); ?>

    <div class="modal-body">
        <table class="table table-hover table-form table-striped">
            <tr>
                <td class="col-sm-3"><label>Prepared By</label></td>
                <td class="col-sm-1">:</td>
                <td class="col-sm-8"><input type="text" disabled value="<?php echo e(Auth::user()->fname); ?> <?php echo e(Auth::user()->mname); ?> <?php echo e(Auth::user()->lname); ?>" class="form-control"></td>
            </tr>
            <tr>
                <td class=""><label>Prepared Date</label></td>
                <td>:</td>
                <td><input type="text" disabled value="<?php echo e(date('m/d/Y h:i:s A')); ?>"  class="form-control"></td>
            </tr>
            <tr>
                <td class=""><label>Time</label></td>
                <td>:</td>
                <td>
                    <input id="input-a" value="" data-default="20:48" class="form-control">
                </td>
            </tr>
        </table>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-success" onclick="$('form').attr('taraget','');"><i class="fa fa-send"></i> Submit</button>
    </div>
</form>
