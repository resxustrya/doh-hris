<ul class="nav navbar-nav">
    <li><a href="<?php echo e(url('dashboard')); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-file"></i> Manage DTR<span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li><a href="<?php echo e(asset('/employee-attendance')); ?>"><i class="fa fa-unlock"></i>&nbsp;&nbsp; My Attendance</a></li>
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
        </ul>
    </li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-print"></i> Print<span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li><a href="<?php echo e(asset('personal/monthly')); ?>"><i class="fa fa-print"></i>&nbsp;&nbsp; Monthly Attendance</a></li>
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