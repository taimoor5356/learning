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
                    <h1>My Class Subject List (Total: {{$records->total()}})</h1>
                </div>
                <!-- <div class="col-sm-6">
                    <div class="add-new float-sm-right">
                        <a href="{{url('teacher/subject/create')}}" class="btn btn-primary">Add New</a>
                        <a href="{{url('teacher/subject/trashed')}}" class="btn btn-danger">Trashed</a>
                    </div>
                </div> -->
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
                            <h3 class="card-title">Search Subject</h3>
                        </div>
                        <div class="card-body">
                            <form action="">
                                <div class="form-group row">
                                    <div class="col-2">
                                        <label for="InputName">Name</label>
                                        <input type="text" value="{{Request::get('name')}}" name="name" class="form-control" id="InputName" placeholder="Enter subject name">
                                    </div>
                                    <!-- <div class="col-2">
                                        <label for="InputStatus">Status</label>
                                        <select value="{{Request::get('status')}}" name="status" class="form-control" id="InputStatus">
                                            <option value="1">Active</option>
                                            <option value="0">In Active</option>
                                        </select>
                                    </div> -->
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
                                        <a href="{{url('teacher/subject/list')}}" class="btn btn-success">Clear All</a>
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
                            <h3 class="card-title">My Class Subject List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Batch Number</th>
                                        <th>Subject Name</th>
                                        <th>Subject Type</th>
                                        <th>Today Class Timings</th>
                                        <th>Created Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($records->total() > 0)
                                    @foreach ($records as $key => $record)
                                    <tr>
                                        <td>{{ ($records->currentPage() - 1) * $records->perPage() + $loop->iteration }}</td>
                                        <td class="text-capitalize">{{$record->batch?->name}}</td>
                                        <td class="text-capitalize">{{$record->subject?->name}}</td>
                                        <td class="text-capitalize">{{$record->subject?->type}}</td>
                                        <td>
                                            @if(!is_null($record->getMyClassSubjectTimings($record->batch_id, $record->subject_id)))
                                                {{\Carbon\Carbon::parse($record->getMyClassSubjectTimings($record->batch_id, $record->subject_id)->start_time)->format('h:i a')}} - {{\Carbon\Carbon::parse($record->getMyClassSubjectTimings($record->batch_id, $record->subject_id)->end_time)->format('h:i a')}} 
                                                <br>
                                                Room No: {{$record->getMyClassSubjectTimings($record->batch_id, $record->subject_id)->room_number}}
                                            @else 
                                                No class 
                                            @endif
                                        </td>
                                        <td class="text-capitalize">{{($record->created_at)}}</td>
                                        <td>
                                            <a href="{{url('teacher/subject/class-timetable/'.$record->batch_id.'/'.$record->subject_id)}}" class="btn btn-primary">My Timetable</a>
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