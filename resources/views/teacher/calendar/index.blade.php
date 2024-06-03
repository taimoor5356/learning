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
    <!-- /.content -->
</div>
@endsection
@section('script')
<script src="{{url('public/dist/fullcalendar/index.global.js')}}"></script>
<script>
    $(document).ready(function() {
        var myEvents = new Array();
        @foreach ($teacherClassTimeTable as $timeTable)
            myEvents.push({
                title: "Batch Number: {{$timeTable->class_name}} - {{$timeTable->subject_name}}",
                daysOfWeek: "{{$timeTable->fullcalendar_day}}",
                startTime: "{{$timeTable->start_time}}",
                endTime: "{{$timeTable->end_time}}",
            });
        @endforeach
        @foreach($teacherExamClassTimeTable as $exam)
            myEvents.push({
                title: "Exam: {{$exam['exam_name']}} | {{$exam['subject_name']}} ({{$exam['start_time']}} to {{$exam['end_time']}})",
                start:  "{{$exam['exam_date']}}",
                end: "{{$exam['exam_date']}}",
                color: '#dc3545',
                textColor: 'white',
                url: "{{url('student/examinations/scheduled-exams')}}"
            });
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