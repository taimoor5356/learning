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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{$record['exam_name']}}</h3>
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
                                    @if (!empty($record['exam']))
                                    @php $i = 1; @endphp
                                    @foreach ($record['exam'] as $exam)
                                    <tr>
                                        <td>
                                            {{$exam['subject_name']}}
                                        </td>
                                        <td>{{$exam['exam_date']}}</td>
                                        <td>{{$exam['start_time']}}</td>
                                        <td>{{$exam['end_time']}}</td>
                                        <td>{{$exam['room_number']}}</td>
                                        <td>{{$exam['full_marks']}}</td>
                                        <td>{{$exam['passing_marks']}}</td>
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
                        <!-- /.card-body -->
                    </div>
                    <hr>
                    @endforeach
                    @else
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"></h3>
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
                                    <tr>
                                        <td colspan="100%" class="text-center">No data found</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
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