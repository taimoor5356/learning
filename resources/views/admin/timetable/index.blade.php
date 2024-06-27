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
                    <h1>Class Timetable</h1>
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
                                        <label for="InputClassId">Select Batch</label>
                                        <select value="{{Request::get('class_id')}}" name="class_id" class="form-control get-class-id" id="InputClassId">
                                            <option value="">Select Batch</option>
                                            @foreach ($classes as $class)
                                                <option value="{{$class->id}}" {{(Request::get('class_id') == $class->id) ? 'selected' : ''}}>{{$class->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- <div class="col-2">
                                        <label for="InputSubjectId">Select Subject</label>
                                        <select value="{{Request::get('subject_id')}}" name="subject_id" class="form-control get-subjects" id="InputSubjectId">
                                            <option value="">Select Subject</option>
                                            @if (!empty($classSubjects))
                                                @foreach ($classSubjects as $classSubject)
                                                    <option {{(Request::get('subject_id') == $classSubject->id) ? 'selected' : ''}} value="{{$classSubject->id}}">{{$classSubject->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div> -->
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
                        <form action="{{url('admin/class-timetable/add')}}" method="POST">
                            @csrf()
                            <input type="hidden" name="class_id" value="{{Request::get('class_id')}}">
                            <input type="hidden" name="subject_id" value="{{Request::get('subject_id')}}">
                            <div class="card-header">
                                <h3 class="card-title">Class Timetable</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                        <!-- <th>Week</th> -->
                                        <th>Subject</th>
                                        <th>Date</th>
                                        <th>Start time</th>
                                        <th>End time</th>
                                        <th>Room number</th>
                                    </thead>
                                    <tbody>
                                        @if (!empty(Request::get('class_id')))
                                            @php $i = 1; @endphp
                                            @foreach ($subjectDaysData as $subject)
                                                <tr>
                                                    <td><input type="hidden" name="timetable[{{$i}}][subject_id]" value="{{$subject['subject_id']}}">{{$subject['subject_name']}}</td>
                                                    <td><input type="date" name="timetable[{{$i}}][date]" class="form-control" value=""></td>
                                                    <td><input type="time" name="timetable[{{$i}}][start_time]" value="" class="form-control"></td>
                                                    <td><input type="time" name="timetable[{{$i}}][end_time]" value="" class="form-control"></td>
                                                    <td><input type="text" name="timetable[{{$i}}][room_number]" value="" class="form-control w-50"></td>
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
                        // $('.get-subjects').html(response);
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