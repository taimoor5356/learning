<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <!-- <a href="index3.html" class="brand-link">
        <img src="{{url('public/images/school_images/'.systemSettings()->school_logo)}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{systemSettings()->school_logo_name}}</span>
    </a> -->

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3">
            <div class="image d-flex justify-content-center" style="width: 100%">
                <img src="{{url('public/images/school_images/'.systemSettings()->school_logo)}}" style="height: 100px !important; width: 100px !important" class="img-circle elevation-2 bg-white p-2" alt="User Image">
            </div>
            <!-- <a href="#" class="d-block text-lg">{{systemSettings()->school_logo_name}}</a> -->
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Admin Links -->
                @if (Auth::user()->user_type == 1)
                <li class="nav-item">
                    <a href="{{url('admin/dashboard')}}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('admin/account')}}" class="nav-link @if(Request::segment(2) == 'account') active @endif">
                        <i class="nav-icon far fa-circle"></i>
                        <p>
                            My Account
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview @if(Request::segment(2) == 'admin' || Request::segment(2) == 'student' || Request::segment(2) == 'teacher') menu-open @endif">
                    <a href="#" class="nav-link @if(Request::segment(2) == 'admin' || Request::segment(2) == 'student' || Request::segment(2) == 'teacher') active @endif">
                        <i class="nav-icon far fa-circle"></i>
                        <p>
                            Users
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('admin/admin/list')}}" class="nav-link @if(Request::segment(2) == 'admin') active @endif">
                                <i class="fas fa-minus nav-icon"></i>
                                <p>Admins</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/teacher/list')}}" class="nav-link @if(Request::segment(2) == 'teacher') active @endif">
                                <i class="fas fa-minus nav-icon"></i>
                                <p>Teachers</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/student/list')}}" class="nav-link @if(Request::segment(2) == 'student') active @endif">
                                <i class="fas fa-minus nav-icon"></i>
                                <p>Students</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview @if(Request::segment(2) == 'class' || Request::segment(2) == 'subject' || Request::segment(2) == 'class-subject' || Request::segment(2) == 'class-teacher' || Request::segment(2) == 'class-timetable') menu-open @endif">
                    <a href="#" class="nav-link @if(Request::segment(2) == 'class' || Request::segment(2) == 'subject' || Request::segment(2) == 'class-subject' || Request::segment(2) == 'class-teacher' || Request::segment(2) == 'class-timetable') active @endif">
                        <i class="nav-icon far fa-circle"></i>
                        <p>
                            Academics
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('admin/class/list')}}" class="nav-link @if(Request::segment(2) == 'class') active @endif">
                                <i class="fas fa-minus nav-icon"></i>
                                <p>Class</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/subject/list')}}" class="nav-link @if(Request::segment(2) == 'subject') active @endif">
                                <i class="fas fa-minus nav-icon"></i>
                                <p>Subject</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/class-subject/list')}}" class="nav-link @if(Request::segment(2) == 'class-subject') active @endif">
                                <i class="fas fa-minus nav-icon"></i>
                                <p>Assign Subject</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/class-timetable/list')}}" class="nav-link @if(Request::segment(2) == 'class-timetable') active @endif">
                                <i class="fas fa-minus nav-icon"></i>
                                <p>Class Timetable</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/class-teacher/list')}}" class="nav-link @if(Request::segment(2) == 'class-teacher') active @endif">
                                <i class="fas fa-minus nav-icon"></i>
                                <p>Assign Class Teacher</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview @if(Request::segment(2) == 'examinations') menu-open @endif">
                    <a href="#" class="nav-link @if(Request::segment(2) == 'examinations') active @endif">
                        <i class="nav-icon far fa-circle"></i>
                        <p>
                            Examination
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('admin/examinations/exams-list')}}" class="nav-link @if(Request::segment(3) == 'exams-list') active @endif">
                                <i class="fas fa-minus nav-icon"></i>
                                <p>Exams List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/examinations/scheduled-exams')}}" class="nav-link @if(Request::segment(3) == 'scheduled-exams') active @endif">
                                <i class="fas fa-minus nav-icon"></i>
                                <p>Exams Schedule</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/examinations/subject-marks')}}" class="nav-link @if(Request::segment(3) == 'subject-marks') active @endif">
                                <i class="fas fa-minus nav-icon"></i>
                                <p>Subject Results/Marks</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview @if(Request::segment(2) == 'attendance') menu-open @endif">
                    <a href="#" class="nav-link @if(Request::segment(2) == 'attendance') active @endif">
                        <i class="nav-icon far fa-circle"></i>
                        <p>
                            Attendance
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('admin/attendance/student-attendance')}}" class="nav-link @if(Request::segment(3) == 'student-attendance') active @endif">
                                <i class="fas fa-minus nav-icon"></i>
                                <p>Mark Student Attendance</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/attendance/student-attendance-report')}}" class="nav-link @if(Request::segment(3) == 'student-attendance-report') active @endif">
                                <i class="fas fa-minus nav-icon"></i>
                                <p>Student Attendance Report</p>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                                    <a href="{{url('admin/attendance/teacher-attendance')}}" class="nav-link @if(Request::segment(3) == 'teacher-attendance') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Mark Teacher Attendance</p>
                                    </a>
                                </li> -->
                    </ul>
                </li>
                <li class="nav-item has-treeview @if(Request::segment(2) == 'communicate') menu-open @endif">
                    <a href="#" class="nav-link @if(Request::segment(2) == 'communicate') active @endif">
                        <i class="nav-icon far fa-circle"></i>
                        <p>
                            Communicate
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('admin/communicate/notice-board/list')}}" class="nav-link @if(Request::segment(3) == 'notice-board') active @endif">
                                <i class="fas fa-minus nav-icon"></i>
                                <p>Notice Board</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/communicate/emails/send')}}" class="nav-link @if(Request::segment(3) == 'emails') active @endif">
                                <i class="fas fa-minus nav-icon"></i>
                                <p>Emails</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview @if(Request::segment(2) == 'home-work') menu-open @endif">
                    <a href="#" class="nav-link @if(Request::segment(2) == 'home-work') active @endif">
                        <i class="nav-icon far fa-circle"></i>
                        <p>
                            Homework
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('admin/home-work/list')}}" class="nav-link @if(Request::url() == url('admin/home-work/list')) active @endif">
                                <i class="fas fa-minus nav-icon"></i>
                                <p>List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/home-work/submitted-list')}}" class="nav-link @if(Request::url() == url('admin/home-work/submitted-list')) active @endif">
                                <i class="fas fa-minus nav-icon"></i>
                                <p>Submitted Homework</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview @if(Request::segment(2) == 'fee-collection') menu-open @endif">
                    <a href="#" class="nav-link @if(Request::segment(2) == 'fee-collection') active @endif">
                        <i class="nav-icon far fa-circle"></i>
                        <p>
                            Fee Collection
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('admin/fee-collection/list')}}" class="nav-link @if(Request::url() == url('admin/fee-collection/list')) active @endif">
                                <i class="fas fa-minus nav-icon"></i>
                                <p>List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/fee-collection/report')}}" class="nav-link @if(Request::url() == url('admin/fee-collection/report')) active @endif">
                                <i class="fas fa-minus nav-icon"></i>
                                <p>Fee Report</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{url('admin/password/edit')}}" class="nav-link @if(Request::segment(2) == 'password') active @endif">
                        <i class="nav-icon far fa-circle"></i>
                        <p>
                            Change Password
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('admin/settings')}}" class="nav-link @if(Request::segment(2) == 'settings') active @endif">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Settings
                        </p>
                    </a>
                </li>
                <!-- Teacher Links -->
                @elseif (Auth::user()->user_type == 2)
                <li class="nav-item">
                    <a href="{{url('teacher/dashboard')}}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('teacher/subject/list')}}" class="nav-link @if(Request::segment(2) == 'subject') active @endif">
                        <i class="nav-icon far fa-circle"></i>
                        <p>
                            My Class Subjects
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('teacher/student/list')}}" class="nav-link @if(Request::segment(2) == 'student') active @endif">
                        <i class="nav-icon far fa-circle"></i>
                        <p>
                            My Students
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('teacher/attendance/student-attendance')}}" class="nav-link @if(Request::segment(3) == 'student-attendance') active @endif">
                        <i class="nav-icon far fa-circle"></i>
                        <p>
                            Student Attendance
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('teacher/attendance/student-attendance-report')}}" class="nav-link @if(Request::segment(3) == 'student-attendance-report') active @endif">
                        <i class="nav-icon far fa-circle"></i>
                        <p>
                            Student Attendance Report
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('teacher/examinations/scheduled-exams')}}" class="nav-link @if(Request::segment(3) == 'scheduled-exams') active @endif">
                        <i class="nav-icon far fa-circle"></i>
                        <p>
                            My Exams Scheules
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('teacher/calendar/show')}}" class="nav-link @if(Request::segment(2) == 'calendar') active @endif">
                        <i class="nav-icon far fa-circle"></i>
                        <p>
                            My Calendar
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('teacher/examinations/subject-marks')}}" class="nav-link @if(Request::segment(3) == 'subject-marks') active @endif">
                        <i class="nav-icon far fa-circle"></i>
                        <p>
                            Subject Marks
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('teacher/communicate/notice-board/list')}}" class="nav-link @if(Request::segment(3) == 'notice-board') active @endif">
                        <i class="nav-icon far fa-circle"></i>
                        <p>
                            My Notice Board
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview @if(Request::segment(2) == 'home-work') menu-open @endif">
                    <a href="#" class="nav-link @if(Request::segment(2) == 'home-work') active @endif">
                        <i class="nav-icon far fa-circle"></i>
                        <p>
                            Homework
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('teacher/home-work/list')}}" class="nav-link @if(Request::url() == url('teacher/home-work/list')) active @endif">
                                <i class="fas fa-minus nav-icon"></i>
                                <p>List</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{url('teacher/account')}}" class="nav-link @if(Request::segment(2) == 'account') active @endif">
                        <i class="nav-icon far fa-circle"></i>
                        <p>
                            My Account
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('teacher/password/edit')}}" class="nav-link @if(Request::segment(2) == 'password') active @endif">
                        <i class="nav-icon far fa-circle"></i>
                        <p>
                            Change Password
                        </p>
                    </a>
                </li>
                <!-- Student Links -->
                @elseif (Auth::user()->user_type == 3)
                <li class="nav-item">
                    <a href="{{url('student/dashboard')}}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('student/account')}}" class="nav-link @if(Request::segment(2) == 'account') active @endif">
                        <i class="nav-icon far fa-circle"></i>
                        <p>
                            My Account
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('student/fee-collection/list')}}" class="nav-link @if(Request::url() == url('student/fee-collection/list')) active @endif">
                        <i class="nav-icon far fa-circle"></i>
                        <p>
                            My Fees
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('student/subject/list')}}" class="nav-link @if(Request::segment(2) == 'subject') active @endif">
                        <i class="nav-icon far fa-circle"></i>
                        <p>
                            My Subjects
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('student/class-timetable/list')}}" class="nav-link @if(Request::segment(2) == 'class-timetable') active @endif">
                        <i class="nav-icon far fa-circle"></i>
                        <p>
                            My Timetable
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('student/attendance/student-attendance')}}" class="nav-link @if(Request::segment(3) == 'student-attendance') active @endif">
                        <i class="nav-icon far fa-circle"></i>
                        <p>
                            My Attendance
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('student/examinations/scheduled-exams')}}" class="nav-link @if(Request::segment(3) == 'scheduled-exams') active @endif">
                        <i class="nav-icon far fa-circle"></i>
                        <p>
                            My Exams Schedule
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('student/examinations/subject-marks')}}" class="nav-link @if(Request::segment(3) == 'subject-marks') active @endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Results/Marks</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('student/calendar/show')}}" class="nav-link @if(Request::segment(2) == 'calendar') active @endif">
                        <i class="nav-icon far fa-circle"></i>
                        <p>
                            My Calendar
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('student/communicate/notice-board/list')}}" class="nav-link @if(Request::segment(3) == 'notice-board') active @endif">
                        <i class="nav-icon far fa-circle"></i>
                        <p>
                            My Notice Board
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('student/home-work/list')}}" class="nav-link @if(Request::url() == url('student/home-work/list')) active @endif">
                        <i class="nav-icon far fa-circle"></i>
                        <p>
                            My Homework
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('student/home-work/submitted')}}" class="nav-link @if(Request::url() == url('student/home-work/submitted')) active @endif">
                        <i class="nav-icon far fa-circle"></i>
                        <p>
                            My Submitted Homework
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('student/password/edit')}}" class="nav-link @if(Request::segment(2) == 'password') active @endif">
                        <i class="nav-icon far fa-circle"></i>
                        <p>
                            Change Password
                        </p>
                    </a>
                </li>
                <!-- Parent Links -->
                @elseif (Auth::user()->user_type == 4)
                <li class="nav-item">
                    <a href="{{url('admin/dashboard')}}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('admin/admin/list')}}" class="nav-link @if(Request::segment(2) == 'admin') active @endif">
                        <i class="nav-icon far fa-circle"></i>
                        <p>
                            Admin
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('admin/class-subject/list')}}" class="nav-link @if(Request::segment(2) == 'assign-subject') active @endif">
                        <i class="nav-icon far fa-circle"></i>
                        <p>
                            Change Password
                        </p>
                    </a>
                </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>