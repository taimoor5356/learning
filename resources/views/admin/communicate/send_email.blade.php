@extends('layouts.app')
@section('style')
<link rel="stylesheet" href="{{url('public/plugins/select2/css/select2.min.css')}}">
<style type="text/css">
    .select2-container .select2-selection--single {
        display: block;
        width: 100%;
        height: calc(2.25rem + 2px);
        padding: .375rem .75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: .25rem;
        box-shadow: inset 0 0 0 transparent;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
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
                    <h1>Send Email</h1>
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
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Send Email</h3>
                        </div>
                        <form role="form" id="form" method="POST" action="">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label for="InputSubject">Subject *</label>
                                        <input type="text" value="{{ old('subject') ?? (isset($record) ? $record->subject : '') }}" name="subject" class="form-control" id="InputSubject" placeholder="Enter subject" required>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Search User</label>
                                        <select class="form-control select2" name="user_id" style="width: 100%;">
                                            <option value="">Select User</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-12">
                                        @php
                                        $messageToTeacher = isset($record) ? $record->getSingleMessageUser($record->id, 2) : null;
                                        $messageToStudent = isset($record) ? $record->getSingleMessageUser($record->id, 3) : null;
                                        @endphp
                                        <label for="InputMessageTo">Message To *</label>
                                        <br>
                                        <label for=""><input {{isset($messageToTeacher) ? 'checked' : ''}} type="checkbox" name="message_to[]" value="2"> Teacher</label>
                                        <label for="" class="mx-4"><input {{isset($messageToStudent) ? 'checked' : ''}} type="checkbox" class="" name="message_to[]" value="3"> Student</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label for="InputMessage">Message *</label>
                                        <div class="card card-primary card-outline">
                                            <div class="card-header">
                                                <h3 class="card-title">Compose New Message</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <textarea id="compose-textarea" name="message" class="form-control" style="height: 300px">@isset($record){{$record->message}}@endisset</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="text-danger">{{$errors->first('email')}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </section>
</div>
@endsection
@section('script')
<script src="{{url('public/plugins/summernote/summernote-bs4.min.js')}}"></script>
<script src="{{url('public/plugins/select2/js/select2.full.min.js')}}"></script>
<script>
    $(function() {
        $('.select2').select2({
            ajax: {
                url: "{{url('admin/communicate/emails/search-user')}}",
                dataType: 'json',
                delay: 300,
                data: function(params) {
                    return {
                        search: params.term,
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });
        $('#compose-textarea').summernote({
            height: 150
        });
    });
</script>
@endsection