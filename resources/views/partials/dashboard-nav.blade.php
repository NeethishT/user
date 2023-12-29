<aside class="navbar navbar-vertical navbar-expand-lg bg-website">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
        <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark">
            <a href="{{{ route('cms.users.dashboard') }}}">
                <img src="{{ asset('img/logo.svg') }}"  />
            </a>
        </h1>

        @php $rolePermission = empty(getPermissions() === false) ? getPermissions() : []; @endphp
        <div class="navbar-nav flex-row d-lg-none">
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                    <span class="avatar avatar-sm">
                        <i class="ti ti-user-circle icon"></i>
                    </span>
                    <div class="d-none d-xl-block ps-2">
                        <div>{{ Auth::user()->name }}</div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <div class="p-2">
                        @if(empty(Auth::user()->roles) === false)
                            <b>Roles</b>
                            <ul class="list-unstyled">
                                @foreach(Auth::user()->roles as $role)
                                    <li><span class="badge badge-secondary">{{{ $role->name }}}</span></li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    <div class="p-2 pop-up-flush">
                        <span>Redis Flush</span>
                    </div>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('cms.users.logout') }}" class="dropdown-item @if(!in_array('cms.users.logout',$rolePermission)) hidden @endif">Logout</a>
                </div>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbar-menu">
            <ul class="navbar-nav pt-lg-3">
                <li class="nav-item @if(in_array(Route::currentRouteName(), ['cms.users.dashboard'])) active @endif">
                    @if(in_array('cms.users.dashboard',$rolePermission))
                    <a class="nav-link" href="{{ route('cms.users.dashboard') }}" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="ti ti-dashboard icon"></i>
                        </span>
                        <span class="nav-link-title">
                            Dashboard
                        </span>
                    </a>
                    @endif
                </li>

                <li class="nav-item dropdown @if(in_array(Route::currentRouteName(), ['cms.sone.content.list'])) active @endif">
                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="false" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="ti ti-settings icon"></i>
                        </span>
                        <span class="nav-link-title">
                            Shriram-One
                        </span>
                    </a>
                    <div class="dropdown-menu @if(in_array(Route::currentRouteName(), ['cms.sone.content.list'])) show @endif">
                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                @if(in_array('cms.sone.content.list',$rolePermission))
                                <a class="dropdown-item @if(in_array(Route::currentRouteName(), ['cms.sone.content.list'])) active @endif" href="{{ route('cms.sone.content.list') }}" >
                                    <i class="ti ti-file icon"></i> Shriram-One Content
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </li>

                <li class="nav-item dropdown @if(in_array(Route::currentRouteName(), ['cms.users.list', 'cms.users.add', 'cms.users.save', 'cms.users.edit', 'cms.users.update', 'cms.users.delete', 'cms.users.search', 'cms.users.status','cms.users.logins','cms.roles.list', 'cms.roles.add', 'cms.roles.save', 'cms.roles.edit', 'cms.roles.update', 'cms.roles.delete', 'cms.roles.status', 'cms.roles.search', 'cms.permissions.search', 'cms.permissions.status','cms.permissions.list','cms.permissions.migration', 'cms.permissions.migrate','cms.mobile.edit','cms.mobile.mobUpdate','cms.pan.panUpdation','cms.pan.edit','cms.pan.panUpdation','cms.mobile-expiry.edit','cms.mobile-expiry.mobileExpiryUpdation','cms.users.maintanance','cms.users.maintanance_edit', 'cms.configuration.list', 'cms.configuration.add', 'cms.configuration.save', 'cms.configuration.edit', 'cms.configuration.view','cms.configuration.update',  'cms.configuration.status', 'cms.configuration.search','cms.input.list', 'cms.input.add', 'cms.input.save', 'cms.input.edit', 'cms.input.view','cms.input.update',  'cms.input.status', 'cms.input.search', 'cms.input.thumbnail', 'cms.input.inner', 'cms.input.slider', 'cms.input.pdf', 'cms.input.hindipdf', 'cms.input.category','cms.productmaintenance.list', 'cms.productmaintenance.add', 'cms.productmaintenance.save', 'cms.productmaintenance.edit', 'cms.productmaintenance.view','cms.productmaintenance.update',  'cms.productmaintenance.status', 'cms.productmaintenance.search', 'cms.productmaintenance.bulkStatusUpdate', 'cms.productmaintenance.bulkStatusSave','cms.email-configuration.list', 'cms.email-configuration.add', 'cms.email-configuration.save', 'cms.email-configuration.edit', 'cms.email-configuration.view','cms.email-configuration.update',  'cms.email-configuration.status', 'cms.email-configuration.search'])) active @endif">
                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="false" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="ti ti-settings icon"></i>
                        </span>
                        <span class="nav-link-title">
                            Settings
                        </span>
                    </a>
                    <div class="dropdown-menu @if(in_array(Route::currentRouteName(), ['cms.users.list', 'cms.users.add', 'cms.users.save', 'cms.users.edit', 'cms.users.update', 'cms.users.delete', 'cms.users.search', 'cms.users.status', 'cms.users.logins', 'cms.roles.list', 'cms.roles.add', 'cms.roles.save', 'cms.roles.edit', 'cms.roles.update', 'cms.roles.delete','cms.roles.status', 'cms.roles.search', 'cms.permissions.search', 'cms.permissions.status', 'cms.permissions.list','cms.permissions.migration', 'cms.permissions.migrate','cms.mobile.edit','cms.mobile.mobUpdate','cms.pan.panUpdation','cms.pan.edit','cms.pan.panUpdation','cms.mobile-expiry.edit','cms.mobile-expiry.mobileExpiryUpdation','cms.users.maintanance','cms.users.maintanance_edit', 'cms.configuration.list', 'cms.configuration.add', 'cms.configuration.save', 'cms.configuration.edit', 'cms.configuration.view','cms.configuration.update',  'cms.configuration.status', 'cms.configuration.search','cms.input.list', 'cms.input.add', 'cms.input.save', 'cms.input.edit', 'cms.input.view','cms.input.update',  'cms.input.status', 'cms.input.search', 'cms.input.thumbnail', 'cms.input.inner', 'cms.input.slider', 'cms.input.pdf', 'cms.input.hindipdf', 'cms.input.category','cms.productmaintenance.list', 'cms.productmaintenance.add', 'cms.productmaintenance.save', 'cms.productmaintenance.edit', 'cms.productmaintenance.view','cms.productmaintenance.update',  'cms.productmaintenance.status', 'cms.productmaintenance.search', 'cms.productmaintenance.bulkStatusUpdate', 'cms.productmaintenance.bulkStatusSave','cms.email-configuration.list', 'cms.email-configuration.add', 'cms.email-configuration.save', 'cms.email-configuration.edit', 'cms.email-configuration.view','cms.email-configuration.update',  'cms.email-configuration.status', 'cms.email-configuration.search'])) show @endif">
                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                @if(in_array('cms.users.list',$rolePermission))
                                <a class="dropdown-item @if(in_array(Route::currentRouteName(), ['cms.users.list', 'cms.users.add', 'cms.users.save', 'cms.users.edit', 'cms.users.update', 'cms.users.delete', 'cms.users.search', 'cms.users.status', 'cms.users.logins'])) active @endif" href="{{ route('cms.users.list') }}" >
                                    <i class="ti ti-file icon"></i> CMS Users
                                </a>
                                @endif
                                @if(in_array('cms.roles.list',$rolePermission))
                                <a class="dropdown-item @if(in_array(Route::currentRouteName(), [ 'cms.roles.list', 'cms.roles.add', 'cms.roles.save', 'cms.roles.edit', 'cms.roles.update', 'cms.roles.delete', 'cms.roles.search', 'cms.roles.status'])) active @endif" href="{{ route('cms.roles.list') }}" >
                                    <i class="ti ti-file icon"></i> CMS Roles
                                </a>
                                @endif
                                @if(in_array('cms.permissions.list',$rolePermission))
                                <a class="dropdown-item @if(in_array(Route::currentRouteName(), ['cms.permissions.list', 'cms.permissions.search', 'cms.permissions.status'])) active @endif" href="{{ route('cms.permissions.list') }}" >
                                    <i class="ti ti-file icon"></i> CMS Permissions
                                </a>
                                @endif
                                
                            </div>
                        </div>
                    </div>
                </li>

                <li class="nav-item">
                    @if(in_array('cms.users.logout',$rolePermission))
                    <a class="nav-link" href="{{ route('cms.users.logout') }}" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="ti ti-logout icon"></i>
                        </span>
                        <span class="nav-link-title">
                            Logout
                        </span>
                    </a>
                    @endif
                </li>
            </ul>
        </div>
    </div>
</aside>
<header class="navbar navbar-expand-md navbar-light d-none d-lg-flex d-print-none">
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"> <span class="navbar-toggler-icon"></span> </button>
        <div class="navbar-nav flex-row order-md-last">
            <div class="nav-item mx-2 badge badge-light">
                <b>Last Login:</b>{{ Auth::user()->last_login }}
            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu" aria-expanded="false">
                    <span class="avatar avatar-sm">
                        <i class="ti ti-user-circle icon"></i>
                    </span>
                    <div class="d-none d-xl-block ps-2">
                        <div>{{ Auth::user()->name }}</div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                   <div class="p-2">
                        @if(empty(Auth::user()->roles) === false)
                            <b>Roles</b>
                            <ul class="list-unstyled">
                                @foreach(Auth::user()->roles as $role)
                                    <li><span class="badge badge-secondary">{{{ $role->name }}}</span></li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('cms.users.logout') }}" class="dropdown-item">Logout</a>
                </div>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbar-menu">
            <div>
                @section('page_action') @show
            </div>
        </div>
    </div>
</header>
