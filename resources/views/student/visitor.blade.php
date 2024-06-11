@extends('layouts.visitor_app')
@section('style')
<style type="text/css">

</style>
@endsection
@section('content')
<div class="content-wrappersss">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-12 text-center">
                    <h1 style="margin-bottom: 0px;">
                        <img src="{{ url('public/images/school_images/'.systemSettings()->school_logo) }}" alt="School Logo" style="width: 75px; height: 70px; margin-right: 10px;">
                        {{ !empty(systemSettings()) ? systemSettings()->school_name: '' }}
                    </h1>
                    <p style="margin: -20px 0px 20px 70px;">{{ systemSettings()->school_description }}</p>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="contentss">
        <div class="container-fluid">
            <div class="row">
                <!-- /.col -->
                <div class="col-md-12 px-4">
                    @include('_message')
                    <!-- /.card -->
                    <!-- /.card-header -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Register for CSS & PMS Free Seminar</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" id="form" method="POST" action="{{url('student/visitor/store')}}">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-12 d-flex justify-content-end">
                                        <a href="{{ url('public/files/prospectus.pdf') }}" type="button" class="btn btn-primary text-white p-3" download="prospectus.pdf" target="_blank" id="InputDownloadProspectus">Download Prospectus</a>
                                        <span class="text-danger">{{$errors->first('name')}}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="InputClassType">Class Type <span class="text-danger">*</span></label>
                                        <select name="class_type" id="InputClassType" class="form-control" required>
                                            <option value="">Select Class Type</option>
                                            <option value="on_campus" {{ isset($record) ? ($record->class_type == 'on_campus' ? 'selected' : '') : (old('class_type') == 'on_campus' ? 'selected' : '') }}>On Campus</option>
                                            <option value="online" {{ isset($record) ? ($record->class_type == 'online' ? 'selected' : '') : (old('class_type') == 'online' ? 'selected' : '') }}>Onlie</option>
                                        </select>
                                        <span class="text-danger">{{$errors->first('class_type')}}</span>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="InputClassProgram">Select Class Program <span class="text-danger">*</span></label>
                                        <select class="form-control" id="InputClassProgram" name="class_program" required>
                                            <option value="">Select Class</option>
                                            <option value="css" {{ isset($record) ? ($record->class_program == 'css' ? 'selected' : '') : (old('class_program') == 'css' ? 'selected' : '') }}>CSS</option>
                                            <option value="pms" {{ isset($record) ? ($record->class_program == 'pms' ? 'selected' : '') : (old('class_program') == 'pms' ? 'selected' : '') }}>PMS</option>
                                            <option value="examination" {{ isset($record) ? ($record->class_program == 'examination' ? 'selected' : '') : (old('class_program') == 'examination' ? 'selected' : '') }}>Examination</option>
                                            <option value="interview" {{ isset($record) ? ($record->class_program == 'interview' ? 'selected' : '') : (old('class_program') == 'interview' ? 'selected' : '') }}>Interview</option>
                                            <option value="others" {{ isset($record) ? ($record->class_program == 'others' ? 'selected' : '') : (old('class_program') == 'others' ? 'selected' : '') }}>Others</option>
                                        </select>
                                        <span class="text-danger">{{$errors->first('class_program')}}</span>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="InputFullName">Full Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" value="{{ old('name') ?? (isset($record) ? $record->name : '') }}" class="form-control" id="InputFullName" placeholder="Enter full name" required>
                                        <span class="text-danger">{{$errors->first('name')}}</span>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="InputEmail">Email <span class="text-danger">*</span></label>
                                        <input type="email" name="email" value="{{ old('email') ?? (isset($record) ? $record->email : '') }}" class="form-control" id="InputEmail" placeholder="Enter email" required>
                                        <span class="text-danger">{{$errors->first('email')}}</span>
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="InputMobileNumber">Mobile Number <span class="text-danger">*</span></label>
                                        <input type="number" name="mobile_number" value="{{ old('mobile_number') ?? (isset($record) ? $record->mobile_number : '') }}" class="form-control" id="InputMobileNumber" placeholder="Enter mobile number" required>
                                        <span class="text-danger">{{$errors->first('mobile_number')}}</span>
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="InputGender">Gender <span class="text-danger">*</span></label>
                                        <select name="gender" id="InputGender" class="form-control" required>
                                            <option value="">Select Gender</option>
                                            <option value="male" {{ isset($record) ? ($record->gender == 'male' ? 'selected' : '') : (old('gender') == 'male' ? 'selected' : '') }}>Male</option>
                                            <option value="female" {{ isset($record) ? ($record->gender == 'female' ? 'selected' : '') : (old('gender') == 'female' ? 'selected' : '') }}>Female</option>
                                        </select>
                                        <span class="text-danger">{{$errors->first('gender')}}</span>
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="InputQualification">Qualification <span class="text-danger">*</span></label>
                                        <input type="text" value="{{ old('qualification') ?? (isset($record) ? $record->qualification : '') }}" class="form-control" id="InputQualification" placeholder="Enter qualification" name="qualification">
                                        <span class="text-danger">{{$errors->first('qualification')}}</span>
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="InputDomicile">Select Domicile <span class="text-danger">*</span></label>
                                        <select class="form-control" id="InputDomicile" name="domicile" required>
                                            <option value="">Select Domicile</option>
                                            <option value="isb" {{ isset($record) ? ($record->domicile == 'isb' ? 'selected' : '') : (old('domicile') == 'isb' ? 'selected' : '') }}>Islamabad</option>
                                            <option value="punjab" {{ isset($record) ? ($record->domicile == 'punjab' ? 'selected' : '') : (old('domicile') == 'punjab' ? 'selected' : '') }}>Punjab</option>
                                            <option value="sindh" {{ isset($record) ? ($record->domicile == 'sindh' ? 'selected' : '') : (old('domicile') == 'sindh' ? 'selected' : '') }}>Sindh</option>
                                            <option value="balochistan" {{ isset($record) ? ($record->domicile == 'balochistan' ? 'selected' : '') : (old('domicile') == 'balochistan' ? 'selected' : '') }}>Balochistan</option>
                                            <option value="kpk" {{ isset($record) ? ($record->domicile == 'kpk' ? 'selected' : '') : (old('domicile') == 'kpk' ? 'selected' : '') }}>KPK</option>
                                        </select>
                                        <span class="text-danger">{{$errors->first('class_program')}}</span>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">Save</button>
                                <a href="{{url('logout')}}" class="btn btn-primary">Goto Login</a>
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
@endsection