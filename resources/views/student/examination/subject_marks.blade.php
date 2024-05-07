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
                    <h1>Subject Results/Marks</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @foreach ($records as $record)
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header row">
                            <div class="col-md-6">
                                <h3 class="card-title">{{$record['exam_name']}}</h3>
                            </div>
                            <div class="col-sm-6">
                                <div class="add-new float-sm-right">
                                    <a target="_blank" href="{{url('student/examinations/print?exam_id='.$record['exam_id'].'&student_id='.Auth::user()->id)}}" class="btn btn-sm btn-primary">Print</a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0" style="overflow: auto;">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>Subject Name</th>
                                        <th>Class work</th>
                                        <th>Home work</th>
                                        <th>Test work</th>
                                        <th>Exam work</th>
                                        <th>Full marks</th>
                                        <th>Passing marks</th>
                                        <th>Obtained marks</th>
                                        <th>Result</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($record['subjects'] as $subject)
                                        <tr>
                                            <td>{{$subject['subject_name']}}</td>
                                            <td>{{$subject['class_work']}}</td>
                                            <td>{{$subject['home_work']}}</td>
                                            <td>{{$subject['test_work']}}</td>
                                            <td>{{$subject['exam_work']}}</td>
                                            <td>{{$subject['full_marks']}}</td>
                                            <td>{{$subject['passing_marks']}}</td>
                                            <td>
                                                @php 
                                                    $totalObtainedMarks = $subject['class_work'] + $subject['home_work'] + $subject['test_work'] + $subject['exam_work'];
                                                @endphp
                                                {{$totalObtainedMarks}}
                                            </td>
                                            <td>
                                                @if ($totalObtainedMarks >= $subject['passing_marks'])
                                                 <span class="badge badge-success p-2 text-md">PASS</span>
                                                @else
                                                 <span class="badge badge-danger p-2 text-md">FAIL</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                @endforeach
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $(document).on('submit', '.submitForm', function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "{{url('admin/examinations/subject-marks')}}",
                data: $(this).serialize(),
                success: function(response) {
                    if (response.status == true) {
                        alert(response.msg);
                        window.location.reload();
                    } else {
                        alert(response.msg);
                        window.location.reload();
                    }
                }
            });
        });
        $(document).on('click', '.save-single-subject-marks', function(e) {
            var studentId = $(this).attr('id');
            var subjectId = $(this).attr('data-val');
            var examId = $(this).attr('data-exam');
            var classId = $(this).attr('data-class');
            var scheduleId = $(this).attr('data-schedule');

            var classWork = $('#class_work_' + studentId + subjectId).val();
            var homeWork = $('#home_work_' + studentId + subjectId).val();
            var testWork = $('#test_work_' + studentId + subjectId).val();
            var examWork = $('#exam_work_' + studentId + subjectId).val();

            $.ajax({
                type: "POST",
                url: "{{url('admin/examinations/store-single-subject-marks')}}",
                data: {
                    _token: "{{csrf_token()}}",
                    schedule_id: scheduleId,
                    student_id: studentId,
                    subject_id: subjectId,
                    exam_id: examId,
                    class_id: classId,
                    //
                    class_work: classWork,
                    home_work: homeWork,
                    test_work: testWork,
                    exam_work: examWork,
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status == true) {
                        alert(response.msg);
                        window.location.reload();
                    } else {
                        alert(response.msg);
                        window.location.reload();
                    }
                }
            });
        });
    });
</script>
@endsection