<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <span class="font-weight-bold px-3 rounded py-1">{{Auth::user()->name}}</span>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link p-0" data-toggle="dropdown" href="#">
                <div class="rounded-circle border border-primary bg-primary d-flex justify-content-center align-items-center" style="width: 36px; height: 36px;">
                    <i class="far fa-user text-white"></i>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="{{url('logout')}}" class="dropdown-item text-danger">
                    Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->