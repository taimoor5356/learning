@extends('layouts.app')
@section('style')
<style type="text/css">
    .fc-daygrid-event {
        white-space: normal;
    }
</style>
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>My Calendar</h1>
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
                <div class="col-md-12">
                    @include('_message')
                    <div class="card">
                        <div class="card-body">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
@section('script')
<script src="{{url('public/dist/fullcalendar/index.global.js')}}"></script>
<script>
    $(document).ready(function() {
        var myEvents = new Array();
        @foreach($myTimeTable as $timeTable)
            @foreach($timeTable['week_days'] as $day)
                myEvents.push({
                    title: "Subject: {{$timeTable['subject_name']}}",
                    daysOfWeek:[{{$day['fullcalendar_day']}}],
                    startTime: "{{$day['start_time']}}",
                    endTime: "{{$day['end_time']}}",
                    url: "{{url('student/class-timetable/list')}}"
                });
            @endforeach
        @endforeach
        @foreach($myExamTimeTable as $examTimeTable)
            @foreach($examTimeTable['exam'] as $exam)
                myEvents.push({
                    title: "Exam: {{$examTimeTable['exam_name']}} | {{$exam['subject_name']}} ({{$exam['start_time']}} to {{$exam['end_time']}})",
                    start:  "{{$exam['exam_date']}}",
                    end: "{{$exam['exam_date']}}",
                    color: '#dc3545',
                    textColor: 'white',
                    url: "{{url('student/examinations/scheduled-exams')}}"
                });
            @endforeach
        @endforeach
        var calendarId = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarId, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay, listMonth'
            },
            initialDate: '<?= date('Y-m-d') ?>',
            navLinks: true, // can click day/week names to navigate views
            editable: false,
            events: myEvents,
        });
        calendar.render();
    });
</script>
@endsection