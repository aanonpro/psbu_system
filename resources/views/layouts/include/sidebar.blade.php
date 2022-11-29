<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#!" class="brand-link">
        <img src="{{ asset('admin/dist/img/psbu.jpg')}}" alt="psbu image" class="brand-image img-circle elevation-4" style="opacity: .8">
        <span class="brand-text font-weight-light">PSBU SYSTEM</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item ">
                    <a href="{{url('dashboard')}}" class="nav-link {{ Request::is('dashboard') ? 'active':'' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('students*') ? 'menu-open active':'' }}">
                    <a href="#" class="nav-link {{ Request::is('students/lists') || Request::is('students/reports') || Request::is('students/create') ? 'active':'' }}">
                        <i class="nav-icon fa fa-graduation-cap"></i>
                        <p>
                            Students
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('students/lists')}}" class="nav-link {{ Request::is('students/lists') ? 'active':'' }}">
                                <i class="fa fa-list nav-icon"></i>
                                <p> Lists</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('students/reports')}}" class="nav-link {{ Request::is('students/reports') ? 'active':'' }}">
                                <i class="fa fa-address-book nav-icon"></i>
                                <p> Reports</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('students/create')}}" class="nav-link {{ Request::is('students/create') ? 'active':'' }}">
                                <i class="fa fa-plus-square nav-icon"></i>
                                <p>Create </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ Request::is('departments*') ? 'menu-open active':'' }}">
                    <a href="#" class="nav-link {{ Request::is('departments/lists') || Request::is('departments/reports') || Request::is('students/create') ? 'active':'' }}">
                        <i class="nav-icon fa fa-graduation-cap"></i>
                        <p>
                            Departments
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('departments/lists')}}" class="nav-link {{ Request::is('departments/lists') ? 'active':'' }}">
                                <i class="fa fa-list nav-icon"></i>
                                <p> Lists</p>
                            </a>
                        </li>
                    </ul>

                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
