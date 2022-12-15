<style>
   [class*=sidebar-dark-] .nav-treeview>.nav-item>.nav-link.active{
    background-color: rgb(80, 81, 83) !important;
    color: white ;
   }
   [class*=sidebar-dark-] .nav-treeview>.nav-item>.nav-link.active:hover{
    color: rgb(214, 203, 203) ;
   }
   .navPan{
    padding-left: 28px !important;
   }
</style>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-info elevation-4">
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
                        <i class="fa fa-tachometer" aria-hidden="true"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                {{-- faculties  --}}
                <li class="nav-item {{ Request::is('faculties*') ? 'menu-open active':'' }}">
                    <a href="#" class="nav-link {{ Request::is('faculties*') ? 'active':'' }}">
                        <i class="fa fa-university" aria-hidden="true"></i>
                        <p>
                            Faculties
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ">
                            <a href="{{route('faculties.index')}}" class="nav-link navPan {{ Request::is('faculties*')  ? 'active':''  }}">
                                <i class="fa fa-list-ul" aria-hidden="true"></i>
                                <p>Faculties lists</p>
                            </a>
                        </li>
                    </ul>        
                </li>
                {{-- department --}}         
                <li class="nav-item {{ Request::is('departments*') ? 'menu-open active':'' }}">
                    <a href="#" class="nav-link {{ Request::is('departments*') ? 'active':'' }}">
                        <i class="fa fa-map-o" aria-hidden="true"></i>
                        <p>
                            Departments
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('departments/lists')}}" class="nav-link navPan {{ Request::is('departments*')  ? 'active':''  }}">
                                <i class="fa fa-list-ul" aria-hidden="true"></i>
                                <p>Department lists</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- students  --}}
                <li class="nav-item {{ Request::is('students*') ? 'menu-open active':'' }}">
                    <a href="#" class="nav-link  {{ Request::is('students/lists') || Request::is('students/reports') || Request::is('students/create') ? 'active':'' }}">
                        <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                        <p>
                            Students
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ">
                            <a href="{{url('students')}}" class="nav-link navPan {{ Request::is('students') ? 'active':'' }}">
                                <i class="fa fa-list-ul" aria-hidden="true"></i>
                                <p> List Students</p>
                            </a>
                            <a href="{{url('students/reports')}}" class="nav-link navPan {{ Request::is('students/reports') ? 'active':'' }}">
                                <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                <p>Student Reports</p>
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
