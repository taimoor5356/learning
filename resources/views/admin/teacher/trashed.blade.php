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
                        <a href="{{url('admin/student/list')}}" class="btn btn-primary">Students List</a>
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