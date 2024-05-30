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
                    <h1>Add New Student</h1>
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
                    <!-- /.card -->
                    <!-- /.card-header -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add New Student</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" id="form" method="POST" action="{{url('admin/student/store')}}" enctype="multipart/form-data">
                            @csrf
                            @include('admin.student._form')
                            <!-- <div class="card-body">
                                <div class="form-group">
                                    <label for="InputFullName">Full Name</label>
                                    <input type="text" name="full_name" class="form-control" id="InputFullName" placeholder="Enter full name" required>
                                </div>
                                <div class="form-group">
                                    <label for="InputEmail">Email address</label>
                                    <input type="email" name="email" class="form-control" id="InputEmail" placeholder="Enter email" required>
                                </div>
                                <div class="form-group">
                                    <label for="InputPassword">Password</label>
                                    <input type="password" name="password" class="form-control" id="InputPassword" placeholder="Password" required>
                                </div> -->
                                <!-- <div class="form-group">
                                    <label for="InputFile">File input</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="InputFile">
                                            <label class="custom-file-label" for="InputFile">Choose file</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="upload">Upload</span>
                                        </div>
                                    </div>
                                </div> -->
                                <!-- <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="Check1">
                                    <label class="form-check-label" for="Check1">Check me out</label>
                                </div> -->
                            <!-- </div> -->
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
        $(document).on('keyup', '#InputBatchNumber', function() {
            var year = $('#InputYear').val();
            if (year == '') {
                alert('Please select a year');
                $(this).val('');
                return false;
            }
            var batchNumber = $(this).val();
            var userId = $('#user_id').val();
            $('#InputRollNo').val(year + userId + batchNumber);
        });
        $(document).on('change', '#InputClass', function() {
            var _this = $(this);
            var classId = _this.val();
            if (classId != '') {
                var selectedOption = _this.find('option:selected');
                var classFee = selectedOption.attr('data-fee');
                $('#InputTotalFee').val(classFee);
            }
        });
        $(document).on('change', '#InputAppliedFor', function() {
            var _this = $(this);
            var appliedForId = _this.val();
            if (appliedForId != '') {
                if (appliedForId == 'written_exam') {
                    $('#InputClass').attr('disabled', false);
                    $('#InputInterview').attr('disabled', true);
                    $('#InputExam').attr('disabled', true);
                } else if (appliedForId == 'interview') {
                    // $('#InputClass').attr('disabled', true);
                    $('#InputInterview').attr('disabled', false);
                    $('#InputExam').attr('disabled', true);
                } else if (appliedForId == 'examination') {
                    // $('#InputClass').attr('disabled', true);
                    $('#InputInterview').attr('disabled', true);
                    $('#InputExam').attr('disabled', false);
                }
            }
        });
    });
</script>
@endsection