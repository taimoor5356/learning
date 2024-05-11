@extends('layouts.app')
@section('style')
<style type="text/css">

</style>
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Follow Us</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0 d-flex justify-content-center">
                            <center>
                                <h2>Links</h2>
                                <div class="alert-messages w-50 ms-auto text-center">
                                    <div class="toast bg-success" id="notification" role="alert" aria-live="assertive" aria-atomic="true">
                                        <div class="toast-header text-bold text-white py-0 bg-success border-bottom border-white">
                                            <span class="success-header"></span>
                                            <div class="close-toast-msg ms-auto text-end cursor-pointer">
                                                X
                                            </div>
                                        </div>
                                        <div class="toast-body text-white text-bold">

                                        </div>
                                    </div>
                                </div>
                            </center>
                        </div>
                        <hr>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="row">
                                <div class="col-12 d-flex justify-content-center">
                                    <ul class="">
                                        <li class="my-4" style="list-style: none"><a href="https://www.youtube.com/c/CivilServicesPreparatorySchoolforCSSPMSAcademy">
                                                <h3><i class="fab fa-youtube text-danger"></i> &nbsp; Services Preparatory School-CSPs</h3>
                                        </li></a>
                                        <li class="my-4" style="list-style: none"><a href="https://www.facebook.com/CSPsAcademy">
                                                <h3><i class="fab fa-facebook text-primary"></i> &nbsp;&nbsp;&nbsp; CSPs Academy</h3>
                                        </li></a>
                                        <li class="my-4" style="list-style: none"><a href="https://www.instagram.com/cspsacademy/">
                                                <h3><i class="fab fa-instagram text-danger"></i> &nbsp;&nbsp; CSPs Academy</h3>
                                        </li></a>
                                        <li class="my-4" style="list-style: none"><a href="https://www.csps.com.pk/">
                                                <h3><i class="fas fa-globe text-info"></i> &nbsp;&nbsp; www.csps.com.pk</h3>
                                        </li></a>
                                        <li class="my-4" style="list-style: none"><a href="https://www.tiktok.com/@csps_academy">
                                                <h3 class="font-w"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-tiktok" viewBox="0 0 16 16">
                                                        <path d="M9 0h1.98c.144.715.54 1.617 1.235 2.512C12.895 3.389 13.797 4 15 4v2c-1.753 0-3.07-.814-4-1.829V11a5 5 0 1 1-5-5v2a3 3 0 1 0 3 3z" />
                                                    </svg> &nbsp;&nbsp; CSPs Academy</h3>
                                        </li></a>
                                        <li class="my-4" style="list-style: none"><a href="https://twitter.com/CSPSAcademy">
                                                <h3><i class="fab fa-twitter text-info"></i> &nbsp; CSPs Academy</h3>
                                        </li></a>
                                        <li class="my-4" style="list-style: none"><a href="csps.css@gmail.com">
                                                <h3><i class="fab fa-google text-secondary"></i> &nbsp; csps.css@gmail.com</h3>
                                        </li></a>
                                        <li class="my-4" style="list-style: none"><a href="https://api.whatsapp.com/send/?phone=923165701593&text&type=phone_number&app_absent=0">
                                                <h3><i class="fab fa-whatsapp text-success"></i> &nbsp; +92-3165701593</h3>
                                        </li></a>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

@endsection