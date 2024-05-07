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
                    <h1>Edit</h1>
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
                    <!-- /.card -->
                    <!-- /.card-header -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Homework</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" id="form" method="POST" action="{{url('admin/home-work/update', [$record->id])}}" enctype="multipart/form-data">
                            @csrf
                            @include('admin.home_work._form')
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
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
<script src="{{url('public/plugins/summernote/summernote-bs4.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('#compose-textarea').summernote({
            height: 150
        });
        $(document).on('change', '#InputClass', function () {
            var classId = $(this).val();
            $.ajax({
                url: "{{url('admin/home-work/get-class-subjects')}}",
                type: 'GET',
                data: {
                    class_id: classId
                },
                success: function (response) {
                    $('#InputSubject').html(response.subjects);
                }
            });
        });
    });
</script>
@endsection