<div class="navbar-bg">
</div>
<nav class="navbar navbar-expand-lg main-navbar">
    <div class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
									collapse-btn"> <i
                        data-feather="align-justify"></i></a></li>
            <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                    <i data-feather="maximize"></i>
                </a></li>
        </ul>
    </div>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown"><a href="#" data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                @if (Auth::user()->profile_image)
                    <img alt="image" src="{{ asset('/image/user/' . Auth::user()->profile_image) }}"
                    class="user-img-radious-style"> @else<img alt="image" src="{{ asset('img/user.png') }}"
                        class="user-img-radious-style">
                @endif
                <span class="d-sm-none d-lg-inline-block"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
                <div class="dropdown-title">{{ Auth::user()->name }}</div>
                <a href="{{ route('user.profile', Auth::user()->id) }}" class="dropdown-item has-icon text-danger"> <i
                        class="fas fa-user"></i>
                    Profile
                </a>
                <a href="{{ route('changePasswordGet', Auth::user()->id) }}" class="dropdown-item has-icon text-danger">
                    <i class="fas fa-key"></i>
                    Change Password
                </a>
                <form method="POST" action="{{ route('logout') }}" class="hidden">
                    @csrf
                    <a onclick="this.parentNode.submit();" class="dropdown-item has-icon text-danger"> <i
                            class="fas fa-sign-out-alt"></i>
                        Logout
                    </a>
                </form>
            </div>
        </li>
    </ul>
</nav>

{{-- sidebar --}}

<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ url('/') }}"> <img alt="image" src="{{ asset('image/open-logo.png') }}"
                    class="header-logo" /> <span style="font-size: 14px;" class="logo-name">TASK TRACKER</span>
            </a>
        </div>
        <div class="sidebar-user">
            <div class="sidebar-user-picture">
                @if (Auth::user()->profile_image)
                    <img alt="image" src="{{ asset('/image/user/' . Auth::user()->profile_image) }}">
                @else
                    <img alt="image" src="{{ asset('img/userbig.png') }}">
                @endif
            </div>
            <div class="sidebar-user-details">
                <div class="user-name">{{ Auth::user()->name }}</div>

            </div>
        </div>
        <ul class="sidebar-menu">
            <li><a class="nav-link" href="{{ url('/') }}">
                <i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
        
            @can('view users')
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i data-feather="user"></i><span>Manage Users</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('users.index') }}">List Users</a></li>
                    <li><a class="nav-link" href="{{ route('users.create') }}">Add User</a></li>
                </ul>
            </li>
            @endcan
        
            @can('view roles')
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i data-feather="shield"></i><span>Manage Roles</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('roles.index') }}">List Roles</a></li>
                    <li><a class="nav-link" href="{{ route('roles.create') }}">Add Role</a></li>
                </ul>
            </li>
            @endcan
        
            @can('view projects')
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i data-feather="folder"></i><span>Manage Projects</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('projects.index') }}">List Projects</a></li>
                    <li><a class="nav-link" href="{{ route('projects.create') }}">Add Project</a></li>
                </ul>
            </li>
            @endcan
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i data-feather="check-square"></i><span>Manage Tasks</span></a>
                <ul class="dropdown-menu">
                    @can('view tasks')
                    <li><a class="nav-link" href="{{ route('tasks.index') }}">List Tasks</a></li>
                    @endcan
                    @can('create tasks')
                    <li><a class="nav-link" href="{{ route('tasks.create') }}">Add Task</a></li>
                    @endcan
                </ul>
            </li>        
        </ul>        
    </aside>
</div>
