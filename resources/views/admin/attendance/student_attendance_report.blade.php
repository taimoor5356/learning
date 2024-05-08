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
                                        <label for="InputAttendanceName">Student Name</label>
                                        <input type="text" name="student_name" id="InputAttendanceName" class="form-control" value="{{Request::get('student_name')}}" placeholder="Enter student name">
                                    </div>
                                    <div class="col-2">
                                        <label for="InputStudentRollNumber">Student Roll Number</label>
                                        <input type="text" name="roll_number" id="InputStudentRollNumber" class="form-control" value="{{Request::get('roll_number')}}" placeholder="Enter student roll number">
                                    </div>
                                    <div class="col-2">
                                        <label for="InputClassId">Select Class</label>
                                        <select name="class_id" class="form-control" id="InputClassId">
                                            <option value="">Select Class</option>
                                            @foreach($classes as $key => $class)
                                                <option {{Request::get('class_id') == $class->id ? 'selected' : ''}} value="{{$class->id}}" {{ isset($record) && ($class->id == $record->class_id) ? 'selected' : '' }}>{{$class->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <label for="InputAttendanceDate">Select Attendance Date</label>
                                        <input type="date" name="attendance_date" id="InputAttendanceDate" class="form-control" value="{{Request::get('attendance_date')}}">
                                    </div>
                                    <div class="col-2">
                                        <label for="InputAttendanceType">Select Attendance Type</label>
                                        <select name="attendance_status" class="form-control" id="InputAttendanceType">
                                            <option value="">Select Attendance Type</option>
                                            <option {{(Request::get('attendance_status') == '1') ? 'selected' : ''}} value="1">Present</option>
                                            <option {{(Request::get('attendance_status') == '2') ? 'selected' : ''}} value="2">Late</option>
                                            <option {{(Request::get('attendance_status') == '3') ? 'selected' : ''}} value="3">Half Day</option>
                                            <option {{(Request::get('attendance_status') == '4') ? 'selected' : ''}} value="4">Absent</option>
                                        </select>
                                    </div>
                                    <div class="col-2" style="margin-top: 32px;">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                        <a href="{{url('admin/attendance/student-attendance-report')}}" class="btn btn-success">Clear All</a>
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
                            <h3 class="card-title">Attendance List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0" style="overflow: auto;">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Student Name</th>
                                        <th>Roll No</th>
                                        <th>Class</th>
                                        <th>Attendance Status</th>
                                        <th>Marked By</th>
                                        <th>Attendance Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($records)
                                    @foreach ($records as $key => $record)
                                    <tr>
                                        <td>{{ ($records->currentPage() - 1) * $records->perPage() + $loop->iteration }}</td>
                                        <td class="text-capitalize">{{$record->studentTeacherUser?->name}}</td>
                                        <td class="text-capitalize">{{$record->studentTeacherUser?->roll_number}}</td>
                                        <td class="text-capitalize">{{$record->class?->name}}</td>
                                        <td class="text-capitalize">
                                            {{$record->attendance_status == 1 ? 'Present' : ''}}
                                            {{$record->attendance_status == 2 ? 'Late' : ''}}
                                            {{$record->attendance_status == 3 ? 'Half Day' : ''}}
                                            {{$record->attendance_status == 4 ? 'Absent' : ''}}
                                        </td>
                                        <td class="text-capitalize">{{$record->user?->name}}</td>
                                        <td class="text-capitalize">{{$record->attendance_date}}</td>
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