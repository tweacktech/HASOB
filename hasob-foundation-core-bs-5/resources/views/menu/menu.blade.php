@if (Auth()->user()->hasRole('admin'))
<li class="navigation-header">
    <span>Administration</span> 
    <i class="zmdi zmdi-more"></i>
</li>

@if (FoundationCore::has_feature('sites', $organization))
<li class="">
    <a href="{{ route('fc.sites.index') }}" class="{{ Request::is('fc/sites') ? 'active' : '' }}">
        <div class="float-start"><i class="zmdi zmdi-globe-alt "></i><span class="right-nav-text">Sites</span></div><div class="float-end"></div><div class="clearfix"></div>
    </a>
</li>
@endif

@if (FoundationCore::has_feature('departments', $organization))
<li class="">
    <a href="{{ route('fc.departments.index') }}" class="{{ Request::is('fc/departments') ? 'active' : '' }}">
        <div class="float-start"><i class="zmdi zmdi-group mr-10"></i><span class="right-nav-text">Departments</span></div><div class="float-end"></div><div class="clearfix"></div>
    </a>
</li>
@endif

@if (FoundationCore::has_feature('ledgers', $organization))
<li class="">
    <a href="{{ route('fc.ledgers.index') }}" class="{{ Request::is('fc/ledgers') ? 'active' : '' }}">
        <div class="float-start"><i class="zmdi zmdi-bookmark-outline mr-10"></i><span class="right-nav-text">Ledgers</span></div><div class="float-end"></div><div class="clearfix"></div>
    </a>
</li>
@endif

<li>
    <a href="javascript:void(0);" data-toggle="collapse" data-target="#access_dr" class="collapsed" aria-expanded="false">
        <div class="float-start"><i class="zmdi zmdi-accounts-list mr-10"></i>
            <span class="right-nav-text">Access Control</span>
        </div>
        <div class="float-end"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div>
    </a>
    <ul id="access_dr" class="collapse-level-1 collapse" aria-expanded="false" style="">
        
        <li class="">
            <a href="{{ route('fc.users.index') }}" class="{{ Request::is('fc/users') ? 'active' : '' }}">
                <div class="float-start"><i class="zmdi zmdi-accounts-outline mr-10"></i><span class="right-nav-text">Users</span></div><div class="float-end"></div><div class="clearfix"></div>
            </a>
        </li>
        <li class="">
            <a href="{{ route('fc.user.show',0) }}" class="{{ Request::is('fc/user/0') ? 'active' : '' }}">
                <div class="float-start"><i class="zmdi zmdi-account-add mr-10"></i><span class="right-nav-text">Add User</span></div><div class="float-end"></div><div class="clearfix"></div>
            </a>
        </li>
        <li class="">
            <a href="{{ route('fc.roles.index') }}" class="{{ Request::is('fc/roles*') ? 'active' : '' }}">
                <div class="float-start"><i class="zmdi zmdi-gamepad mr-10"></i><span class="right-nav-text">Roles</span></div><div class="float-end"></div><div class="clearfix"></div>
            </a>
        </li>

    </ul>
</li>




<li>
    <a href="javascript:void(0);" data-toggle="collapse" data-target="#settings_dr" class="collapsed" aria-expanded="false">
        <div class="float-start"><i class="zmdi zmdi-wrench mr-10"></i>
            <span class="right-nav-text">System</span>
        </div>
        <div class="float-end"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div>
    </a>
    <ul id="settings_dr" class="collapse-level-1 collapse" aria-expanded="false" style="">

        <li class="">
            <a href="{{ route('fc.org-settings') }}" class="{{ Request::is('fc/org-settings') ? 'active' : '' }}">
                <div class="float-start"><i class="zmdi zmdi-settings mr-10"></i><span class="right-nav-text">Settings</span></div><div class="float-end"></div><div class="clearfix"></div>
            </a>
        </li>

        <li class="">
            <a href="{{ route('fc.org-domains') }}" class="{{ Request::is('fc/org-domains') ? 'active' : '' }}">
                <div class="float-start"><i class="zmdi zmdi-seat mr-10"></i><span class="right-nav-text">Domains</span></div><div class="float-end"></div><div class="clearfix"></div>
            </a>
        </li>

        <li class="">
            <a href="{{ route('fc.org-features') }}" class="{{ Request::is('fc/org-features') ? 'active' : '' }}">
                <div class="float-start"><i class="zmdi zmdi-apps mr-10"></i><span class="right-nav-text">Features</span></div><div class="float-end"></div><div class="clearfix"></div>
            </a>
        </li>

    </ul>
</li>


@endif