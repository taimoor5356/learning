<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{systemSettings()->school_logo_name}} | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{url('public/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{url('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{url('public/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{url('public/dist/css/adminlte.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style>
        .my-school-logo {
            width: 75px;
            height: 70px;
            margin-right: 10px;
        }

        @media only screen and (max-width: 405px) {
            .logo-img {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .my-school-logo img {
                width: 50px;
                height: 50px;
                margin: 0px auto;
            }
        }
    </style>
</head>

<body class="hold-transition">
    <section class="content-header" style="margin: 0;">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-12 text-center">
                    <h1 class="logo-content" style="margin-bottom: 0px;">
                        <div class="logo-img">
                            <img class="my-school-logo" src="{{ url('public/images/school_images/'.systemSettings()->school_logo) }}" alt="School Logo">
                        </div>
                        {{ systemSettings()->school_name }}
                    </h1>
                    <p style="margin: 0px 0px 0px 0px;">{{ systemSettings()->school_description }}</p>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="login-page" style="display: block !important; height: 70vh;">
        <div class="login-box" style="margin: 0px auto; padding: 0px 0px">
            <div class="login-logo">
                <a href="#"><b>{{systemSettings()->school_logo_name}}</b></a>
            </div>
            <!-- /.login-logo -->
            <div class="card card-outline card-primary">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Sign in to start your session</p>
                    @include('_message')
                    <form action="{{url('login')}}" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <div class="icheck-primary">
                                    <input type="checkbox" name="remember" id="remember">
                                    <label for="remember">
                                        Remember Me
                                    </label>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-4">
                                <button type="submit" class="btn btn-success btn-block">Sign In</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>

                    <p class="mt-4 d-flex justify-content-between">
                        <a href="{{url('forgot-password')}}">I forgot my password</a>
                        <a href="{{url('signup')}}">SignUp</a>
                    </p>
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
        <br>
        <hr>
        <div class="login-images">
            <div class="row">
                <div class="col-3 d-flex justify-content-center">
                    <img class="login-img-1 img-fluid p-2" style="border-radius: 15px;" height="200px" width="300px" src="{{ url('public/images/school_images/3.jpg') }}" alt="School Logo">
                </div>
                <div class="col-3 d-flex justify-content-center">
                    <img class="login-img-2 img-fluid p-2" style="border-radius: 15px;" height="200px" width="300px" src="{{ url('public/images/school_images/4.png') }}" alt="School Logo">
                </div>
                <div class="col-3 d-flex justify-content-center">
                    <img class="login-img-3 img-fluid p-2" style="border-radius: 15px;" height="200px" width="300px" src="{{ url('public/images/school_images/5.jpg') }}" alt="School Logo">
                </div>
                <div class="col-3 d-flex justify-content-center">
                    <img class="login-img-3 img-fluid p-2" style="border-radius: 15px;" height="200px" width="300px" src="{{ url('public/images/school_images/1.png') }}" alt="School Logo">
                </div>
            </div>
        </div>
        <!-- /.login-box -->
        <!-- <div class="notifications d-flex justify-content-center p-2 font-weight-bold" style="margin: 55px auto;">
            <span class="text-danger font-weight-bold mx-2">Important: </span> Lorem ipsum dolor, sit amet consectetur adipisicing elit. Culpa, maiores voluptatibus iusto fugiat sit dolore eius. Sapiente reprehenderit in consequatur at aliquam obcaecati ut, excepturi sit quos dolor blanditiis animi. Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor officiis at libero eveniet repudiandae quo, pariatur, ex mollitia placeat reiciendis suscipit asperiores fugit unde sunt? Eligendi impedit fugit harum ab.
        </div> -->
    </div>
    <footer class="main-foot p-2 fixed-bottom" style="width: 100% !important;">
        @php
        $setting = \App\Models\Setting::where('id', 1)->first();
        @endphp
        <div class="container-flui">
            <div class="row">
                <div class="col-lg-6">
                    <strong>Copyright &copy; 2024 <a href="#">{{$setting->school_name}}</a>.</strong>
                    All rights reserved.
                </div>
                <div class="col-lg-6 text-lg-right">
                    <div class="float-right d-none d-sm-inline-block">
                        <b>Version</b> 1.0.0
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>