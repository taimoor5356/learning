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
                                    <div class="col-2">
                                        <label for="InputPublishFromDate">Publish Date From</label>
                                        <input type="date" value="{{Request::get('publish_from_date')}}" name="publish_from_date" class="form-control" id="InputPublishFromDate">
                                    </div>
                                    <div class="col-2">
                                        <label for="InputPublishToDate">Publish Date To</label>
                                        <input type="date" value="{{Request::get('publish_to_date')}}" name="publish_to_date" class="form-control" id="InputPublishToDate">
                                    </div>
                                    <div class="col-2" style="margin-top: 32px;">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                        <a href="{{url('admin/communicate/notice-board/list')}}" class="btn btn-success">Clear All</a>
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
                        <div class="card-header">
                            <h3 class="card-title">Notices List</h3>
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
                                        <th>Actions</th>
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
                                        <td style="min-width: 200px;">
                                            <a href="{{url('admin/communicate/notice-board/edit/'.$record->id)}}" class="btn btn-primary">Edit</a>
                                            <a href="{{url('admin/communicate/notice-board/delete/'.$record->id)}}" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="100%" class="text-center">No Record Found</td>
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