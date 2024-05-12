<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script
  src="https://code.jquery.com/jquery-3.7.1.min.js"
  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
  crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css">
    <style>
        /* * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            display: flex;
            align-items: end;
            min-height: 100vh;
        } */

        .mywrapper {
            width: 100%;
        }

        .mywrapper .carousel {
            max-width: 1200px;
            margin: auto;
            padding: 0 30;
        }

        .carousel .card {
            line-height: 250px;
            text-align: center;
            color: #fff;
            font-size: 90px;
            font-weight: 600;
            margin: 20px 10px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }

        .carousel .card-1 {
            background-color: red;
        }

        .carousel .card-2 {
            background-color: green;
        }

        .carousel .card-3 {
            background-color: blue;
        }

        .carousel .card-4 {
            background-color: yellow;
        }

        .carousel .card-5 {
            background-color: orange;
        }
    </style>
</head>

<body>
    <div class="mywrapper">
        <div class="carousel owl-carousel">
            <div class="card card-1">
                <img src="{{url('public/images/school_images/1.png')}}" class="img-fluid" style="border-radius: 5px;" height="250px" width="250px" alt="">
            </div>
            <div class="card card-2">
                <img src="{{url('public/images/school_images/2.jpg')}}" class="img-fluid" style="border-radius: 5px;" height="250px" width="250px" alt="">
            </div>
            <div class="card card-3">
                <img src="{{url('public/images/school_images/3.jpg')}}" class="img-fluid" style="border-radius: 5px;" height="250px" width="250px" alt="">
            </div>
            <div class="card card-4">
                <img src="{{url('public/images/school_images/4.jpg')}}" class="img-fluid" style="border-radius: 5px;" height="250px" width="250px" alt="">
            </div>
            <div class="card card-5">
                <img src="{{url('public/images/school_images/5.png')}}" class="img-fluid" style="border-radius: 5px;" height="250px" width="250px" alt="">
            </div>
        </div>
    </div>
    <script>
        $('.carousel').owlCarousel({
            margin: 10,
            loop: true,
            autoplay: true,
            autoplayTimeout: 2000,
            autoplayHoverPause: true,
            // responsive: {}
        });
    </script>
</body>

</html>