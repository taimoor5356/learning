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
                    <h1>My Class/Subject Timetable</h1>
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
                                <h5 class="card-titless font-weight-bold">{{$className}} - {{$subjectName}}</h5>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <th>Date</th>
                                        <th>Start time</th>
                                        <th>End time</th>
                                        <th>Room number</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($records as $weekDay)
                                            <tr>
                                                <td>{{$weekDay['date']}}</td>
                                                <td>{{!empty($weekDay['start_time']) ? \Carbon\Carbon::parse($weekDay['start_time'])->format('h:i a') : 'No class'}}</td>
                                                <td>{{!empty($weekDay['end_time']) ? \Carbon\Carbon::parse($weekDay['end_time'])->format('h:i a') : 'No class'}}</td>
                                                <td>{{!empty($weekDay['room_number']) ? $weekDay['room_number'] : 'No class'}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
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