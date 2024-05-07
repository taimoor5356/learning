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
                    <h1>Trashed Notices</h1>
                </div>
                <div class="col-sm-6">
                    <div class="add-new float-sm-right">
                        <a href="{{url('admin/communicate/notice-board/create')}}" class="btn btn-primary">Add New</a>
                        <a href="{{url('admin/communicate/notice-board/trashed')}}" class="btn btn-danger">Trashed</a>
                    </div>
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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Trashed Notices</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Title</th>
                                        <th>Notice Date</th>
                                        <th>Publish Date</th>
                                        <!-- <th>Message</th> -->
                                        <th>Created By</th>
                                        <th>Created Date</th>
                                        <th>Message To Users</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($records))
                                    @foreach ($records as $key => $record)
                                    <tr>
                                        <td>{{ ($records->currentPage() - 1) * $records->perPage() + $loop->iteration }}</td>
                                        <td>{{$record->title}}</td>
                                        <td>{{$record->notice_date}}</td>
                                        <td>{{$record->publish_date}}</td>
                                        <!-- <td>{{$record->message}}</td> -->
                                        <td>{{$record->user?->name}}</td>
                                        <td>{{$record->created_at}}</td>
                                        <td>
                                            @foreach($record->notice_board_users as $user)
                                                {{$user->message_to == 2 ? 'Teachers' : ''}}
                                                {{$user->message_to == 3 ? 'Students' : ''}}
                                                @if (!$loop->last)
                                                    |
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="100%" class="text-center">No Records Found</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
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