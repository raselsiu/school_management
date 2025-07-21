      <?php
      
      $prefix = Request::route()->getPrefix();
      $route = Route::current()->getName();
      
      ?>



      <aside class="main-sidebar sidebar-dark-primary elevation-4">
          <!-- Brand Logo -->
          <a href="{{ route('home') }}" class="brand-link">
              <img src="{{ asset('backend/img/logo.png') }}" alt="Logo" class="brand-image img-circle elevation-3"
                  style="opacity: .8">
              <span class="brand-text font-weight-light">School M. System</span>
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


                      @if (Auth::user()->role == 'Admin')
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


                      <li class="nav-item {{ $prefix == '/students' ? 'menu-open' : '' }}">
                          <a href="#" class="nav-link">
                              <i class="nav-icon fas fa-tachometer-alt"></i>
                              <p>
                                  Setup
                                  <i class="right fas fa-angle-left"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">
                              <li class="nav-item">
                                  <a href="{{ route('setupStudentClassView') }}"
                                      class="nav-link {{ $route == 'setupStudentClassView' ? 'active' : '' }}">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Student Class</p>
                                  </a>
                              </li>

                              <li class="nav-item">
                                  <a href="{{ route('setupStudentYearView') }}"
                                      class="nav-link {{ $route == 'setupStudentYearView' ? 'active' : '' }}">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Student Year</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="{{ route('setupStudentGroupView') }}"
                                      class="nav-link {{ $route == 'setupStudentGroupView' ? 'active' : '' }}">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Student Group</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="{{ route('setupStudentShiftView') }}"
                                      class="nav-link {{ $route == 'setupStudentShiftView' ? 'active' : '' }}">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Student Shift</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="{{ route('setupStudentFeeView') }}"
                                      class="nav-link {{ $route == 'setupStudentFeeView' ? 'active' : '' }}">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Fee Category</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="{{ route('studentFeeCategoryAmountView') }}"
                                      class="nav-link {{ $route == 'studentFeeCategoryAmountView' ? 'active' : '' }}">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Fee Category Amount</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="{{ route('examTypeView') }}"
                                      class="nav-link {{ $route == 'examTypeView' ? 'active' : '' }}">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Exam Type</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="{{ route('subjectView') }}"
                                      class="nav-link {{ $route == 'subjectView' ? 'active' : '' }}">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Subject</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="{{ route('assignSubjectView') }}"
                                      class="nav-link {{ $route == 'assignSubjectView' ? 'active' : '' }}">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Assign Subject</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="{{ route('designationView') }}"
                                      class="nav-link {{ $route == 'designationView' ? 'active' : '' }}">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Designation</p>
                                  </a>
                              </li>
                          </ul>
                      </li>

                      <li class="nav-item {{ $prefix == '/students' ? 'menu-open' : '' }}">
                          <a href="#" class="nav-link">
                              <i class="nav-icon fas fa-tachometer-alt"></i>
                              <p>
                                  Manage Student
                                  <i class="right fas fa-angle-left"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">

                              <li class="nav-item">
                                  <a href="{{ route('studentRegiView') }}"
                                      class="nav-link {{ $route == 'studentRegiView' ? 'active' : '' }}">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Student Registration</p>
                                  </a>
                              </li>

                              <li class="nav-item">
                                  <a href="{{ route('studentRollView') }}"
                                      class="nav-link {{ $route == 'studentRollView' ? 'active' : '' }}">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Roll Generate</p>
                                  </a>
                              </li>

                              <li class="nav-item">
                                  <a href="{{ route('studentRegiFee') }}"
                                      class="nav-link {{ $route == 'studentRegiFee' ? 'active' : '' }}">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Registration Fee</p>
                                  </a>
                              </li>

                              <li class="nav-item">
                                  <a href="{{ route('monthlyFeeView') }}"
                                      class="nav-link {{ $route == 'monthlyFeeView' ? 'active' : '' }}">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Monthly Fee</p>
                                  </a>
                              </li>

                              <li class="nav-item">
                                  <a href="{{ route('examFeeView') }}"
                                      class="nav-link {{ $route == 'examFeeView' ? 'active' : '' }}">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Exam Fee</p>
                                  </a>
                              </li>

                          </ul>
                      </li>

                      <li class="nav-item {{ $prefix == '/employees' ? 'menu-open' : '' }}">
                          <a href="#" class="nav-link">
                              <i class="nav-icon fas fa-tachometer-alt"></i>
                              <p>
                                  Manage Employee
                                  <i class="right fas fa-angle-left"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">

                              <li class="nav-item">
                                  <a href="{{ route('employeeRegiView') }}"
                                      class="nav-link {{ $route == 'employeeRegiView' ? 'active' : '' }}">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Employee Registration</p>
                                  </a>
                              </li>

                              <li class="nav-item">
                                  <a href="{{ route('employeeSalaryView') }}"
                                      class="nav-link {{ $route == 'employeeSalaryView' ? 'active' : '' }}">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Employee Salary</p>
                                  </a>
                              </li>

                              <li class="nav-item">
                                  <a href="{{ route('employeeLeaveView') }}"
                                      class="nav-link {{ $route == 'employeeLeaveView' ? 'active' : '' }}">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Employee Leave</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="{{ route('employeeAttendView') }}"
                                      class="nav-link {{ $route == 'employeeAttendView' ? 'active' : '' }}">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Employee Attendance</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="{{ route('employeeMonthlySalaryView') }}"
                                      class="nav-link {{ $route == 'employeeMonthlySalaryView' ? 'active' : '' }}">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Monthly Salary</p>
                                  </a>
                              </li>
                          </ul>
                      </li>

                      <li class="nav-item {{ $prefix == '/marks' ? 'menu-open' : '' }}">
                          <a href="#" class="nav-link">
                              <i class="nav-icon fas fa-tachometer-alt"></i>
                              <p>
                                  Marks Management
                                  <i class="right fas fa-angle-left"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">

                              <li class="nav-item">
                                  <a href="{{ route('marksAdd') }}"
                                      class="nav-link {{ $route == 'marksAdd' ? 'active' : '' }}">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Marks Entry</p>
                                  </a>
                              </li>

                              <li class="nav-item">
                                  <a href="{{ route('editMarks') }}"
                                      class="nav-link {{ $route == 'editMarks' ? 'active' : '' }}">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Marks Edit</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="{{ route('gradePointView') }}"
                                      class="nav-link {{ $route == 'gradePointView' ? 'active' : '' }}">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Grade Point</p>
                                  </a>
                              </li>

                          </ul>
                      </li>
                      <li class="nav-item {{ $prefix == '/accounts' ? 'menu-open' : '' }}">
                          <a href="#" class="nav-link">
                              <i class="nav-icon fas fa-tachometer-alt"></i>
                              <p>
                                  Account Management
                                  <i class="right fas fa-angle-left"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">

                              <li class="nav-item">
                                  <a href="{{ route('accStudentFeeView') }}"
                                      class="nav-link {{ $route == 'accStudentFeeView' ? 'active' : '' }}">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Student Fee</p>
                                  </a>
                              </li>

                              <li class="nav-item">
                                  <a href="{{ route('accEmployeeSalaryView') }}"
                                      class="nav-link {{ $route == 'accEmployeeSalaryView' ? 'active' : '' }}">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Employee Salary</p>
                                  </a>
                              </li>

                              <li class="nav-item">
                                  <a href="{{ route('OthersCostview') }}"
                                      class="nav-link {{ $route == 'OthersCostview' ? 'active' : '' }}">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Others Cost</p>
                                  </a>
                              </li>


                          </ul>
                      </li>

                      <li class="nav-item has-treeview {{ $prefix == '/reports' ? 'menu-open' : '' }}">
                          <a href="#" class="nav-link">
                              <i class="nav-icon fas fa-th"></i>
                              <p>
                                  Report Management
                                  <i class="right fas fa-angle-left"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">
                              <li class="nav-item">
                                  <a href="{{ route('profitReportView') }}"
                                      class="nav-link {{ $route == 'profitReportView' ? 'active' : '' }}">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Monthly Profit</p>
                                  </a>
                              </li>

                              <li class="nav-item">
                                  <a href="{{ route('markSheetView') }}"
                                      class="nav-link {{ $route == 'markSheetView' ? 'active' : '' }}">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Marksheet</p>
                                  </a>
                              </li>

                              <li class="nav-item">
                                  <a href="{{ route('attendanceView') }}"
                                      class="nav-link {{ $route == 'attendanceView' ? 'active' : '' }}">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Attendance Report</p>
                                  </a>
                              </li>

                              <li class="nav-item">
                                  <a href="{{ route('studentResultView') }}"
                                      class="nav-link {{ $route == 'studentResultView' ? 'active' : '' }}">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Student Result</p>
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
