@extends('layouts.app')
@section('style')
<link rel="stylesheet" href="{{url('public/plugins/select2/css/select2.min.css')}}">
<style type="text/css">
    .select2-container .select2-selection--single {
        display: block;
        width: 100%;
        height: calc(2.25rem + 2px);
        padding: .375rem .75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: .25rem;
        box-shadow: inset 0 0 0 transparent;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        color: black !important;
        border: 1px solid #ced4da;
    }

    .select2-container--default .select2-selection--multiple,
    .select2-container--default .select2-selection--multiple:focus {
        border: 1px solid #ced4da;
    }
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

<script src="{{url('public/plugins/select2/js/select2.full.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: 'Select Subjects',
            allowClear: true
        });
        $(document).on('change', '#InputSubjectType', function() {
            var _this = $(this);
            var subjectType = _this.val();
            if (subjectType != '') {
                // if (subjectType == 'english_essay_and_precis') {

                // } else if (subjectType == 'compulsory_only') {

                // } else if (subjectType == 'all') {

                // } else if (subjectType == 'custom') {

                // }
                $.ajax({
                    url: "{{url('admin/student/select-subject-types')}}",
                    method: "POST",
                    data: {
                        _token: "{{csrf_token()}}",
                        subject_type: subjectType
                    },
                    success: function(response) {
                        var subjects = response.subjects;
                        var _html = '';
                        subjects.forEach(element => {
                            _html += `<option value="${element.id}" data-fees="${element.fees}">${element.name} (${element.fees})</option>`;
                        });
                        $('#InputSubject').html(_html);
                        $('.select2').select2({
                            placeholder: 'Select Subjects',
                            allowClear: true
                        });
                    }
                });
            }
        });
        $(document).on('change', '#InputSubject', function() {
            var _this = $(this);
            var selectedOptions = _this.find('option:selected');
            var feesArray = [];
            var totalFees = 0;
            selectedOptions.each(function() {
                var fees = $(this).data('fees'); // Use .data() method to get data-fees attribute
                totalFees = totalFees + fees;
            });
            $('#InputTotalFee').val(totalFees);
        });
        $(document).on('change', '#InputBatchNumber', function() {
            var year = $('#InputYear').val();
            if (year == '') {
                alert('Please select a year');
                $(this).val('');
                return false;
            }
            var batchNumber = $(this).find('option:selected').text();
            var userId = $('#user_id').val();
            $('#InputRollNo').val(year + userId + batchNumber);
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
        $(document).on('keyup', '#InputDiscountedAmount', function () {
            var _this = $(this);
            var discountedAmount = _this.val();
            var totalFee = $('#InputTotalFee').val();
            var totalAfterDiscount = Number(totalFee) - Number(discountedAmount);
            $('#InputAmountToBePaid').val(totalAfterDiscount);
        });
    });
</script>
@endsection