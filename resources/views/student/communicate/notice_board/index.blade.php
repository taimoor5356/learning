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
                    <h1>Notice Board</h1>
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

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Search</h3>
                        </div>
                        <div class="card-body">
                            <form action="">
                                <div class="form-group row">
                                    <div class="col-2">
                                        <label for="InputTitle">Title</label>
                                        <input type="text" value="{{Request::get('title')}}" name="title" class="form-control" id="InputTitle" placeholder="Enter full title">
                                    </div>
                                    <div class="col-2">
                                        <label for="InputNoticeDateFrom">Notice Date From</label>
                                        <input type="date" value="{{Request::get('notice_from_date')}}" name="notice_from_date" class="form-control" id="InputNoticeDateFrom">
                                    </div>
                                    <div class="col-2">
                                        <label for="InputNoticeDateTo">Notice Date To</label>
                                        <input type="date" value="{{Request::get('notice_to_date')}}" name="notice_to_date" class="form-control" id="InputNoticeDateTo">
                                    </div>
                                    <div class="col-2" style="margin-top: 32px;">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                        <a href="{{url('student/communicate/notice-board/list')}}" class="btn btn-success">Clear All</a>
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
                        <div class="card-header mb-4">
                            <h3 class="card-title">Notices List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                        @foreach ($records as $record)
                            <div class="col-md-12">
                                <div class="card card-primary card-outline">
                                    <!-- /.card-header -->
                                    <div class="card-body p-0">
                                        <div class="mailbox-read-info">
                                            <h5>{{$record->title}}</h5>
                                            <h6>From: School Administrator
                                                <span class="mailbox-read-time text-dark float-right">{{$record->created_at}}</span>
                                            </h6>
                                        </div>
                                        <!-- /.mailbox-controls -->
                                        <div class="mailbox-read-message">
                                            {!! $record->message !!}
                                        </div>
                                        <!-- /.mailbox-read-message -->
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                        @endforeach
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="d-flex justify-content-end">
                        @isset($records){!! $records->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}@endisset
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
@endsection