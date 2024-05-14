<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="{{ url('/dashboard') }}"><img src="{{ asset('assets/img/avatar/lg-wri.png') }}" alt=""></a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">WR</a>
    </div>
    <ul class="sidebar-menu">

        <li class="menu-header">Starter</li>
        <li>
            <a class="nav-link" href="/home"><i class="far fa-square"></i> <span>Blank
                    Page</span></a>
        </li>
        <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i>
                <span>User Management</span></a>
            <ul class="dropdown-menu">
                <li><a class="nav-link " href="{{ route('user.index') }}">Users List</a></li>
            </ul>
        </li>
        <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-th"></i>
                <span>Role and Permission</span></a>
            <ul class="dropdown-menu">
                <li><a class="nav-link " href="{{ route('role.index') }}">Role</a></li>
                <li><a class="nav-link " href="{{ route('permission.index') }}">Permission</a></li>
                <li><a class="nav-link " href="{{ route('assign.index') }}">Permission To Role</a></li>
                <li><a class="nav-link " href="{{ route('assign.user.index') }}">User To Role</a></li>
            </ul>
        </li>
        <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-list"></i>
                <span>Menu Management</span></a>
            <ul class="dropdown-menu">
                <li><a class="nav-link " href="{{ route('menu-group.index') }}">Menu Group</a></li>
                <li><a class="nav-link " href="{{ route('menu-item.index') }}">Menu Item</a></li>
            </ul>
        </li>
        <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-list"></i>
                <span>Menu Wisata</span></a>
            <ul class="dropdown-menu">
                <li><a class="nav-link " href="{{ route('menu-wisata.index') }}">Menu Wisata</a></li>
                <li><a class="nav-link " href="{{ route('reservasi-wisata.index') }}">Reservasi Tiket</a></li>
            </ul>
        </li>
        <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-ticket-alt"></i>
                <span>Menu Tiket</span></a>
            <ul class="dropdown-menu">
                <li><a class="nav-link " href="{{ route('konfirmasi-tiket.index') }}">Konfirmasi Tiket</a></li>
            </ul>
        </li>
    </ul>

</aside>
