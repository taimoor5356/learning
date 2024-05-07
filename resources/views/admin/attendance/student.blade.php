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
                    <h1>Student Attendance</h1>
                </div>
                <!-- <div class="col-sm-6">
                    <div class="add-new float-sm-right">
                        <a href="{{url('admin/class/create')}}" class="btn btn-primary">Add New</a>
                        <a href="{{url('admin/class/trashed')}}" class="btn btn-danger">Trashed</a>
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
                            <h3 class="card-title">Search Student</h3>
                        </div>
                        <div class="card-body">
                            <form action="">
                                <div class="form-group row">
                                    <div class="col-2">
                                        <label for="InputClassId">Select Class</label>
                                        <select value="{{Request::get('class_id')}}" name="class_id" class="form-control get-class-id" id="getClass" required>
                                            <option value="">Select Class</option>
                                            @if (!empty($classes))
                                            @foreach ($classes as $class)
                                            <option value="{{$class->id}}" {{(Request::get('class_id') == $class->id) ? 'selected' : ''}}>{{$class->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <label for="InputClassId">Date</label>
                                        <input type="date" name="attendance_date" value="{{Request::get('attendance_date')}}" id="getAttendanceDate" class="form-control" required>
                                    </div>
                                    <div class="col-2" style="margin-top: 32px;">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                        <a href="{{url('admin/attendance/student-attendance')}}" class="btn btn-success">Clear All</a>
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
                            <h3 class="card-title">Student Attendance</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0" style="overflow: auto;">
                        @if(!empty(Request::get('class_id')) && Request::get('attendance_date'))
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Student Name</th>
                                        <th>Attendance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($students) && !empty($students->count()))
                                    
                                        @foreach ($students as $student)
                                        @php 
                                            $attendanceStatus = '';
                                            $getAttendance = $student->getAttendance($student->id, Request::get('class_id'), Request::get('attendance_date'))->first();
                                            if (isset($getAttendance)) {
                                                $attendanceStatus = $getAttendance->attendance_status;
                                            }
                                        @endphp
                                        <tr>
                                            <td>{{ ($students->currentPage() - 1) * $students->perPage() + $loop->iteration }}</td>
                                            <td>{{$student->name}}</td>
                                            <td>
                                                <label class="mx-2">
                                                    <input type="radio" id="{{$student->id}}" {{($attendanceStatus == '1') ? 'checked' : '' }} name="attendance_marked{{$student->id}}" class="saveAttendance" value="1"> Present
                                                </label> |
                                                <label for="" class="mx-2">
                                                    <input type="radio" id="{{$student->id}}" {{($attendanceStatus == '2') ? 'checked' : '' }} name="attendance_marked{{$student->id}}" class="saveAttendance" value="2"> Late
                                                </label> |
                                                <label for="" class="mx-2">
                                                    <input type="radio" id="{{$student->id}}" {{($attendanceStatus == '3') ? 'checked' : '' }} name="attendance_marked{{$student->id}}" class="saveAttendance" value="3"> Half Day
                                                </label> |
                                                <label for="" class="mx-2">
                                                    <input type="radio" id="{{$student->id}}" {{($attendanceStatus == '4') ? 'checked' : '' }} name="attendance_marked{{$student->id}}" class="saveAttendance" value="4"> Absent
                                                </label>
                                            </td>
                                        </tr>
                                        @endforeach

                                    @endif
                                </tbody>
                            </table>
                        @endif
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="d-flex justify-content-end">
                        {!! $students->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
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
<script>
    $(document).ready(function() {
        $(document).on('change', '.saveAttendance', function(e) {
            var studentId = $(this).attr('id');
            var attendanceStatus = $(this).val();
            var classId = $('#getClass').val();
            var attendanceDate = $('#getAttendanceDate').val();

            $.ajax({
                type: "POST",
                url: "{{url('admin/attendance/store-student-attendance')}}",
                data: {
                    _token: "{{csrf_token()}}",
                    student_id: studentId,
                    attendance_status: attendanceStatus,
                    class_id: classId,
                    attendance_date: attendanceDate,
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status == true) {
                        alert(response.msg);
                        // window.location.reload();
                    } else {
                        alert(response.msg);
                        // window.location.reload();
                    }
                }
            });
        });
    });
</script>
@endsection