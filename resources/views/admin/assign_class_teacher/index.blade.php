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
                    <h1>Assigned Class Teacher List</h1>
                </div>
                <div class="col-sm-6">
                    <div class="add-new float-sm-right">
                        <a href="{{url('admin/class-teacher/create')}}" class="btn btn-primary">Assign New Class Teacher</a>
                        <a href="{{url('admin/class-teacher/trashed')}}" class="btn btn-danger">Trashed</a>
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
                            <h3 class="card-title">Search Assigned Class Teacher</h3>
                        </div>
                        <div class="card-body">
                            <form action="">
                                <div class="form-group row">
                                    <div class="col-2">
                                        <label for="InputClassName">Class Name</label>
                                        <input type="text" value="{{Request::get('class_name')}}" name="class_name" class="form-control" id="InputClassName" placeholder="Enter class name">
                                    </div>
                                    <div class="col-2">
                                        <label for="InputTeacherName">Teacher Name</label>
                                        <input type="text" value="{{Request::get('teacher_name')}}" name="teacher_name" class="form-control" id="InputTeacherName" placeholder="Enter teacher name">
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
                                        <label for="InputToDate">From Date</label>
                                        <input type="date" value="{{Request::get('to_date')}}" name="to_date" class="form-control" id="InputToDate">
                                    </div>
                                    <div class="col-2" style="margin-top: 32px;">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                        <a href="{{url('admin/admin/list')}}" class="btn btn-success">Clear All</a>
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
                            <h3 class="card-title">Assigned Class Teacher List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Class Name</th>
                                        <th>Teacher Name</th>
                                        <th>Status</th>
                                        <th>Created By</th>
                                        <th>Created Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($records->total() > 0)
                                    @foreach ($records as $key => $record)
                                    <tr>
                                        <td>{{ ($records->currentPage() - 1) * $records->perPage() + $loop->iteration }}</td>
                                        <td>{{$record->class?->name}}</td>
                                        <td>{{$record->teacher?->name}}</td>
                                        <td class="{{($record->status == 1 ? 'text-success' : 'text-danger')}}">{{($record->status == 1 ? 'Active' : 'In Active')}}</td>
                                        <td>{{$record->user->name}}</td>
                                        <td>{{$record->created_at}}</td>
                                        <td>
                                            <a href="{{url('admin/class-teacher/edit/'.$record->id)}}" class="btn btn-primary">Edit</a>
                                            <a href="{{url('admin/class-teacher/edit-single/'.$record->id)}}" class="btn btn-info">Edit Single Row</a>
                                            <a href="{{url('admin/class-teacher/delete/'.$record->id)}}" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="100%" class="text-center">No Record Found</td>
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