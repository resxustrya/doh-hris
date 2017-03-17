<ul class="nav navbar-nav">
    <?php /*<li>
        <a href="<?php echo e(URL::to('document')); ?>"><i class="fa fa-file-code-o"></i> Create Document</a>
    </li>*/ ?>
    <li><a href="<?php echo e(url('dashboard')); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-file"></i> Manage DTR<span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li><a href="<?php echo e(asset('/personal/dtr/list')); ?>"><i class="fa fa-unlock"></i>&nbsp;&nbsp; My DTR</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo e(url('calendar')); ?>"><i class="fa fa-calendar"></i>&nbsp;&nbsp; Calendar</a></li>
            <li class="divider"></li>
            <li class="dropdown-submenu">
                <a href="#" data-toggle="dropdown"><i class="fa fa-file" aria-hidden="true"></i>&nbsp;&nbsp; Leave/CDO/SO</a>
                <ul class="dropdown-menu">
                    <li class="dropdown-submenu">
                    <li><a href="<?php echo e(asset('form/leave/all')); ?>">Leave</a></li>
                    <li class="divider"></li>
                    <li><a href="<?php echo e(asset('form/so_list')); ?>">Office Order</a></li>
                    <li class="divider"></li>
                    <li><a href="#document_form" data-backdrop="static" data-toggle="modal" data-link="<?php echo e(asset('form/cdo')); ?>">CDO</a></li>
                </ul>
            </li>
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
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> Account<span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li><a href="<?php echo e(asset('resetpass')); ?>"><i class="fa fa-unlock"></i>&nbsp;&nbsp; Change Password</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo e(url('/logout')); ?>"><i class="fa fa-sign-out"></i>&nbsp;&nbsp; Logout</a></li>
        </ul>
    </li>
</ul>