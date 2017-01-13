<ul class="nav navbar-nav">
    <li><a href="<?php echo e(url('admin/dashboard')); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
    <li><a href="<?php echo e(URL::to('admin/upload')); ?>"><i class="fa fa-plus"></i> Upload File</a></li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-file"></i> Manage DTR<span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li><a href="<?php echo e(asset('/employee-attendance')); ?>"><i class="fa fa-unlock"></i>&nbsp;&nbsp; Employee attendance</a></li>
            <li class="divider"></li>
            <li class="dropdown-submenu">
                <a href="#"><i class="fa fa-clock-o"></i>&nbsp;&nbsp; Manage Flixetime</a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo e(asset('new/flixetime')); ?>">Add New Flixetime</a></li>
                </ul>
            </li>
            <li class="divider"></li>
            <li><a href="<?php echo e(url('calendar')); ?>"><i class="fa fa-calendar"></i>&nbsp;&nbsp; Calendar</a></li>
            <li class="divider"></li>
            <li class="dropdown-submenu">
                <a href="#" data-toggle="dropdown"><i class="fa fa-cog"></i>&nbsp;&nbsp; Settings</a>
                <ul class="dropdown-menu">
                    <li><a href="#document_form" data-backdrop="static" data-toggle="modal" data-link="<?php echo e(asset('/form/worksheet')); ?>">Edit work schedule</a></li>
                    <li><a href="#document_form" data-backdrop="static" data-toggle="modal" data-link="<?php echo e(asset('/form/justification/letter')); ?>"></a></li>
                </ul>
            </li>
            <li class="divider"></li>
            <li><a href="<?php echo e(url('employees')); ?>"><i class="fa fa-user"></i> Employees</a></li>
        </ul>
    </li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-print"></i> Print<span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li><a href="<?php echo e(asset('dtr/print-monthly')); ?>"><i class="fa fa-check"></i>&nbsp;&nbsp; Employees monthly attendance</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo e(url('print/employee-attendance')); ?>"><i class="fa fa-check"></i>&nbsp;&nbsp; Employee attendance</a></li>
        </ul>
    </li>

    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> Account<span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li><a href="<?php echo e(asset('/change/password')); ?>"><i class="fa fa-unlock"></i>&nbsp;&nbsp; Change Password</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo e(url('/logout')); ?>"><i class="fa fa-sign-out"></i>&nbsp;&nbsp; Logout</a></li>
        </ul>
    </li>
</ul>