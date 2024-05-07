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
                    <h1>My Exam Schedule</h1>
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
                    @if (!empty($records))
                        @foreach ($records as $record)
                            <h3 class="card-titless font-weight-bold">Class Name: {{$record['class_name']}}</h3>
                            @if (isset($record))
                                @foreach ($record['exam'] as $exam)
                                    @if (isset($exam))
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-titless font-weight-bold">Exam Name: {{$exam['exam_name']}}</h5>
                                            </div>
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
                                                        @if (!empty($exam['subjects']))
                                                            @foreach ($exam['subjects'] as $subject)
                                                                <tr>
                                                                    <td>{{$subject['subject_name']}}</td>
                                                                    <td>{{$subject['exam_date']}}</td>
                                                                    <td>{{$subject['start_time']}}</td>
                                                                    <td>{{$subject['end_time']}}</td>
                                                                    <td>{{$subject['room_number']}}</td>
                                                                    <td>{{$subject['full_marks']}}</td>
                                                                    <td>{{$subject['passing_marks']}}</td>
                                                                </tr>
                                                            @endforeach
                                                        @else
                                                            <tr>
                                                                <td colspan="100%">No data found</td>
                                                            </tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <hr>
                                    @else
                                        No data found
                                    @endif
                                @endforeach
                            @else
                                No data found
                            @endif
                        @endforeach
                    @else
                        No data found
                    @endif
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