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
                    <h1>Zoom Classes List (Total: {{$records->total()}})</h1>
                </div>
                @if (Auth::user()->user_type == '1')
                <div class="col-sm-6">
                    <div class="add-new float-sm-right">
                        <a href="{{url('zoom-classes/create')}}" class="btn btn-primary">Add New</a>
                    </div>
                </div>
                @endif
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
                            <h3 class="card-title">Zoom Classes List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Subject Name</th>
                                        <th>Date/Time</th>
                                        <th>Created Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($records->total() > 0)
                                    @foreach ($records as $key => $record)
                                    <tr>
                                        <td>{{ ($records->currentPage() - 1) * $records->perPage() + $loop->iteration }}</td>
                                        <td>{{$record->subject?->name}}</td>
                                        <td>{{$record->date}} | {{$record->time}}</td>
                                        <td>{{$record->created_at}}</td>
                                        <td>{{$record->status == 1 ? 'Active' : 'In Active'}}</td>
                                        <td>
                                            @if(Auth::user()->user_type == 1)
                                            <a href="{{url('zoom-classes/edit/'.$record->id)}}" class="btn btn-primary">Edit</a>
                                            @else
                                            <a href="{{url($record->zoom_link)}}" target="_blank" class="btn btn-primary">JOIN</a>
                                            @endif
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