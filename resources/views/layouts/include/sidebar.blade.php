<style>
   [class*=sidebar-dark-] .nav-treeview>.nav-item>.nav-link.active{
    background-color: rgb(110, 110, 110) !important;
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
                        <i class="fa fa-tachometer" aria-hidden="true"></i>
                        <p style="padding-left: 20px">{{__('Dashboard')}}</p>
                    </a>
                </li>
                {{-- faculties  --}}
                <li class="nav-item {{ Request::is('faculties*')|| Request::is('majors*') || Request::is('departments*') || Request::is('shifts*') ? 'menu-open active':'' }}">
                    <a href="#" class="nav-link {{ Request::is('faculties*') || Request::is('majors*') || Request::is('departments*') || Request::is('shifts*') ? 'active':'' }}">
                        <i class="fa fa-university" aria-hidden="true"></i>
                        <p style="padding-left: 20px">
                            {{__('Academic')}}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ">
                            <a href="{{route('faculties.index')}}" class="nav-link  {{ Request::is('faculties*')  ? 'active':''  }}">
                                <i class="fa fa-bars pl-3" aria-hidden="true"></i>
                                <p class="pl-3">{{__('Faculties')}}</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview ">
                        <li class="nav-item">
                            <a href="{{route('departments.index')}}" class="nav-link  {{ Request::is('departments*')  ? 'active':''  }}">
                                <i class="fa fa-bars pl-3" aria-hidden="true"></i>
                                <p class="pl-3">{{__('Department')}}</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('shifts.index')}}" class="nav-link  {{ Request::is('shifts*')  ? 'active':''  }}">
                                <i class="fa fa-bars pl-3" aria-hidden="true"></i>
                                <p class="pl-3">{{__('Shifts')}}</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('majors.index')}}" class="nav-link  {{ Request::is('majors*')  ? 'active':''  }}">
                                <i class="fa fa-bars pl-3" aria-hidden="true"></i>
                                <p class="pl-3">{{__('Majors')}}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- students  --}}
                <li class="nav-item {{ Request::is('students*') ? 'menu-open active':'' }}">
                    <a href="#" class="nav-link  {{ Request::is('students/lists') || Request::is('students/reports') || Request::is('students/create') ? 'active':'' }}">
                        <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                        <p style="padding-left: 20px">
                            {{__('Students')}}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview ">
                        <li class="nav-item ">
                            <a href="{{url('students')}}" class="nav-link  {{ Request::is('students') ? 'active':'' }}">
                                <i class="fa fa-bars pl-3" aria-hidden="true"></i>
                                <p class="pl-3">{{__('List Students')}}</p>
                            </a>
                            <a href="{{url('students/reports')}}" class="nav-link  {{ Request::is('students/reports') ? 'active':'' }}">
                                <i class="fa fa-file-pdf-o pl-3" aria-hidden="true"></i>
                                <p class="pl-3">{{__('Student Reports')}}</p>
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
