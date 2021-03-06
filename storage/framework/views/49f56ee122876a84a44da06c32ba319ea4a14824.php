<style>
    .table-info tr td:first-child {
        font-weight:bold;
        color: #2b542c;
    }
</style>
<form action="<?php echo e(asset('so_addv1')); ?>" method="POST" class="form-submit">
    <?php echo e(csrf_field()); ?>

    <input type="hidden" name="inclusive_name" value="<?php echo e($inclusive_name[0]); ?>"/>
    <span id="inclusive_name_page" data-link="<?php echo e(asset('inclusive_name_page')); ?>"></span>
    <span id="so_append" data-link="<?php echo e(asset('so_append')); ?>"></span>
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
                </td>
                <td class="col-md-10"><img height="130" width="130" src="<?php echo e(asset('resources/img/ro7.png')); ?>" /> </td>
            </tr>
        </table>
        <table class="table table-hover table-form table-striped">
            <tr>
                <td class="col-sm-3"><label>Prepared by</label></td>
                <td class="col-sm-1">:</td>
                <td class="col-sm-8"><input type="text" name="prepared_by" class="form-control" value="<?php echo e(Auth::user()->fname); ?> <?php echo e(Auth::user()->lname); ?>" required readonly></td>
            </tr>
            <tr>
                <td class="col-sm-3"><label>Prepared date</label></td>
                <td class="col-sm-1">:</td>
                <td class="col-sm-8"><input class="form-control datepickercalendar" value="<?php echo e(date('m/d/Y')); ?>" name="prepared_date" required></td>
            </tr>
            <tr>
                <td class="col-sm-3"><label>Subject</label></td>
                <td class="col-sm-1">:</td>
                <td class="col-sm-8"><textarea class="form-control" name="subject" rows="3" style="resize:none;" required></textarea></td>
            </tr>
            <tr>
                <td class="col-sm-3"><label>Inclusive Name</label></td>
                <td class="col-sm-1">:</td>
                <td class="col-sm-8">
                    <select class="form-control select2" name="inclusive_name[]" multiple="multiple" data-placeholder="Select a name" required>
                        <?php foreach($users as $row): ?>
                            <option value="<?php echo e($row['id']); ?>"><?php echo e($row['fname'].' '.$row['mname'].' '.$row['lname']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tbody class="p_inclusive_date">
            <tr>
                <td class="col-sm-3"><label>Inclusive Date and Area:</label></td>
                <td class="col-sm-1">:</td>
                <td class="col-sm-8">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control" id="inclusive1" name="inclusive[]" placeholder="Input date range here..." style="width: 40%;" required>
                        <textarea name="area[]" id="area1" class="form-control" rows="1" placeholder="Input your area here..." style="resize: none;width: 40%;margin-left:2%" required></textarea>
                    </div>
                </td>
            </tr>
            </tbody>
            <tr>
                <td></td>
                <td></td>
                <td id="border-top">
                    <a onclick="add_inclusive();" href="#">
                        <p class="pull-right"><i class="fa fa-plus"></i> Add Inclusive date
                    </a>
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
    $(".select2").select2();
    $(function(){
        $("body").delegate("#inclusive1","focusin",function(){
            $(this).daterangepicker();
        });
    });
    var count = 1;
    function add_inclusive(){
        event.preventDefault();
        count++;
        var url = $("#so_append").data('link')+"?count="+count;
        $.get(url,function(result){
            $(".p_inclusive_date").append(result);
        });
        $(function() {
            $("body").delegate("#inclusive"+count, "focusin", function(){
                $(this).daterangepicker();
            });
        });
    }

    function remove(id){
        $("#"+id.val()).remove();
    }

    $.get($("#inclusive_name_page").data("link"),function(result){
        $('select').val(result).trigger('change');
    });

    $('.form-submit').on('submit',function(){
        $('.btn-submit').attr("disabled", true);
    });
</script>