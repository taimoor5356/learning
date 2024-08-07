@extends('layouts.app')
@section('style')
<style type="text/css">
    .bg-darkgrey {
        background-color: rgba(0,0,0,.050);
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
                    <h1>Submitted Home work</h1>
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
                            <h3 class="card-title">Submitted Home work list</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Student Name</th>
                                        <th>Batch Number</th>
                                        <th>Subject</th>
                                        <th>Homework Date</th>
                                        <th>Submission Date</th>
                                        <th>Document</th>
                                        <th>Description</th>
                                        <th>Created Date</th>

                                        <th class="bg-darkgrey">Submitted Document</th>
                                        <th class="bg-darkgrey">Submitted Description</th>
                                        <th class="bg-darkgrey">Submitted Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($records))
                                    @foreach ($records as $key => $record)
                                    <tr>
                                        <td>{{ ($records->currentPage() - 1) * $records->perPage() + $loop->iteration }}</td>
                                        <td>{{$record->user?->name}}</td>
                                        <td>{{$record->home_work?->batch?->name}}</td>
                                        <td>{{$record->home_work?->subject?->name}}</td>
                                        <td>{{$record->home_work?->homework_date}}</td>
                                        <td>{{$record->home_work?->submission_date}}</td>
                                        <td>
                                            @if (!empty($record->home_work?->getDocument()))
                                                <a href="{{$record->home_work?->getDocument()}}" class="btn btn-primary btn-sm" download="">Download</a>
                                            @endif
                                        </td>
                                        <td>{!! $record->home_work?->description !!}</td>
                                        <td>{{$record->home_work?->created_at}}</td>

                                        <td class="bg-darkgrey">
                                            @if (!empty($record->getDocument()))
                                                <a href="{{$record->getDocument()}}" class="btn btn-success btn-sm text-white" download="">Download</a>
                                            @endif</td>
                                        <td class="bg-darkgrey">{!! $record->description !!}</td>
                                        <td class="bg-darkgrey">{{$record->created_at}}</td>
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