<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text logo-normal">Dashboard</a>
        </div>
        @php
            $role_name=Auth::user()->getRoleNames()[0];
            $role=Spatie\Permission\Models\Role::where('name',$role_name)->first();
            @endphp
        <ul class="nav">
            <li >
                <a href="{{ route('home') }}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
           
           
            @if($role->hasPermissionTo('View-Role'))
            <li>
                <a href="/roles">
                    <i class="tim-icons icon-atom"></i>
                    <p>Roles & Permissions</p>
                </a>
            </li>
            @endif
            @if($role->hasAnyPermission(['Create-busdata2', 'View-busdata']))

            <li>
                <a data-toggle="collapse" href="#laravel-examples" aria-expanded="true">
                    <i class="fab fa-laravel" ></i>
                    <span class="nav-link-text" >Bus Management</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse" id="laravel-examples">
                    <ul class="nav pl-4">
                    @if($role->hasPermissionTo('Create-busdata2'))

                        <li>
                            <a href="/bus-info/create">
                                <i class="tim-icons icon-single-02"></i>
                                <p>Add Bus Info</p>
                            </a>
                        </li>
                    @endif
                    @if($role->hasPermissionTo('View-busdata'))

                        <li >
                            <a href="/bus-info">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>Bus Informations</p>
                            </a>
                        </li>
                    @endif
                    </ul>
                </div>
            </li>
            @endif
            @if($role->hasAnyPermission(['Create-route', 'View-routedata']))

<li>
    <a data-toggle="collapse" href="#laravel-examples1" aria-expanded="true">
        <i class="fab fa-laravel" ></i>
        <span class="nav-link-text" >Route Management</span>
        <b class="caret mt-1"></b>
    </a>

    <div class="collapse" id="laravel-examples1">
        <ul class="nav pl-4">
        @if($role->hasPermissionTo('Create-route'))

            <li>
                <a href="/route-info/create">
                    <i class="tim-icons icon-single-02"></i>
                    <p>Add Route Info</p>
                </a>
            </li>
        @endif
        @if($role->hasPermissionTo('View-routedata'))

            <li >
                <a href="/route-info">
                    <i class="tim-icons icon-bullet-list-67"></i>
                    <p>Route Informations</p>
                </a>
            </li>
        @endif
</ul>
</div>
</li>
@endif
        @if($role->hasAnyPermission(['Create-schedule', 'View-scheduledata']))

<li>
    <a data-toggle="collapse" href="#laravel-examples2" aria-expanded="true">
        <i class="fab fa-laravel" ></i>
        <span class="nav-link-text" >Schedule Management</span>
        <b class="caret mt-1"></b>
    </a>

    <div class="collapse" id="laravel-examples2">
        <ul class="nav pl-4">
        @if($role->hasPermissionTo('Create-schedule'))

            <li>
                <a href="/schedules/create">
                    <i class="tim-icons icon-single-02"></i>
                    <p>Add Schedule</p>
                </a>
            </li>
        @endif
        @if($role->hasPermissionTo('View-scheduledata'))

            <li >
                <a href="/schedules">
                    <i class="tim-icons icon-bullet-list-67"></i>
                    <p>Schedule Informations</p>
                </a>
            </li>
        @endif
        </ul>
</div>
</li>
@endif
        @if($role->hasAnyPermission(['View-reports', 'Download-reports']))

        <li>
                <a href="/reports">
                    <i class="tim-icons icon-atom"></i>
                    <p>Reports</p>
                </a>
            </li>
@endif
     
   
        </ul>
    </div>
</div>
