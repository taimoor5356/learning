<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ !empty(systemSettings()) ? systemSettings()->school_logo_name : '' }} | Sign Up</title>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css">
    <style>
        .mywrapper {
            width: 100%;
            margin-top: 100px;
        }

        .mywrapper .carousel {
            max-width: 1500px;
            margin: auto;
            padding: 0 30px;
        }

        .carousel .mycard {
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: none;
            border-color: none;
        }

        .fixed-top-row {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            /* Adjust as needed */
        }

        .fixed-bottom-row {
            position: fixed;
            bottom: 20px;
            left: 0;
            width: 100%;
            z-index: 1000;
            /* Adjust as needed */
        }

        .group-text {
            position: relative;
            height: 30px;
            overflow: hidden;

        }

        /* Extra Large Devices (greater than 1200px) */
        @media (min-width: 1200px) {
            .group-text .login-box-msg {
                position: absolute;
                margin: 0px 0;
                padding: 0;
                width: max-content;
                animation: my-animation 40s linear infinite;
            }
        }

        /* Large Devices (992px - 1199px) */
        @media (min-width: 992px) and (max-width: 1199px) {

            /* Your CSS rules for large devices here */
            .group-text .login-box-msg {
                position: absolute;
                margin: 0px 0;
                padding: 0;
                width: max-content;
                animation: my-animation 40s linear infinite;
            }
        }

        /* Medium Devices (768px - 991px) */
        @media (min-width: 768px) and (max-width: 991px) {

            /* Your CSS rules for medium devices here */
            .group-text .login-box-msg {
                position: absolute;
                margin: 0px 0;
                padding: 0;
                width: max-content;
                animation: my-animation 40s linear infinite;
            }
        }

        /* Small Devices (576px - 767px) */
        @media (min-width: 576px) and (max-width: 767px) {

            /* Your CSS rules for small devices here */
            .group-text .login-box-msg {
                position: absolute;
                margin: 0px 0;
                padding: 0;
                width: max-content;
                animation: my-animation 40s linear infinite;
            }
        }

        /* Extra Small Devices (up to 575px) */
        @media (max-width: 575px) {

            /* Your CSS rules for extra small devices here */
            .group-text .login-box-msg {
                position: absolute;
                margin: 0px 0;
                padding: 0;
                width: max-content;
                animation: my-animation 40s linear infinite;
            }
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box" style="width: 100%;">
        <div class="row fixed-top-row p-0" style="margin: 0px auto; width: 100%;">
            <div class="col-12 p-0 m-0" style="margin: 0px auto; width: 100%;">
                <div class="card card-outline card-primary p-0" style="margin: 0px auto; width: 100%;">
                    <div class="card-body login-card-body text-center p-0" style="margin: 0px auto; width: 100%;">
                        <h5 class="font-weight-bold text-danger">Important Note</h5>
                        <div class="text-container p-0 group-text" style="margin: 0px auto; width: 100%;">
                            <span class="login-box-msg font-weight-bold">{{
    collect(range(0, 2))->map(function($index) use ($texts) {
        return isset($texts[$index]) ? $texts[$index] : ' ';
    })->implode('  ')
}}</span>
                        </div>
                    </div>
                    <!-- /.login-card-body -->
                </div>
            </div>
        </div>
        <div class="row" style="margin: 0px auto;">
            <div class="col-lg-4 col-md-4 col-sm-12">
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 d-flex justify-content-center">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="login-logo">
                        <h6>
                        <img src="{{url('public/images/school_images/'.(isset(systemSettings()->school_logo) ? systemSettings()->school_logo: ''))}}" class="img-fluid" style="border-radius: 5px; height: 100px; width: 105px" alt="">
                        </h6>
                        <a href="#"><b class="font-weight-bold">{{ !empty(systemSettings()) ? systemSettings()->school_logo_name : '' }}</b></a>
                        <h6>{{ !empty(systemSettings()) ? systemSettings()->school_description : '' }}</h6>
                    </div>
                    <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-body login-card-body">
                <h5 class="login-box-msg p-0 font-weight-bold">Sign Up</h5>
                <br>
                @include('_message')
                <form action="" method="post">
                    @csrf
                    <div class="input-group">
                        <input type="email" required name="email" class="form-control" placeholder="Email" value="{{ old('email') ?? (isset($record) ? $record->email : '') }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <span class="text-danger">{{$errors->first('email')}}</span>
                    <div class="input-group my-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
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
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
            </div>
        </div>
        <div class="row mywrapper">
            <div class="carousel owl-carousel">
                <div class="mycard card-1">
                    <img src="{{url('public/images/school_images/'.(isset(systemSettings()->school_login_page_image_one) ? systemSettings()->school_login_page_image_one : ''))}}" class="img-fluid" style="border-radius: 5px; height: 150px; width: 250px" alt="">
                </div>
                <div class="mycard card-2">
                    <img src="{{url('public/images/school_images/'.(isset(systemSettings()->school_login_page_image_two) ? systemSettings()->school_login_page_image_two: ''))}}" class="img-fluid" style="border-radius: 5px; height: 150px; width: 250px" alt="">
                </div>
                <div class="mycard card-3">
                    <img src="{{url('public/images/school_images/'.(isset(systemSettings()->school_login_page_image_three) ? systemSettings()->school_login_page_image_three: ''))}}" class="img-fluid" style="border-radius: 5px; height: 150px; width: 250px" alt="">
                </div>
                <div class="mycard card-4">
                    <img src="{{url('public/images/school_images/'.(isset(systemSettings()->school_login_page_image_four) ? systemSettings()->school_login_page_image_four: ''))}}" class="img-fluid" style="border-radius: 5px; height: 150px; width: 250px" alt="">
                </div>
                <div class="mycard card-5">
                    <img src="{{url('public/images/school_images/'.(isset(systemSettings()->school_login_page_image_five) ? systemSettings()->school_login_page_image_five: ''))}}" class="img-fluid" style="border-radius: 5px; height: 150px; width: 250px" alt="">
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <script>
        var style = document.createElement('style');
        var position = 'right';

        style.innerHTML = `@keyframes my-animation { 0%{${position}: -${document.querySelector('.login-box-msg').offsetWidth + 10}px;} 
            100%{${position}:100%;}
        }`;
        document.head.append(style);
    </script>
    <script>
        
        $(document).ready(function() {
            $(document).on('click', '.btn-block', function() {
                let _this = $(this);
                setTimeout(function() {
                    _this.attr('disabled', true);
                }, 500);
            });
        });
        $('.carousel').owlCarousel({
            margin: 10,
            loop: true,
            autoplay: true,
            autoplayTimeout: 2000,
            autoplayHoverPause: true,
            items: 5, // Set to 4 to display 4 items at a time
            responsive: {
                0: {
                    items: 1,
                    nav: false
                },
                600: {
                    items: 3,
                    nav: false
                },
                1000: {
                    items: 5, // Change to 4 to maintain consistency
                    nav: false
                }
            }
        });
    </script>

</body>

</html>