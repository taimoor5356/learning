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
                    <h1>System Settings</h1>
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
                    <!-- /.card-header -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Update System Settings</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" id="form" method="POST" action="{{url('admin/settings/update', [1])}}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body row">
                                <div class="form-group col-6">
                                    <label for="InputAcademyName">Academy Name *</label>
                                    <input type="text" value="{{ old('school_name') ?? (isset($record) ? $record->school_name : '') }}" name="school_name" class="form-control" id="InputAcademyName" placeholder="Enter full academy name">
                                    <span class="text-danger">{{$errors->first('school_name')}}</span>
                                </div>
                                <div class="form-group col-6">
                                    <label for="InputAcademyShortDescription">Academy Header Short Description *</label>
                                    <input type="text" value="{{ old('school_description') ?? (isset($record) ? $record->school_description : '') }}" name="school_description" class="form-control" id="InputAcademyShortDescription" placeholder="Enter header short description">
                                    <span class="text-danger">{{$errors->first('school_description')}}</span>
                                </div>
                                <div class="form-group col-3">
                                    <label for="InputAcademyEmail">Academy Email *</label>
                                    <input type="email" value="{{ old('school_email') ?? (isset($record) ? $record->school_email : '') }}" name="school_email" class="form-control" id="InputAcademyEmail" placeholder="Enter full name">
                                    <span class="text-danger">{{$errors->first('school_email')}}</span>
                                </div>
                                <div class="form-group col-3">
                                    <label for="InputAcademyEmailPassword">Academy Email Password *</label>
                                    <input type="password" value="" name="school_email_password" class="form-control" id="InputAcademyEmailPassword" placeholder="Enter full name">
                                    <span class="text-danger">{{$errors->first('school_email_password')}}</span>
                                </div>
                                <div class="form-group col-3">
                                    <label for="InputAcademyEmailApiKey">Academy Email API Key *</label>
                                    <input type="text" value="{{ old('school_email_api_key') ?? (isset($record) ? $record->school_email_api_key : '') }}" name="school_email_api_key" class="form-control" id="InputAcademyEmailApiKey" placeholder="Enter full name">
                                    <span class="text-danger">{{$errors->first('school_email_api_key')}}</span>
                                </div>
                                <div class="form-group col-3">
                                    <label for="InputAcademySMSApiKey">Academy SMS API Key *</label>
                                    <input type="text" value="{{ old('school_sms_api_key') ?? (isset($record) ? $record->school_sms_api_key : '') }}" name="school_sms_api_key" class="form-control" id="InputAcademySMSApiKey" placeholder="Enter full name">
                                    <span class="text-danger">{{$errors->first('school_sms_api_key')}}</span>
                                </div>
                                <div class="form-group col-6">
                                    <label for="InputAcademyEmailDescription">Academy Email Bottom Description *</label>
                                    <textarea name="school_email_description" class="form-control" id="InputAcademyEmailDescription">{{ old('school_email_description') ?? (isset($record) ? $record->school_email_description : '') }}</textarea>
                                    <span class="text-danger">{{$errors->first('school_email_description')}}</span>
                                </div>
                                <div class="form-group col-6">
                                    <label for="InputAcademyExamReportDescription">Academy Exam Report Description *</label>
                                    <textarea name="school_exam_report_description" class="form-control" id="InputAcademyExamReportDescription">{{ old('school_exam_report_description') ?? (isset($record) ? $record->school_exam_report_description : '') }}</textarea>
                                    <span class="text-danger">{{$errors->first('school_exam_report_description')}}</span>
                                </div>
                                <div class="form-group col-12">
                                    <label for="InputLoginPageNotification01">Login Page Notification 01 *</label>
                                    <textarea name="school_login_page_notification_01" class="form-control" id="InputLoginPageNotification01">{{ old('school_login_page_notification_01') ?? (isset($record) ? $record->school_login_page_notification_01 : '') }}</textarea>
                                    <span class="text-danger">{{$errors->first('school_login_page_notification_01')}}</span>
                                </div>
                                <div class="form-group col-12">
                                    <label for="InputLoginPageNotification02">Login Page Notification 02 *</label>
                                    <textarea name="school_login_page_notification_02" class="form-control" id="InputLoginPageNotification02">{{ old('school_login_page_notification_02') ?? (isset($record) ? $record->school_login_page_notification_02 : '') }}</textarea>
                                    <span class="text-danger">{{$errors->first('school_login_page_notification_02')}}</span>
                                </div>
                                <div class="form-group col-12">
                                    <label for="InputLoginPageNotification03">Login Page Notification 03 *</label>
                                    <textarea name="school_login_page_notification_03" class="form-control" id="InputLoginPageNotification03">{{ old('school_login_page_notification_03') ?? (isset($record) ? $record->school_login_page_notification_03 : '') }}</textarea>
                                    <span class="text-danger">{{$errors->first('school_login_page_notification_03')}}</span>
                                </div>
                                <br>
                                <br>
                                <div class="form-group col-4">
                                    <label for="InputAcademyLogoName">Academy Logo Name *</label>
                                    <input type="text" value="{{ old('school_logo_name') ?? (isset($record) ? $record->school_logo_name : '') }}" name="school_logo_name" class="form-control" name="school_logo_name" id="InputAcademyLogoName" placeholder="Enter school logo name">
                                    <span class="text-danger">{{$errors->first('school_logo_name')}}</span>
                                </div>

                                <!-- Images -->
                                <div class="form-group col-4">
                                    <label for="InputAcademyBrowserIcon">Academy Browser Icon <span class="text-danger">*</span></label>
                                    <input type="file" value="{{ old('school_browser_icon') ?? (isset($record) ? $record->school_browser_icon : '') }}" name="school_images[]" class="form-control" id="InputAcademyBrowserIcon">
                                    <span class="text-danger">{{$errors->first('school_browser_icon')}}</span>
                                    <div class="row mt-2">
                                        <div class="col-12">
                                            <img src="@isset($record){{url('public/images/school_images/'.$record->school_browser_icon)}}@else{{url('public/images/avatar.png')}}@endisset" class="border rounded" width="110px" height="100px" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-4">
                                    <label for="InputAcademyLogo">Academy Logo <span class="text-danger">*</span></label>
                                    <input type="file" value="{{ old('school_logo') ?? (isset($record) ? $record->school_logo : '') }}" name="school_images[]" class="form-control" id="InputAcademyLogo">
                                    <span class="text-danger">{{$errors->first('school_logo')}}</span>
                                    <div class="row mt-2">
                                        <div class="col-12">
                                            <img src="@isset($record){{url('public/images/school_images/'.$record->school_logo)}}@else{{url('public/images/avatar.png')}}@endisset" class="border rounded" width="110px" height="100px" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-4">
                                    <label for="InputAcademyLoginImageOne">Academy Login Page Image 1 <span class="text-danger">*</span></label>
                                    <input type="file" value="{{ old('school_login_page_image_one') ?? (isset($record) ? $record->school_login_page_image_one : '') }}" name="school_images[]" class="form-control" id="InputAcademyLoginImageOne">
                                    <span class="text-danger">{{$errors->first('school_login_page_image_one')}}</span>
                                    <div class="row mt-2">
                                        <div class="col-12">
                                            <img src="@isset($record){{url('public/images/school_images/'.$record->school_login_page_image_one)}}@else{{url('public/images/avatar.png')}}@endisset" class="border rounded" width="110px" height="100px" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-4">
                                    <label for="InputAcademyLoginImageTwo">Academy Login Page Image 2 <span class="text-danger">*</span></label>
                                    <input type="file" value="{{ old('school_login_page_image_two') ?? (isset($record) ? $record->school_login_page_image_two : '') }}" name="school_images[]" class="form-control" id="InputAcademyLoginImageTwo">
                                    <span class="text-danger">{{$errors->first('school_login_page_image_two')}}</span>
                                    <div class="row mt-2">
                                        <div class="col-12">
                                            <img src="@isset($record){{url('public/images/school_images/'.$record->school_login_page_image_two)}}@else{{url('public/images/avatar.png')}}@endisset" class="border rounded" width="110px" height="100px" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-4">
                                    <label for="InputAcademyLoginImageThree">Academy Login Page Image 3 <span class="text-danger">*</span></label>
                                    <input type="file" value="{{ old('school_login_page_image_three') ?? (isset($record) ? $record->school_login_page_image_three : '') }}" name="school_images[]" class="form-control" id="InputAcademyLoginImageThree">
                                    <span class="text-danger">{{$errors->first('school_login_page_image_three')}}</span>
                                    <div class="row mt-2">
                                        <div class="col-12">
                                            <img src="@isset($record){{url('public/images/school_images/'.$record->school_login_page_image_three)}}@else{{url('public/images/avatar.png')}}@endisset" class="border rounded" width="110px" height="100px" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-4">
                                    <label for="InputAcademyLoginImageFour">Academy Login Page Image 4 <span class="text-danger">*</span></label>
                                    <input type="file" value="{{ old('school_login_page_image_four') ?? (isset($record) ? $record->school_login_page_image_four : '') }}" name="school_images[]" class="form-control" id="InputAcademyLoginImageFour">
                                    <span class="text-danger">{{$errors->first('school_login_page_image_four')}}</span>
                                    <div class="row mt-2">
                                        <div class="col-12">
                                            <img src="@isset($record){{url('public/images/school_images/'.$record->school_login_page_image_four)}}@else{{url('public/images/avatar.png')}}@endisset" class="border rounded" width="110px" height="100px" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-4">
                                    <label for="InputAcademyLoginImageFive">Academy Login Page Image 5 <span class="text-danger">*</span></label>
                                    <input type="file" value="{{ old('school_login_page_image_five') ?? (isset($record) ? $record->school_login_page_image_five : '') }}" name="school_images[]" class="form-control" id="InputAcademyLoginImageFive">
                                    <span class="text-danger">{{$errors->first('school_login_page_image_five')}}</span>
                                    <div class="row mt-2">
                                        <div class="col-12">
                                            <img src="@isset($record){{url('public/images/school_images/'.$record->school_login_page_image_five)}}@else{{url('public/images/avatar.png')}}@endisset" class="border rounded" width="110px" height="100px" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
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
@endsection