      <?php
      
      $prefix = Request::route()->getPrefix();
      $route = Route::current()->getName();
      
      ?>



      <aside class="main-sidebar sidebar-dark-primary elevation-4">
          <!-- Brand Logo -->
          <a href="{{ route('home') }}" class="brand-link">
              <img src="{{ asset('backend/img/logo.png') }}" alt="Logo" class="brand-image img-circle elevation-3"
                  style="opacity: .8">
              <span class="brand-text font-weight-light">BrainStation 24</span>
          </a>

          <!-- Sidebar -->
          <div class="sidebar">
              <!-- Sidebar user panel (optional) -->
              <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                  <div class="image">
                      <img src="{{ !empty(Auth::user()->image) ? asset('backend/img/uploads/' . Auth::user()->image) : asset('backend/img/avatar.png') }}"
                          class="img-circle elevation-2" alt="User Image">
                  </div>
                  <div class="info">
                      <a href="{{ route('profileView') }}" class="d-block">{{ Auth::user()->name }}</a>
                  </div>
              </div>


              <!-- Sidebar Menu -->
              <nav class="mt-2">
                  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                      data-accordion="false">
                      <li class="nav-item">
                          <a href="{{ route('home') }}" class="nav-link">
                              <i class="nav-icon fas fa-th"></i>
                              <p>
                                  Dashboard
                              </p>
                          </a>
                      </li>


                      @if (Auth::user()->usertype == 'Admin')
                          <li class="nav-item {{ $prefix == '/users' ? 'menu-open' : '' }}">
                              <a href="#" class="nav-link">
                                  <i class="nav-icon fas fa-tachometer-alt"></i>
                                  <p>
                                      Users
                                      <i class="right fas fa-angle-left"></i>
                                  </p>
                              </a>
                              <ul class="nav nav-treeview">
                                  <li class="nav-item">
                                      <a href="{{ route('backUsersView') }}"
                                          class="nav-link {{ $route == 'backUsersView' ? 'active' : '' }}">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>View Users</p>
                                      </a>
                                  </li>
                              </ul>
                          </li>
                      @endif




                      <li class="nav-item {{ $prefix == '/profile' ? 'menu-open' : '' }}">
                          <a href="#" class="nav-link">
                              <i class="nav-icon fas fa-tachometer-alt"></i>
                              <p>
                                  Profile
                                  <i class="right fas fa-angle-left"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">
                              <li class="nav-item">
                                  <a href="{{ route('profileView') }}"
                                      class="nav-link {{ $route == 'profileView' ? 'active' : '' }}">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Your Profile</p>
                                  </a>
                              </li>

                              <li class="nav-item">
                                  <a href="{{ route('profilePasswordView') }}"
                                      class="nav-link {{ $route == 'profilePasswordView' ? 'active' : '' }}">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Change Password</p>
                                  </a>
                              </li>
                          </ul>
                      </li>
                      <li class="nav-item">
                          <a href="#" class="nav-link">
                              <i class="nav-icon fas fa-th"></i>
                              <p>
                                  sample
                              </p>
                          </a>
                      </li>
                  </ul>
              </nav>
              <!-- /.sidebar-menu -->
          </div>
          <!-- /.sidebar -->
      </aside>