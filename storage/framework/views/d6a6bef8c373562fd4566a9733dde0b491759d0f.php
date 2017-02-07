
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">

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
                        <div class="row" style="padding: 10px;">
                            <span class="col-sm-3">(2.) Name</span>
                            <span class="col-sm-3">(Last)</span>
                            <span class="col-sm-3">(First)</span>
                            <span class="col-sm-3">(M.I.)</span>
                        </div>
                        <div class="row" style="padding: 10px;">
                            <span class="col-sm-3">&nbsp;</span>
                            <span class="col-sm-3"><b><?php echo e($leave->lastname); ?></b></span>
                            <span class="col-sm-3"><b><?php echo e($leave->firstname); ?></b></span>
                            <span class="col-sm-3"><b><?php echo e($leave->middlename); ?></b></span>
                        </div>
                    </td>
                </tr>
            </table>
            <table border="2" style="width: 100%;border-top: -1px;">
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
                <td>
                    <div class="row" style="padding: 10px;">
                        <div class="col-md-12">
                            <strong>(6b) WHERE LEAVE WILL BE SPENT</strong>
                            <div class="row">
                                <br />
                                <div class="col-md-12 col-md col-md-offset-1">
                                    <strong>VICATION</strong><br />
                                    <strong>TO SEEK EMPLOYEMENT</strong><br />
                                    <strong>OTHERS</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="padding: 10px;">
                        <div class="col-md-12">

                        </div>
                    </div>
                </td>
                <td>
                    <div class="row" style="padding: 10px;">
                        <div class="col-md-12">
                            <strong>(6b) WHERE LEAVE WILL BE SPENT</strong>
                        </div>
                    </div>
                </td>
                </tbody>
            </table>
        </div>
    </div>
</div>
<style>

</style>
