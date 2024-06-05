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
                    <h1>My Profile Information</h1>
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
                            <h3 class="card-title">My Profile Information</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <img src="@isset($record){{$record->getProfilePic()}}@else{{url('public/images/avatar.png')}}@endisset" class="img-circle elevation-2" width="15%" alt="User Image">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="card-body text-center">
                                        <div class="row">
                                            <div class="text-capitalize font-weight-bold d-flex text-start">
                                                Full Name:&nbsp;&nbsp; @isset($record){{$record->name}}@else @endisset
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="card-body text-center">
                                        <div class="row">
                                            <div class="text-capitalize font-weight-bold d-flex text-start">
                                                Roll Number:&nbsp;&nbsp; @isset($record){{$record->roll_number}}@else @endisset
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="card-body text-center">
                                        <div class="row">
                                            <div class="text-capitalize font-weight-bold d-flex text-start">
                                                Date of Birth:&nbsp;&nbsp; @isset($record){{$record->date_of_birth}}@else @endisset
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="card-body text-center">
                                        <div class="row">
                                            <div class="text-capitalize font-weight-bold d-flex text-start">
                                                Gender:&nbsp;&nbsp; @isset($record){{$record->gender}}@else @endisset
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="card-body text-center">
                                        <div class="row">
                                            <div class="text-capitalize font-weight-bold d-flex text-start">
                                                CNIC:&nbsp;&nbsp; @isset($record){{$record->cnic}}@else @endisset
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="card-body text-center">
                                        <div class="row">
                                            <div class="text-capitalize font-weight-bold d-flex text-start">
                                                Marital Status:&nbsp;&nbsp; @isset($record){{$record->marital_status}}@else @endisset
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="card-body text-center">
                                        <div class="row">
                                            <div class="text-capitalize font-weight-bold d-flex text-start">
                                                Permanent Address:&nbsp;&nbsp; @isset($record){{$record->permanent_address}}@else @endisset
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="card-body text-center">
                                        <div class="row">
                                            <div class="text-lowecase font-weight-bold d-flex text-start">
                                                Email:&nbsp;&nbsp; @isset($record){{$record->email}}@else @endisset
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="card-body text-center">
                                        <div class="row">
                                            <div class="text-capitalize font-weight-bold d-flex text-start">
                                                Domicile:&nbsp;&nbsp; @isset($record){{$record->domicile}}@else @endisset
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="card-body text-center">
                                        <div class="row">
                                            <div class="text-capitalize font-weight-bold d-flex text-start">
                                                Gender:&nbsp;&nbsp; @isset($record){{$record->gender}}@else @endisset
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="card-body text-center">
                                        <div class="row">
                                            <div class="text-capitalize font-weight-bold d-flex text-start">
                                                Current Address:&nbsp;&nbsp; @isset($record){{$record->current_address}}@else @endisset
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="card-body text-center">
                                        <div class="row">
                                            <div class="text-capitalize font-weight-bold d-flex text-start">
                                                Profession/Work Experience:&nbsp;&nbsp; @isset($record){{$record->work_experience}}@else @endisset
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="card-body text-center">
                                        <div class="row">
                                            <div class="text-capitalize font-weight-bold d-flex text-start">
                                                Father Name:&nbsp;&nbsp; @isset($record){{$record->father_name}}@else @endisset
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="card-body text-center">
                                        <div class="row">
                                            <div class="text-capitalize font-weight-bold d-flex text-start">
                                                Father Occupation:&nbsp;&nbsp; @isset($record){{$record->father_occupation}}@else @endisset
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="card-body text-center">
                                        <div class="row">
                                            <div class="text-capitalize font-weight-bold d-flex text-start">
                                                WhatsApp Number:&nbsp;&nbsp; @isset($record){{$record->whatsapp_number}}@else @endisset
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="card-body text-center">
                                        <div class="row">
                                            <div class="text-capitalize font-weight-bold d-flex text-start">
                                                Mobile Number:&nbsp;&nbsp; @isset($record){{$record->mobile_number}}@else @endisset
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="card-body text-center">
                                        <div class="row">
                                            <div class="text-capitalize font-weight-bold d-flex text-start">
                                                Emergency Contact Number:&nbsp;&nbsp; @isset($record){{$record->emergency_contact_number}}@else @endisset
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <hr>
                        <div class="row p-2">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                <span class="font-weight-bold">Qualification:</span>
                                <br>
                                @php ($qualifications = json_decode($record->qualification))
                                <table class="table table-bordered">
                                    <thead class="bg-primary">
                                        <th>Degree</th>
                                        <th>Major Subjects</th>
                                        <th>CGPA/Percentage</th>
                                        <th>Institute</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($qualifications as $qualification)
                                        <tr>
                                            <td class="font-weight-bold">@if(!empty($qualification->degree)){{$qualification->degree}}@endif</td>
                                            <td class="font-weight-bold">@if(!empty($qualification->major_subjects)){{$qualification->major_subjects}}@endif</td>
                                            <td class="font-weight-bold">@if(!empty($qualification->cgpa)){{$qualification->cgpa}}@endif</td>
                                            <td class="font-weight-bold">@if(!empty($qualification->university_name)){{$qualification->university_name}}@endif</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        </div>
                    </div>
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

</script>
@endsection