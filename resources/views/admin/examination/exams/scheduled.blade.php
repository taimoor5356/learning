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
                    <h1>Create Exam Schedule</h1>
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
                            <h3 class="card-title">Search Class/Subject</h3>
                        </div>
                        <div class="card-body">
                            <form action="">
                                <div class="form-group row">
                                    <div class="col-2">
                                        <label for="InputExam">Select Exam</label>
                                        <select value="{{Request::get('exam_id')}}" name="exam_id" class="form-control get-exam-id" id="InputExam">
                                            <option value="">Select Exam</option>
                                            @if (!empty($exams))
                                            @foreach ($exams as $exam)
                                                <option value="{{$exam->id}}" {{(Request::get('exam_id') == $exam->id) ? 'selected' : ''}}>{{$exam->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <label for="InputClassId">Select Class</label>
                                        <select value="{{Request::get('class_id')}}" name="class_id" class="form-control get-class-id" id="InputClassId">
                                            <option value="">Select Class</option>
                                            @if (!empty($classes))
                                            @foreach ($classes as $class)
                                                <option value="{{$class->id}}" {{(Request::get('class_id') == $class->id) ? 'selected' : ''}}>{{$class->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-2" style="margin-top: 32px;">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                        <a href="{{url('admin/class-timetable/list')}}" class="btn btn-success">Clear All</a>
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
                        <form action="{{url('admin/examinations/store-scheduled-exams')}}" method="POST">
                            @csrf()
                            <input type="hidden" name="class_id" value="{{Request::get('class_id')}}">
                            <input type="hidden" name="exam_id" value="{{Request::get('exam_id')}}">
                            <div class="card-header">
                                <h3 class="card-title">Create Exam Schedule</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                        <th>Subject Name</th>
                                        <th>Exam Date</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>Room number</th>
                                        <th>Full Marks</th>
                                        <th>Passing Marks</th>
                                    </thead>
                                    <tbody>
                                        @if (!empty($records))
                                            @php $i = 1; @endphp
                                            @foreach ($records as $record)
                                                <tr>
                                                    <td>
                                                        {{$record['subject_name']}}
                                                        <input type="hidden" value="{{$record['subject_id']}}" name="schedule[{{$i}}][subject_id]">
                                                    </td>
                                                    <td><input type="date" name="schedule[{{$i}}][exam_date]" value="{{$record['exam_date']}}" class="form-control"></td>
                                                    <td><input type="time" name="schedule[{{$i}}][start_time]" value="{{$record['start_time']}}" class="form-control"></td>
                                                    <td><input type="time" name="schedule[{{$i}}][end_time]" value="{{$record['end_time']}}" class="form-control"></td>
                                                    <td><input type="text" name="schedule[{{$i}}][room_number]" value="{{$record['room_number']}}" class="form-control"></td>
                                                    <td><input type="number" name="schedule[{{$i}}][full_marks]" value="{{$record['full_marks']}}" class="form-control"></td>
                                                    <td><input type="number" name="schedule[{{$i}}][passing_marks]" value="{{$record['passing_marks']}}" class="form-control"></td>
                                                </tr>
                                            @php $i++; @endphp
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="100%" class="text-center">No data found</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        <!-- /.card-body -->
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