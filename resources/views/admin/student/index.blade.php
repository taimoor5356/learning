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
                    <h1>Students List (Total: {{$records->total()}})</h1>
                </div>
                <div class="col-sm-6">
                    <div class="add-new float-sm-right">
                        <a href="{{url('admin/student/create')}}" class="btn btn-primary">Add New</a>
                        <a href="{{url('admin/student/trashed')}}" class="btn btn-danger">Trashed</a>
                    </div>
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
                    
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Search Student</h3>
                        </div>
                        <div class="card-body">
                            <form action="">
                                <div class="form-group row">
                                    <div class="col-2">
                                        <label for="InputFullName">Name</label>
                                        <input type="text" value="{{Request::get('name')}}" name="name" class="form-control" id="InputFullName" placeholder="Enter full name">
                                    </div>
                                    <div class="col-2">
                                        <label for="InputEmail">Email</label>
                                        <input type="text" value="{{Request::get('email')}}" name="email" class="form-control" id="InputEmail" placeholder="Enter email">
                                    </div>
                                    <div class="col-2">
                                        <label for="InputAdmissionNumber">Admission Number</label>
                                        <input type="text" value="{{Request::get('admission_number')}}" name="admission_number" class="form-control" id="InputAdmissionNumber" placeholder="Enter admission number">
                                    </div>
                                    <div class="col-2">
                                        <label for="InputRollNumber">Roll Number</label>
                                        <input type="text" value="{{Request::get('roll_number')}}" name="roll_number" class="form-control" id="InputRollNumber" placeholder="Enter roll number">
                                    </div>
                                    <div class="col-2">
                                        <label for="InputClass">Class</label>
                                        <select name="class_id" class="form-control" id="InputClass">
                                            <option value="">Select Class</option>
                                            @foreach($classes as $key => $class)
                                                <option value="{{$class->id}}" {{(Request::get('class_id') == $class->id) ? 'selected' : ''}}>{{$class->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <label for="InputGender">Gender</label>
                                        <select name="gender" id="InputGender" class="form-control">
                                            <option value="">Select Gender</option>
                                            <option value="male" {{(Request::get('gender') == 'male') ? 'selected' : ''}}>Male</option>
                                            <option value="female" {{(Request::get('gender') == 'female') ? 'selected' : ''}}>Female</option>
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <label for="InputCaste">Caste</label>
                                        <input type="text" value="{{Request::get('caste')}}" name="caste" class="form-control" id="InputCaste" placeholder="Enter caste">
                                    </div>
                                    <div class="col-2">
                                        <label for="InputReligion">Religion</label>
                                        <input type="text" value="{{Request::get('religion')}}" name="religion" class="form-control" id="InputReligion" placeholder="Enter religion">
                                    </div>
                                    <div class="col-2">
                                        <label for="InputMobile">Mobile</label>
                                        <input type="text" value="{{Request::get('mobile_number')}}" name="mobile_number" class="form-control" id="InputMobile" placeholder="Enter mobile number">
                                    </div>
                                    <div class="col-2">
                                        <label for="InputBloodGroup">Blood Group</label>
                                        <select name="blood_group" id="blood_group" class="form-control">
                                            <option value="">Select Blood Group</option>
                                            <option value="A+" {{(Request::get('blood_group') == 'A+') ? 'selected' : ''}}>A+</option>
                                            <option value="A-" {{(Request::get('blood_group') == 'A-') ? 'selected' : ''}}>A-</option>
                                            <option value="B+" {{(Request::get('blood_group') == 'B+') ? 'selected' : ''}}>B+</option>
                                            <option value="B-" {{(Request::get('blood_group') == 'B-') ? 'selected' : ''}}>B-</option>
                                            <option value="AB+" {{(Request::get('blood_group') == 'AB+') ? 'selected' : ''}}>AB+</option>
                                            <option value="AB-" {{(Request::get('blood_group') == 'AB-') ? 'selected' : ''}}>AB-</option>
                                            <option value="O+" {{(Request::get('blood_group') == 'O+') ? 'selected' : ''}}>O+</option>
                                            <option value="O-" {{(Request::get('blood_group') == 'O-') ? 'selected' : ''}}>O-</option>
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <label for="InputAdmissionDate">Admission Date</label>
                                        <input type="date" value="{{Request::get('admission_date')}}" name="admission_date" class="form-control" id="InputAdmissionDate">
                                    </div>
                                    <div class="col-2">
                                        <label for="InputStatus">Status</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="">Select Status</option>
                                            <option value="1" {{(Request::get('status') == '1') ? 'selected' : ''}}>Active</option>
                                            <option value="10" {{(Request::get('status') == '10') ? 'selected' : ''}}>Inactive</option>
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <label for="InputFromDate">From Date</label>
                                        <input type="date" value="{{Request::get('from_date')}}" name="from_date" class="form-control" id="InputFromDate">
                                    </div>
                                    <div class="col-2">
                                        <label for="InputToDate">To Date</label>
                                        <input type="date" value="{{Request::get('to_date')}}" name="to_date" class="form-control" id="InputToDate">
                                    </div>
                                    <div class="col-2" style="margin-top: 32px;">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                        <a href="{{url('admin/student/list')}}" class="btn btn-success">Clear All</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Students List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0" style="overflow: auto;">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Profile Pic</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Admission No</th>
                                        <th>Roll No</th>
                                        <th>Class</th>
                                        <th>Gender</th>
                                        <th>DOB</th>
                                        <th>Caste</th>
                                        <th>Religion</th>
                                        <th>Mobile</th>
                                        <th>Admission Date</th>
                                        <th>Blood Group</th>
                                        <th>Height</th>
                                        <th>Weight</th>
                                        <th>Status</th>
                                        <th>Created Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($records->total() > 0)
                                    @foreach ($records as $key => $record)
                                    <tr>
                                        <td>{{ ($records->currentPage() - 1) * $records->perPage() + $loop->iteration }}</td>
                                        <td><img src="{{$record->getProfilePic()}}" height="50px" width="50px" class="rounded-circle" alt=""></td>
                                        <td class="text-capitalize">{{$record->name}}</td>
                                        <td>{{$record->email}}</td>
                                        <td class="text-capitalize">{{$record->admission_number}}</td>
                                        <td class="text-capitalize">{{$record->roll_number}}</td>
                                        <td class="text-capitalize">{{$record->class?->name}}</td>
                                        <td class="text-capitalize">{{$record->gender}}</td>
                                        <td>{{$record->date_of_birth}}</td>
                                        <td class="text-capitalize">{{$record->caste}}</td>
                                        <td class="text-capitalize">{{$record->religion}}</td>
                                        <td>{{$record->mobile_number}}</td>
                                        <td>{{$record->admission_date}}</td>
                                        <td class="text-capitalize">{{$record->blood_group}}</td>
                                        <td>{{$record->height}}</td>
                                        <td>{{$record->weight}}</td>
                                        <td class="text-capitalize {{($record->status == 1) ? 'text-success' : 'text-danger'}}">{{($record->status == 1) ? 'Active' : 'In Active'}}</td>
                                        <td>{{$record->created_at}}</td>
                                        <td style="min-width: 200px;">
                                            <a href="{{url('admin/student/edit/'.$record->id)}}" class="btn btn-primary">Edit</a>
                                            <a href="{{url('admin/student/delete/'.$record->id)}}" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="100%" class="text-center">No Records Found</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="d-flex justify-content-end">
                        {!! $records->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                    </div>
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