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
                    <h1>Fee Collection Report</h1>
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
                            <h3 class="card-title">Search Student</h3>
                        </div>
                        <div class="card-body">
                            <form action="">
                                <div class="form-group row">
                                    <div class="col-2">
                                        <label for="InputAttendanceName">Student Name</label>
                                        <input type="text" name="student_name" id="InputAttendanceName" class="form-control" value="{{Request::get('student_name')}}" placeholder="Enter student name">
                                    </div>
                                    <div class="col-2">
                                        <label for="InputStudentRollNumber">Student Roll Number</label>
                                        <input type="text" name="roll_number" id="InputStudentRollNumber" class="form-control" value="{{Request::get('roll_number')}}" placeholder="Enter student roll number">
                                    </div>
                                    <div class="col-2">
                                        <label for="InputClassId">Select Class</label>
                                        <select name="class_id" class="form-control" id="InputClassId">
                                            <option value="">Select Class</option>
                                            @if (!empty($classes))
                                            @foreach($classes as $key => $class)
                                                <option {{Request::get('class_id') == $class->id ? 'selected' : ''}} value="{{$class->id}}" {{ isset($record) && ($class->id == $record->class_id) ? 'selected' : '' }}>{{$class->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <label for="InputPaymentType">Select Payment Type</label>
                                        <select name="payment_type" class="form-control" id="InputPaymentType">
                                            <option value="">Select Payment Type</option>
                                                <option {{Request::get('payment_type') == 'cash_in_hand' ? 'selected' : ''}} value="cash_in_hand" {{ isset($record) && ($record->payment_type == 'cash_in_hand') ? 'selected' : '' }}>Cash in hand</option>
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <label for="InputFromDate">From Date</label>
                                        <input type="date" name="from_date" id="InputFromDate" class="form-control" value="{{Request::get('from_date')}}">
                                    </div>
                                    <div class="col-2">
                                        <label for="InputToDate">To Date</label>
                                        <input type="date" name="to_date" id="InputToDate" class="form-control" value="{{Request::get('to_date')}}">
                                    </div>
                                    <div class="col-2" style="margin-top: 32px;">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                        <a href="{{url('admin/fee-collection/report')}}" class="btn btn-success">Clear All</a>
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
                            <h3 class="card-title">Payment detail</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Student Name</th>
                                        <th>Student Roll Number</th>
                                        <th>Class Name</th>
                                        <th>Total Amount</th>
                                        <th>Paid Amount</th>
                                        <th>Remaining Amount</th>
                                        <th>Payment Type</th>
                                        <th>Remarks</th>
                                        <th>Created By</th>
                                        <th>Created Date</th>
                                        <!-- <th>Actions</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($records) && ($records->total() > 0))
                                    @foreach ($records as $key => $record)
                                    <tr>
                                        <td>{{ ($records->currentPage() - 1) * $records->perPage() + $loop->iteration }}</td>
                                        <td>{{$record->user?->name}}</td>
                                        <td>{{$record->user?->roll_number}}</td>
                                        <td>{{$record->class?->name}}</td>
                                        <td>Rs.{{$record->total_amount}}</td>
                                        <td>Rs.{{$record->paid_amount}}</td>
                                        <td>Rs.{{$record->remaining_amount}}</td>
                                        <td>{{$record->payment_type}}</td>
                                        <td>{{$record->description}}</td>
                                        <td>{{$record->created_user?->name}}</td>
                                        <td>{{$record->created_at}}</td>
                                        <!-- <td>
                                            <a href="{{url('admin/fee-collection/collect-fee/'.$record->id)}}" class="btn btn-success">Collect Fee</a>
                                        </td> -->
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
                        {!! !empty($records) ? $records->appends(Illuminate\Support\Facades\Request::except('page'))->links() : '' !!}
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