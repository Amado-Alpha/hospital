  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  <img src="dist/img/profile.jpg" class="img-circle elevation-2" alt="User Image">
              </div>
              <div class="info">
                  <a href="#" class="d-block">
                      {{-- username --}}
                      {{ Auth::user()->f_name }} - {{ Auth::user()->l_name }}
                  </a>
              </div>
          </div>

          <!-- SidebarSearch Form -->
          <div class="form-inline">
              <div class="input-group" data-widget="sidebar-search">
                  <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                      aria-label="Search">
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
                  <li class="nav-header active">NAVIGATION</li>

                  {{-- //psttient area --}}
                  <li class="nav-item">
                      <a href="{{ route('dashboard') }}" class="nav-link">
                          <i class="nav-icon fas fa-th"></i>
                          <p>
                              Dashboard
                              {{-- <span class="right badge badge-danger">New</span> --}}
                          </p>
                      </a>
                  </li>

                  <li class="nav-item">
                      <a href="{{ route('showattendance') }}" class="nav-link">
                          <i class="nav-icon fas fa-calendar"></i>
                          <p>
                              Nurses' Attendance
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('showbed') }}" class="nav-link">
                          <i class="nav-icon fas fa-bed"></i>
                          <p>
                              Registered Beds
                          </p>
                      </a>
                  </li>

                  <li class="nav-item menu-close ">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fa fa-users"></i>
                          <p>
                              Manage Users
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ route('nurse') }}" class="nav-link">
                                  <i class="nav-icon far fas fa-user-md"></i>
                                  <p> Add Nurse</p>
                              </a>
                          </li>
                          {{-- <li class="nav-item">
                                  <a href="" class="nav-link">
                                      <i class="nav-icon fa fa-user-nurse"></i></i>
                                      <p> Receptionist</p>
                                  </a>
                              </li> --}}
                      </ul>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('showrequest') }}" class="nav-link">
                        <i class="nav-icon fas fa-registered"></i>
                        <p>
                            Service Requests
                        </p>
                    </a>
                </li>

              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>
