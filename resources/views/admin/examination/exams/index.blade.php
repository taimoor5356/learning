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
                    <h1>Exams List (Total: {{$records->total()}})</h1>
                </div>
                <div class="col-sm-6">
                    <div class="add-new float-sm-right">
                        <a href="{{url('admin/examinations/create-exams')}}" class="btn btn-primary">Add New</a>
                        <a href="{{url('admin/examinations/trashed-exams')}}" class="btn btn-danger">Trashed</a>
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
                            <h3 class="card-title">Search Exam</h3>
                        </div>
                        <div class="card-body">
                            <form action="">
                                <div class="form-group row">
                                    <div class="col-2">
                                        <label for="InputFullName">Name</label>
                                        <input type="text" value="{{Request::get('name')}}" name="name" class="form-control" id="InputFullName" placeholder="Enter full name">
                                    </div>
                                    <div class="col-2">
                                        <label for="InputNote">Email</label>
                                        <input type="text" value="{{Request::get('note')}}" name="note" class="form-control" id="InputNote" placeholder="Enter note">
                                    </div>
                                    <div class="col-2">
                                        <label for="InputFromDate">From Date</label>
                                        <input type="date" value="{{Request::get('from_date')}}" name="from_date" class="form-control" id="InputFromDate">
                                    </div>
                                    <div class="col-2">
                                        <label for="InputToDate">From Date</label>
                                        <input type="date" value="{{Request::get('to_date')}}" name="to_date" class="form-control" id="InputToDate">
                                    </div>
                                    <div class="col-2" style="margin-top: 32px;">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                        <a href="{{url('admin/examinations/exams-list')}}" class="btn btn-success">Clear All</a>
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
                            <h3 class="card-title">Exams List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Name</th>
                                        <th>Note</th>
                                        <th>Created By</th>
                                        <th>Created Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($records->total() > 0)
                                    @foreach ($records as $key => $record)
                                    <tr>
                                        <td>{{ ($records->currentPage() - 1) * $records->perPage() + $loop->iteration }}</td>
                                        <td>{{$record->name}}</td>
                                        <td>{{$record->note}}</td>
                                        <td>{{$record->user?->name}}</td>
                                        <td>{{$record->created_at}}</td>
                                        <td>
                                            <a href="{{url('admin/examinations/exams-edit/'.$record->id)}}" class="btn btn-primary">Edit</a>
                                            <a href="{{url('admin/examinations/delete-exam/'.$record->id)}}" class="btn btn-danger">Delete</a>
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