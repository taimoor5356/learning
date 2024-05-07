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
                            <h3 class="card-title">Search</h3>
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
                                            <option value="{{$exam->exam?->id}}" {{(Request::get('exam_id') == $exam->exam?->id) ? 'selected' : ''}}>{{$exam->exam?->name}}</option>
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
                                            <option value="{{$class->class?->id}}" {{(Request::get('class_id') == $class->class?->id) ? 'selected' : ''}}>{{$class->class?->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-2" style="margin-top: 32px;">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                        <a href="{{url('teacher/examinations/subject-marks')}}" class="btn btn-success">Clear All</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                        </div>
                        <!-- /.card-body -->
                    </div>
                    @if (!empty($subjects) && !empty($subjects->count()))
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Subject Results/Marks</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0" style="overflow: auto;">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>Student Name</th>
                                        @if (!is_null($subjects))
                                        @foreach ($subjects as $subject)
                                        <th>
                                            {{$subject->subject?->name}}
                                            <br>
                                            (<span class="text-capitalize">{{$subject->subject?->type}}</span>: {{$subject->passing_marks}} / {{$subject->full_marks}})
                                        </th>
                                        @endforeach
                                        @endif
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($students) && !empty($students->count()))
                                    @foreach ($students as $student)
                                    <form method="post" class="submitForm">
                                        @csrf()
                                        <input type="hidden" name="student_id" value="{{$student->id}}">
                                        <input type="hidden" name="class_id" value="{{Request::get('class_id')}}">
                                        <input type="hidden" name="exam_id" value="{{Request::get('exam_id')}}">
                                        <tr>
                                            <td style="min-width: 350px;">
                                                <h5 class="font-weight-bold">{{$student->name}}</h5>
                                            </td>
                                            @php 
                                                $i = 1; 
                                                $studentTotalObtained = 0;    
                                                $allTotalSubjectFullMarks = 0;    
                                                $totalPassingMarks = 0;    
                                                $passOrFail = 0;    
                                            @endphp
                                            @foreach ($subjects as $subject)
                                            @php 
                                                $totalStudentMarks = 0;
                                                $allTotalSubjectFullMarks = $allTotalSubjectFullMarks + $subject->full_marks;
                                                $totalPassingMarks = $totalPassingMarks + $subject->passing_marks;
                                                $getStudentMarks = $subject->getStudentsMarks($student->id, Request::get('exam_id'), Request::get('class_id'), $subject->subject_id)->first();
                                                if (isset($getStudentMarks)) {
                                                    $totalStudentMarks = $getStudentMarks->class_work + $getStudentMarks->home_work + $getStudentMarks->test_work + $getStudentMarks->exam_work;
                                                } 
                                                
                                                $studentTotalObtained = $studentTotalObtained + $totalStudentMarks;
                                            @endphp
                                            <td style="min-width: 350px;">
                                                <div>
                                                    Class work:
                                                    <input type="hidden" name="marks[{{$i}}][full_marks]" value="{{$subject->full_marks}}">
                                                    <input type="hidden" name="marks[{{$i}}][passing_marks]" value="{{$subject->passing_marks}}">
                                                    
                                                    <input type="hidden" name="marks[{{$i}}][id]" value="{{$subject->id}}">
                                                    <input type="hidden" name="marks[{{$i}}][subject_id]" value="{{$subject->subject_id}}">
                                                    <input type="text" id="class_work_{{$student->id}}{{$subject->subject_id}}" value="@isset($getStudentMarks){{$getStudentMarks->class_work}}@endisset" name="marks[{{$i}}][class_work]" class="form-control w-50" placeholder="Enter marks">
                                                </div>
                                                <div>
                                                    Home work:
                                                    <input type="text" id="home_work_{{$student->id}}{{$subject->subject_id}}" value="@isset($getStudentMarks){{$getStudentMarks->home_work}}@endisset" name="marks[{{$i}}][home_work]" class="form-control w-50" placeholder="Enter marks">
                                                </div>
                                                <div>
                                                    Test work:
                                                    <input type="text" id="test_work_{{$student->id}}{{$subject->subject_id}}" value="@isset($getStudentMarks){{$getStudentMarks->test_work}}@endisset" name="marks[{{$i}}][test_work]" class="form-control w-50" placeholder="Enter marks">
                                                </div>
                                                <div>
                                                    Exams:
                                                    <input type="text" id="exam_work_{{$student->id}}{{$subject->subject_id}}" value="@isset($getStudentMarks){{$getStudentMarks->exam_work}}@endisset" name="marks[{{$i}}][exam_work]" class="form-control w-50" placeholder="Enter marks">
                                                </div>
                                                <div>
                                                    <button type="button" class="btn btn-primary my-2 save-single-subject-marks" id="{{$student->id}}" data-val="{{$subject->subject_id}}" data-schedule="{{$subject->id}}" data-exam="{{Request::get('exam_id')}}" data-class="{{Request::get('class_id')}}">Save</button>
                                                </div>
                                                @if (isset($getStudentMarks))
                                                <div class="my-3">
                                                    <b>Obtained Marks: </b>{{$totalStudentMarks}}
                                                    <br>
                                                    <b>Passing Marks: </b>{{$subject->passing_marks}}
                                                    <br>
                                                    @if ($subject->passing_marks <= $totalStudentMarks)
                                                        <span class="badge badge-success p-2 text-md">PASS</span>
                                                    @else
                                                        <span class="badge badge-danger p-2 text-md">FAIL</span>
                                                        @php $passOrFail = 1; @endphp
                                                    @endif
                                                </div>
                                                @endif
                                            </td>
                                            @php $i++; @endphp
                                            @endforeach
                                            <td style="min-width: 350px;">
                                                <button type="submit" class="btn btn-success">Save All</button>
                                                @if (!empty($studentTotalObtained))
                                                <br>
                                                <br>
                                                <b>Subject Total Marks:</b> {{$allTotalSubjectFullMarks}}
                                                <br>
                                                <b>Total Passing Marks:</b> {{$totalPassingMarks}}
                                                <br>
                                                <b>Student Obtained Marks:</b> {{$studentTotalObtained}}
                                                <br>
                                                @php 
                                                    $percentage = ($studentTotalObtained * 100) / $allTotalSubjectFullMarks;
                                                @endphp
                                                <b>Percentage: </b>{{$percentage}}%
                                                <br>
                                                <br>
                                                @if ($passOrFail == 0)
                                                 <b>Result:</b> <span class="badge badge-success p-2 text-md">PASS</span>
                                                @else
                                                 <b>Result:</b> <span class="badge badge-danger p-2 text-md">FAIL</span>
                                                @endif
                                                @endif
                                            </td>
                                        </tr>
                                    </form>
                                    @endforeach
                                    @endif
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
<script>
    $(document).ready(function() {
        $(document).on('submit', '.submitForm', function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "{{url('teacher/examinations/subject-marks')}}",
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
                url: "{{url('teacher/examinations/store-single-subject-marks')}}",
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