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
    
</div>
@endsection
@section('script')
<script src="{{url('public/dist/fullcalendar/index.global.js')}}"></script>
<script>
    $(document).ready(function() {
        var myEvents = new Array();
        @foreach($myTimeTable as $timeTable)
            @foreach($timeTable['dates'] as $subject)
                myEvents.push({
                    title: "Subject: {{$timeTable['subject_name']}} | ({{$subject['start_time']}} to {{$subject['end_time']}}) | Room: {{$subject['room_number']}}",
                    url: "{{url('student/class-timetable/list')}}",
                    start:  "{{$subject['date']}}",
                    end: "{{$subject['date']}}"
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