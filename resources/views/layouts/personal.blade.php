<ul class="nav navbar-nav">
    {{--<li>
        <a href="{{ URL::to('document') }}"><i class="fa fa-file-code-o"></i> Create Document</a>
    </li>--}}
    <li><a href="{{ url('dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-file"></i> Manage DTR<span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li class="dropdown-submenu">
                <a href="#"><i class="fa fa-unlock"></i>&nbsp;&nbsp; My DTR</a>
                <ul class="dropdown-menu">
                    <li class="dropdown-submenu">
                    <li><a href="{{ asset('/personal/dtr/list')  }}">Admin generated DTR</a></li>
                    <li class="divider"></li>
                    <li><a href="{{ asset('/personal/dtr/filter/list') }}">My filtered DTR</a></li>
                </ul>
            </li>
            <li class="divider"></li>
            <li class="dropdown-submenu">
                <a href="#" data-toggle="dropdown"><i class="fa fa-file" aria-hidden="true"></i>&nbsp;&nbsp; Leave/CDO/SO</a>
                <ul class="dropdown-menu">
                    <li class="dropdown-submenu">
                    <li><a href="{{ asset('form/leave/all') }}">Leave</a></li>
                    <li class="divider"></li>
                    <li><a href="{{ asset('form/so_list') }}">Office Order</a></li>
                    <li class="divider"></li>
                    <li><a href="{{ asset("form/cdo_list") }}">CDO</a></li>
                </ul>
            </li>
            <li class="divider"></li>
            <li class="dropdown-submenu">
                <a href="#" data-toggle="dropdown"><i class="fa fa-cog"></i>&nbsp;&nbsp; Settings</a>
                <ul class="dropdown-menu">
                    <li><a href="#document_form" data-backdrop="static" data-toggle="modal" data-link="{{ asset('/form/worksheet') }}">Edit work schedule</a></li>
                    <li><a href="#document_form" data-backdrop="static" data-toggle="modal" data-link="{{ asset('/form/justification/letter') }}"></a></li>
                </ul>
            </li>
        </ul>
    </li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> Account<span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li><a href="{{ asset('resetpass')}}"><i class="fa fa-unlock"></i>&nbsp;&nbsp; Change Password</a></li>
            <li class="divider"></li>
            <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out"></i>&nbsp;&nbsp; Logout</a></li>
        </ul>
    </li>
</ul>