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
                    <h1>Trashed Home work</h1>
                </div>
                <div class="col-sm-6">
                    <div class="add-new float-sm-right">
                        <a href="{{url('admin/home-work/list')}}" class="btn btn-primary">List</a>
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
                            <h3 class="card-title">Trashed Home work list</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Class</th>
                                        <th>Subject</th>
                                        <th>Homework Date</th>
                                        <th>Submission Date</th>
                                        <th>Document</th>
                                        <th>Created By</th>
                                        <th>Created Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($records))
                                    @foreach ($records as $key => $record)
                                    <tr>
                                        <td>{{ ($records->currentPage() - 1) * $records->perPage() + $loop->iteration }}</td>
                                        <td>{{$record->class?->name}}</td>
                                        <td>{{$record->subject?->name}}</td>
                                        <td>{{$record->homework_date}}</td>
                                        <td>{{$record->submission_date}}</td>
                                        <td>
                                            @if (!empty($record->getDocument()))
                                                <a href="{{$record->getDocument()}}" class="btn btn-primary btn-sm" download="">Download</a>
                                            @endif
                                        </td>
                                        <td>{{$record->user?->name}}</td>
                                        <td>{{$record->created_at}}</td>
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