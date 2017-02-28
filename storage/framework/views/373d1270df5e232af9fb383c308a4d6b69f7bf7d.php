<tr>
    <td class="col-sm-3"><label>Inclusive Dates :</label></td>
    <td class="col-sm-1">:</td>
    <td class="col-sm-8">
        <div class="input-group">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input type="text" class="form-control" id="<?php echo e('inclusive'.$_GET['count']); ?>" name="inclusive[]" placeholder="Input date range here..." required>
        </div>
    </td>
</tr>
<script>
    var count = '<?php echo $_GET['count']; ?>';
    $('#inclusive'+count).daterangepicker();
</script>