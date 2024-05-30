@extends('layouts.app')
@section('style')
<style type="text/css">

</style>
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>My Account</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- /.col -->
                <div class="col-md-12">
                    @include('_message')
                    <!-- /.card -->
                    <!-- /.card-header -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">My Account Details</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" id="form" method="POST" action="{{url('student/update-account')}}" enctype="multipart/form-data">
                            @csrf
                            @include('student._form')
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $(document).on('click', '#add-new-qualification', function () {
            $('.degree-qualification').append(`
            <div class="all-cols-degree-qualification container-fluid">
            <div class="row">
                <div class="form-group col-2">
                    <label for="InputDegree">Certificate/Degree <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="InputDegree" placeholder="Enter degree name" name="degree[]">
                    <span class="text-danger">{{$errors->first('degree')}}</span>
                </div>
                <div class="form-group col-3">
                    <label for="InputMajorSubjects">Major Subjects <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="InputMajorSubjects" placeholder="Enter CGPA" name="major_subjects[]">
                    <span class="text-danger">{{$errors->first('major_subjects')}}</span>
                </div>
                <div class="form-group col-2">
                    <label for="InputCgpa">CGPA/Percentage <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="InputCgpa" placeholder="Enter CGPA" name="cgpa[]">
                    <span class="text-danger">{{$errors->first('cgpa')}}</span>
                </div>
                <div class="form-group col-4">
                    <label for="InputUniversityName">School/College/University Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="InputUniversityName" placeholder="Enter university name" name="university_name[]">
                    <span class="text-danger">{{$errors->first('university_name')}}</span>
                </div>
                <div class="form-group col-1 d-flex justify-content-end">
                    <div>
                        <label for="InputUniversityName"></label>
                        <br>
                        <button type="button" class="btn btn-danger remove-qualification mt-2">-</button>
                    </div>
                </div>
            </div>
        </div>
            `);
        });
        $(document).on('click', '.remove-qualification', function () {
            $(this).closest('.all-cols-degree-qualification').remove();
        });
    });
</script>
@endsection