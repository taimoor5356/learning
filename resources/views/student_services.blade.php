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
                    <h1 class="m-0 text-dark">Student Services</h1>
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
                                <h2>Student Services</h2>
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
                                        <li class="my-4" style="list-style: none">
                                            <h3><i class="far fa-star text-primary"></i> &nbsp; HELP DESK</h3>
                                        </li>
                                        <li class="my-4" style="list-style: none">
                                            <h3><i class="far fa-star text-primary"></i> &nbsp; BASIC ENGLISH CORRECTION DESK</h3>
                                        </li>
                                        <li class="my-4" style="list-style: none">
                                            <h3><i class="far fa-star text-primary"></i> &nbsp; FOUNDATION CLASSES ENGLISH & MATHS</h3>
                                        </li>
                                        <li class="my-4" style="list-style: none">
                                            <h3><i class="far fa-star text-primary"></i> &nbsp; LIBRARY</h3>
                                        </li>
                                        <li class="my-4" style="list-style: none">
                                            <h3><i class="far fa-star text-primary"></i> &nbsp; VIRTUAL CLASSES</h3>
                                        </li>
                                        <li class="my-4" style="list-style: none">
                                            <h3><i class="far fa-star text-primary"></i> &nbsp; FREE REVISION SESSIONS</h3>
                                        </li>
                                        <li class="my-4" style="list-style: none">
                                            <h3><i class="far fa-star text-primary"></i> &nbsp; TOPPER BATCH</h3>
                                        </li>
                                        <li class="my-4" style="list-style: none">
                                            <h3><i class="far fa-star text-primary"></i> &nbsp; MPT CLASSES</h3>
                                        </li>
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