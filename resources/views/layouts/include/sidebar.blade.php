<style>
   [class*=sidebar-dark-] .nav-treeview>.nav-item>.nav-link.active{
    background-color: rgb(204, 204, 204) !important;
    color: #fff;
   }
   [class*=sidebar-dark-] .nav-treeview>.nav-item>.nav-link.active:hover{
    /* color: rgb(214, 203, 203) ; */
    color: #d4d8da;
   }
   /* .navPan{
    padding-left: 28px !important;
   } */

   a{
    color: rgb(63, 61, 61) !important;
   }

   .nav-link.active{
    background-color: rgb(204, 204, 204) !important;
   }

</style>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-info elevation-1" style="background-color: rgb(231, 231, 231);">
    <!-- Brand Logo -->
    <a href="#!" class="brand-link">
        <img src="{{ asset('admin/dist/img/psbu.jpg')}}" alt="psbu image" class="brand-image img-circle elevation-4" style="opacity: .8">
        <span class="brand-text font-weight-light">PSBU SYSTEM</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
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
          </div>

          <!-- SidebarSearch Form -->

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
                <li class="nav-item {{ Request::is('rooms*')|| Request::is('faculties*')|| Request::is('majors*') || Request::is('departments*') || Request::is('shifts*') ? 'menu-open active':'' }}">
                    <a href="#" class="nav-link {{ Request::is('rooms*')|| Request::is('faculties*') || Request::is('majors*') || Request::is('departments*') || Request::is('shifts*') ? 'active':'' }}">
                        <i class="fa fa-university" aria-hidden="true"></i>
                        <p style="padding-left: 20px">
                            {{__('Academic')}}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ">
                            <a href="{{route('faculties.index')}}" class="nav-link  {{ Request::is('faculties*')  ? 'active':''  }}">
                                @if (Request::is('faculties*'))
                                <i class="fa fa-circle pl-3" aria-hidden="true"></i>
                                @else
                                <i class="fa fa-circle-o pl-3" aria-hidden="true"></i>
                                @endif
                                <p class="pl-3">{{__('Faculties')}}</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview ">
                        <li class="nav-item">
                            <a href="{{route('departments.index')}}" class="nav-link  {{ Request::is('departments*')  ? 'active':''  }}">
                                @if ( Request::is('departments*') )
                                <i class="fa fa-circle pl-3" aria-hidden="true"></i>
                                @else
                                <i class="fa fa-circle-o pl-3" aria-hidden="true"></i>
                                @endif
                                <p class="pl-3">{{__('Department')}}</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('shifts.index')}}" class="nav-link  {{ Request::is('shifts*')  ? 'active':''  }}">
                                @if ( Request::is('shifts*'))
                                <i class="fa fa-circle pl-3" aria-hidden="true"></i>
                                @else
                                <i class="fa fa-circle-o pl-3" aria-hidden="true"></i>
                                @endif
                                <p class="pl-3">{{__('Shifts')}}</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('majors.index')}}" class="nav-link  {{ Request::is('majors*')  ? 'active':''  }}">
                                @if ( Request::is('majors*'))
                                <i class="fa fa-circle pl-3" aria-hidden="true"></i>
                                @else
                                <i class="fa fa-circle-o pl-3" aria-hidden="true"></i>
                                @endif
                                <p class="pl-3">{{__('Majors')}}</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('rooms.index')}}" class="nav-link  {{ Request::is('rooms*')  ? 'active':''  }}">
                                @if ( Request::is('rooms*'))
                                <i class="fa fa-circle pl-3" aria-hidden="true"></i>
                                @else
                                <i class="fa fa-circle-o pl-3" aria-hidden="true"></i>
                                @endif
                                <p class="pl-3">{{__('Rooms')}}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- students  --}}
                <li class="nav-item {{ Request::is('students*') || Request::is('subjects*') ? 'menu-open active':'' }}">
                    <a href="#" class="nav-link  {{ Request::is('subjects*') || Request::is('students/lists') || Request::is('students/reports') || Request::is('students/create') ? 'active':'' }}">
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
                            <a href="{{ route('subjects.index')}}" class="nav-link {{ Request::is('subjects*') ? 'active':'' }}">
                                <i class="fa fa-file-pdf-o pl-3" aria-hidden="true"></i>
                                <p class="pl-3">{{__('Subjects')}}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- techer  --}}
                <li class="nav-item {{ Request::is('teachers*') ? 'menu-open active':'' }}">
                    <a href="#" class="nav-link {{ Request::is('teachers*')  ? 'active':'' }}">
                        <i class="fa fa-university" aria-hidden="true"></i>
                        <p style="padding-left: 20px">
                            {{__('Teacher')}}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ">
                            <a href="{{route('teachers.index')}}" class="nav-link  {{ Request::is('teachers*')  ? 'active':''  }}">
                                @if (Request::is('teachers*'))
                                <i class="fa fa-circle pl-3" aria-hidden="true"></i>
                                @else
                                <i class="fa fa-circle-o pl-3" aria-hidden="true"></i>
                                @endif
                                <p class="pl-3">{{__('Teachers')}}</p>
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
