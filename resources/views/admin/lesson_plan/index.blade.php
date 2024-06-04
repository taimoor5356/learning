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
                    <h1>Lesson Plan List (Total: {{$records->total()}})</h1>
                </div>
                <div class="col-sm-6">
                    <div class="add-new float-sm-right">
                        <a href="{{url('admin/lesson-plan/create/'.$id)}}" class="btn btn-primary">Add New</a>
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
                            <h3 class="card-title">Lesson Plan List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Subject Name</th>
                                        <th>Lesson Plan</th>
                                        <th>Description</th>
                                        <!-- <th>Teacher Name</th> -->
                                        <th>Status</th>
                                        <th>Created By</th>
                                        <th>Created Date</th>
                                        <th>Status Update</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($records->total() > 0)
                                    @foreach ($records as $key => $record)
                                    <tr>
                                        <td>{{ ($records->currentPage() - 1) * $records->perPage() + $loop->iteration }}</td>
                                        <td>{{$record->subject?->name}}</td>
                                        <td>{{$record->lesson_plan}}</td>
                                        <td>{{$record->description}}</td>
                                        <!-- <td>{{$record->teacher?->name}}</td> -->
                                        <td>{{$record->status == '0' ? 'incomplete' : ($record->status == '1' ? 'Running' : 'Completed')}}</td>
                                        <td>{{$record->user?->name}}</td>
                                        <td>{{$record->created_at}}</td>
                                        <td>
                                            <a href="{{url('admin/lesson-plan/status/0/'.$record->id)}}" class="btn btn-danger">Incomplete</a>
                                            <a href="{{url('admin/lesson-plan/status/1/'.$record->id)}}" class="btn btn-warning">Running</a>
                                            <a href="{{url('admin/lesson-plan/status/2/'.$record->id)}}" class="btn btn-success">Completed</a>
                                        </td>
                                        <td>
                                            <a href="{{url('admin/lesson-plan/edit/'.$record->id)}}" class="btn btn-primary">Edit</a>
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
                        {!! $records->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
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