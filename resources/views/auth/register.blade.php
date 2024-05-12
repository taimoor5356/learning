<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ !empty(systemSettings()) ? systemSettings()->school_logo_name : '' }} | SignUp</title>
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
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>{{ !empty(systemSettings()) ? systemSettings()->school_logo_name : '' }}</b></a>
        </div>
        <div class="card card-outline card-primary">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign up</p>
                @include('_message')
                <form action="" method="post">
                    @csrf
                    <div class="input-group">
                        <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') ?? (isset($record) ? $record->email : '') }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <span class="text-danger">{{$errors->first('email')}}</span>
                    <div class="input-group my-3">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-success btn-block">Sign Up</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <p class="mt-4 d-flex justify-content-between">
                    <a href="{{url('')}}">Sign In</a>
                </p>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{url('public/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{url('public/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{url('public/dist/js/adminlte.min.js')}}"></script>

</body>
<script>
    $(document).ready(function() {
        $(document).on('click', '.btn-block', function() {
            let _this = $(this);
            setTimeout(function() {
                _this.attr('disabled', true);
            }, 500);
        });
    });
</script>

</html>