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
                    <h1>My Timetable</h1>
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
                    <div class="card">
                            <div class="card-header">
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <th>Subject</th>
                                        <th>Date</th>
                                        <th>Start time</th>
                                        <th>End time</th>
                                        <th>Room number</th>
                                    </thead>
                                    <tbody>
                                    @foreach ($records as $record)
                                        <tr>
                                            <td>
                                                {{$record['subject_name']}}
                                            </td>
                                            <td>{{$record['date']}}</td>
                                            <td>{{!empty($record['start_time']) ? \Carbon\Carbon::parse($record['start_time'])->format('h:i a') : 'No class'}}</td>
                                            <td>{{!empty($record['end_time']) ? \Carbon\Carbon::parse($record['end_time'])->format('h:i a') : 'No class'}}</td>
                                            <td>{{!empty($record['room_number']) ? $record['room_number'] : 'No class'}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        <!-- /.card-body -->
                    </div>
                    <hr>
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
        $(document).on('change', '.get-class-id', function() {
            var classId = $(this).val();
            if (classId != '') {
                $.ajax({
                    url: "{{url('admin/class-timetable/subjects')}}",
                    type: "POST",
                    data: {
                        _token: "{{csrf_token()}}",
                        class_id: classId
                    },
                    dataType: 'json',
                    success: function(response) {
                        $('.get-subjects').html(response);
                        // var classSubjects = response.classSubjects;
                        // var _html = '<option value="">Select Subject</option>';
                        // classSubjects.forEach(function (subject) {
                        //     _html += '<option value="' + subject.subject_id + '">' + subject.subject.name + '</option>';
                        // });
                        // $('.get-subjects').html(_html);
                    }
                });
            } else {
                $('.get-subjects').html('<option value="">Select Subject</option>');
            }
        });
    });
</script>
@endsection