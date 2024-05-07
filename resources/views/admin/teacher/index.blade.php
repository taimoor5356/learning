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
                    <h1>Teachers List (Total: {{$records->total()}})</h1>
                </div>
                <div class="col-sm-6">
                    <div class="add-new float-sm-right">
                        <a href="{{url('admin/teacher/create')}}" class="btn btn-primary">Add New</a>
                        <a href="{{url('admin/teacher/trashed')}}" class="btn btn-danger">Trashed</a>
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
                            <h3 class="card-title">Search Teacher</h3>
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
                                        <label for="InputGender">Gender</label>
                                        <select name="gender" id="InputGender" class="form-control">
                                            <option value="">Select Gender</option>
                                            <option value="male" {{(Request::get('gender') == 'male') ? 'selected' : ''}}>Male</option>
                                            <option value="female" {{(Request::get('gender') == 'female') ? 'selected' : ''}}>Female</option>
                                        </select>
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
                                        <label for="InputAdmissionDate">Joining Date</label>
                                        <input type="date" value="{{Request::get('admission_date')}}" name="admission_date" class="form-control" id="InputAdmissionDate">
                                    </div>
                                    <div class="col-2">
                                        <label for="InputMaritalStatus">Marital Status</label>
                                        <select name="marital_status" id="InputMaritalStatus" class="form-control">
                                            <option value="">Select Marital Status</option>
                                            <option value="married" {{(Request::get('status') == 'married') ? 'selected' : ''}}>Married</option>
                                            <option value="un_married" {{(Request::get('status') == 'un_married') ? 'selected' : ''}}>Un Married</option>
                                        </select>
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
                                        <a href="{{url('admin/teacher/list')}}" class="btn btn-success">Clear All</a>
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
                            <h3 class="card-title">Teachers List</h3>
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
                                        <th>Gender</th>
                                        <th>DOB</th>
                                        <th>Mobile</th>
                                        <th>Joining Date</th>
                                        <th>Blood Group</th>
                                        <th>Current Address</th>
                                        <th>Permanent Address</th>
                                        <th>Marital Status</th>
                                        <th>Qualification</th>
                                        <th>Work Experience</th>
                                        <th>Note</th>
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
                                        <td class="text-capitalize">{{$record->gender}}</td>
                                        <td class="text-capitalize">{{$record->date_of_birth}}</td>
                                        <td class="text-capitalize">{{$record->mobile_number}}</td>
                                        <td class="text-capitalize">{{$record->admission_date}}</td>
                                        <td class="text-capitalize">{{$record->blood_group}}</td>
                                        <td class="text-capitalize">{{$record->current_address}}</td>
                                        <td class="text-capitalize">{{$record->permanent_address}}</td>
                                        <td class="text-capitalize">{{$record->marital_status}}</td>
                                        <td class="text-capitalize">{{$record->qualification}}</td>
                                        <td class="text-capitalize">{{$record->work_experience}}</td>
                                        <td class="text-capitalize">{{$record->note}}</td>
                                        <td class="text-capitalize {{($record->status == 1) ? 'text-success' : 'text-danger'}}">{{($record->status == 1) ? 'Active' : 'In Active'}}</td>
                                        <td>{{$record->created_at}}</td>
                                        <td style="min-width: 200px;">
                                            <a href="{{url('admin/teacher/edit/'.$record->id)}}" class="btn btn-primary">Edit</a>
                                            <a href="{{url('admin/teacher/delete/'.$record->id)}}" class="btn btn-danger">Delete</a>
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