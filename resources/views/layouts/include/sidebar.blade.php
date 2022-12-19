<style>
   [class*=sidebar-dark-] .nav-treeview>.nav-item>.nav-link.active{
    background-color: rgb(112, 112, 112) !important;
    color: #fff;
   }
   [class*=sidebar-dark-] .nav-treeview>.nav-item>.nav-link.active:hover{
    /* color: rgb(214, 203, 203) ; */
    color: #d4d8da;
   }
   /* .navPan{
    padding-left: 28px !important;
   } */
</style>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-info elevation-4" >
    <!-- Brand Logo -->
    <a href="#!" class="brand-link">
        <img src="{{ asset('admin/dist/img/psbu.jpg')}}" alt="psbu image" class="brand-image img-circle elevation-4" style="opacity: .8">
        <span class="brand-text font-weight-light">PSBU SYSTEM</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img src="{{asset('admin/img/anon.jpg')}}" class="img-circle elevation-2 " alt="User Image">
            </div>
            <div class="info">
              <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
          </div>

          <!-- SidebarSearch Form -->
          <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
              <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-sidebar">
                  <i class="fas fa-search fa-fw"></i>
                </button>
              </div>
            </div>
          </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item ">
                    <a href="{{url('dashboard')}}" class="nav-link {{ Request::is('dashboard') ? 'active':'' }}">
                        <i class="fa fa-tachometer text-warning" aria-hidden="true"></i>
                        <p style="padding-left: 20px">{{__('Dashboard')}}</p>
                    </a>
                </li>
                {{-- faculties  --}}
                <li class="nav-item {{ Request::is('faculties*') ? 'menu-open active':'' }}">
                    <a href="#" class="nav-link {{ Request::is('faculties*') ? 'active':'' }}">
                        <i class="fa fa-university text-warning" aria-hidden="true"></i>
                        <p style="padding-left: 20px">
                            {{__('Faculties')}}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item " style="padding-left: 20px">
                            <a href="{{route('faculties.index')}}" class="nav-link {{ Request::is('faculties*')  ? 'active':''  }}">
                                <i class="fa fa-list-ul text-warning" aria-hidden="true"></i>
                                <p>{{__('Faculties lists')}}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- department --}}
                <li class="nav-item {{ Request::is('departments*') ? 'menu-open active':'' }}">
                    <a href="#" class="nav-link {{ Request::is('departments*') ? 'active':'' }}">
                        <i class="fa fa-columns text-warning" aria-hidden="true"></i>
                        <p style="padding-left: 20px">
                            {{__('Departments')}}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item" style="padding-left: 20px">
                            <a href="{{route('departments.index')}}" class="nav-link  {{ Request::is('departments*')  ? 'active':''  }}">
                                <i class="fa fa-list-ul text-warning" aria-hidden="true"></i>
                                <p>{{__('Department lists')}}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                  {{-- department --}}
                  <li class="nav-item {{ Request::is('shifts*') ? 'menu-open active':'' }}">
                    <a href="#" class="nav-link {{ Request::is('shifts*') ? 'active':'' }}">
                        <i class="fa fa-columns text-warning" aria-hidden="true"></i>
                        <p style="padding-left: 20px">
                            {{__('Shifts')}}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item" style="padding-left: 20px">
                            <a href="{{route('shifts.index')}}" class="nav-link  {{ Request::is('shifts*')  ? 'active':''  }}">
                                <i class="fa fa-list-ul text-warning" aria-hidden="true"></i>
                                <p class="pl-3">{{__('Shifts lists')}}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- students  --}}
                <li class="nav-item {{ Request::is('students*') ? 'menu-open active':'' }}">
                    <a href="#" class="nav-link  {{ Request::is('students/lists') || Request::is('students/reports') || Request::is('students/create') ? 'active':'' }}">
                        <i class="fa fa-graduation-cap text-warning" aria-hidden="true"></i>
                        <p style="padding-left: 20px">
                            {{__('Students')}}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item " style="padding-left: 20px">
                            <a href="{{url('students')}}" class="nav-link  {{ Request::is('students') ? 'active':'' }}">
                                <i class="fa fa-list-ul text-warning" aria-hidden="true"></i>
                                <p>{{__('List Students')}}</p>
                            </a>
                            <a href="{{url('students/reports')}}" class="nav-link  {{ Request::is('students/reports') ? 'active':'' }}">
                                <i class="fa fa-file-pdf-o text-warning" aria-hidden="true"></i>
                                <p>{{__('Student Reports')}}</p>
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
