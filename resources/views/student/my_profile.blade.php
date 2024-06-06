@extends('layouts.app')
@section('style')
<style type="text/css">

</style>
@endsection
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="@isset($record){{$record->getProfilePic()}}@else{{url('public/images/avatar.png')}}@endisset" alt="User profile picture">
                            </div>
                            <hr>
                            <h3 class="profile-username font-weight-bold text-center">{{ old('name') ?? (isset($record) ? $record->name : '') }}</h3>

                            <p class="text-muted text-center">{{ old('name') ?? (isset($record) ? $record->work_experience : '') }}</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Email</b> <a class="float-right">{{ old('name') ?? (isset($record) ? $record->email : '') }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Date of Birth</b> <a class="float-right">{{ old('name') ?? (isset($record) ? $record->date_of_birth : '') }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>CNIC</b> <a class="float-right">{{ old('name') ?? (isset($record) ? $record->cnic : '') }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Domicile</b> <a class="float-right">{{ old('name') ?? (isset($record) ? $record->domicile : '') }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Roll Number</b> <a class="float-right">{{ old('name') ?? (isset($record) ? $record->roll_number : '') }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Admission Date</b> <a class="float-right">{{ old('name') ?? (isset($record) ? $record->admission_date : '') }}</a>
                                </li>
                            </ul>

                            <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-md-8">
                    <div class="card card-primary card-outline">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#personal-info" data-toggle="tab">Personal Info</a></li>
                                <li class="nav-item"><a class="nav-link" href="#academic-info" data-toggle="tab">Academic Info</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="personal-info">
                                    <form class="form-horizontal">
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-4 col-form-label">Father Name</label>
                                            <div class="col-sm-8" style="margin: 5px 0px;">
                                                <span>{{isset($record) ? $record->father_name : ''}}</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-4 col-form-label">Father Occupation</label>
                                            <div class="col-sm-8" style="margin: 5px 0px;">
                                                <span>{{isset($record) ? $record->father_occupation : ''}}</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-4 col-form-label">Gender</label>
                                            <div class="col-sm-8" style="margin: 5px 0px;">
                                                <span>{{isset($record) ? $record->gender : ''}}</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName2" class="col-sm-4 col-form-label">Current Address</label>
                                            <div class="col-sm-8" style="margin: 5px 0px;">
                                                <span>{{isset($record) ? $record->current_address : ''}}</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputExperience" class="col-sm-4 col-form-label">Permanent Addres</label>
                                            <div class="col-sm-8" style="margin: 5px 0px;">
                                                <span>{{isset($record) ? $record->permanent_address : ''}}</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputSkills" class="col-sm-4 col-form-label">Mobile Number</label>
                                            <div class="col-sm-8" style="margin: 5px 0px;">
                                                <span>{{isset($record) ? $record->mobile_number : ''}}</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputSkills" class="col-sm-4 col-form-label">WhatsApp Number</label>
                                            <div class="col-sm-8" style="margin: 5px 0px;">
                                                <span>{{isset($record) ? $record->whatsapp_number : ''}}</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputSkills" class="col-sm-4 col-form-label">Emergency Contact Number</label>
                                            <div class="col-sm-8" style="margin: 5px 0px;">
                                                <span>{{isset($record) ? $record->emergency_contact_number : ''}}</span>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="academic-info">
                                    <form class="form-horizontal">
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-4 col-form-label">Class Year</label>
                                            <div class="col-sm-8" style="margin: 5px 0px;">
                                                <span>{{isset($record) ? $record->class_year : ''}}</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-4 col-form-label">Subject Type</label>
                                            <div class="col-sm-8" style="margin: 5px 0px;">
                                                <span>{{isset($record) ? $record->subject_type : ''}}</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName2" class="col-sm-4 col-form-label">Class Program</label>
                                            <div class="col-sm-8" style="margin: 5px 0px;">
                                                <span>{{isset($record) ? $record->class_program : ''}}</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputExperience" class="col-sm-4 col-form-label">Batch Starting Date</label>
                                            <div class="col-sm-8" style="margin: 5px 0px;">
                                                <span>{{isset($record) ? $record->batch_starting_date : ''}}</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputSkills" class="col-sm-4 col-form-label">Batch number</label>
                                            <div class="col-sm-8" style="margin: 5px 0px;">
                                                <span>{{isset($record) ? $record->batch?->name : ''}}</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputSkills" class="col-sm-4 col-form-label">Applied For</label>
                                            <div class="col-sm-8" style="margin: 5px 0px;">
                                                <span>{{isset($record) ? $record->applied_for : ''}}</span>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="px-2 card card-primary card-outline">
                        <h4 class="py-3">Qualification</h4>
                        <div class="table-responsive">
                        <table class="table table-bordered rounded" style="overflow: auto;">
                            <thead class="bg-light">
                                <th>Degree/Certificate</th>
                                <th>Major Subjects</th>
                                <th>Percentage/CGPA</th>
                                <th>Institute</th>
                            </thead>
                            @php ($qualifications = json_decode($record->qualification))
                            <tbody>
                                @foreach ($qualifications as $qualification)
                                <tr>
                                    <td class="">@if(!empty($qualification->degree)){{$qualification->degree}}@endif</td>
                                    <td class="">@if(!empty($qualification->major_subjects)){{$qualification->major_subjects}}@endif</td>
                                    <td class="">@if(!empty($qualification->cgpa)){{$qualification->cgpa}}@endif</td>
                                    <td class="">@if(!empty($qualification->university_name)){{$qualification->university_name}}@endif</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
@section('script')

@endsection