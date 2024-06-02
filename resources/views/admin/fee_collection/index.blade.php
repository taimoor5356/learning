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
                    <h1>Students Fee list (Total: {{!empty($records) ? $records->total() : 0}})</h1>
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
                                        <label for="InputClass">Class</label>
                                        <select name="class_id" class="form-control" id="InputClass">
                                            <option value="">Select Class</option>
                                            @if (!empty($classes))
                                            @foreach($classes as $key => $class)
                                                <option value="{{$class->id}}" {{(Request::get('class_id') == $class->id) ? 'selected' : ''}}>{{$class->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <label for="InputFullName">Student Name</label>
                                        <input type="text" value="{{Request::get('student_name')}}" name="student_name" class="form-control" id="InputFullName" placeholder="Enter full student name">
                                    </div>
                                    <div class="col-2">
                                        <label for="InputRollNumber">Roll Number</label>
                                        <input type="text" value="{{Request::get('roll_number')}}" name="roll_number" class="form-control" id="InputRollNumber" placeholder="Enter roll number">
                                    </div>
                                    <div class="col-2">
                                        <label for="InputFromDate">From Date</label>
                                        <input type="date" value="{{Request::get('from_date')}}" name="from_date" class="form-control" id="InputFromDate">
                                    </div>
                                    <div class="col-2">
                                        <label for="InputToDate">To Date</label>
                                        <input type="date" value="{{Request::get('to_date')}}" name="to_date" class="form-control" id="InputToDate">
                                    </div>
                                    <div class="col-2" style="margin-top: 32px;">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                        <a href="{{url('admin/fee-collection/list')}}" class="btn btn-success">Clear All</a>
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
                            <div class="d-flex justify-content-between">
                                <span class="card-title">Students list</span>
                                <a href="{{url('admin/fee-collection/export-fee-report')}}" class="card-title btn btn-primary text-white">Export</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Student Name</th>
                                        <th>Class Type</th>
                                        <th>Program</th>
                                        <th>Batch Number</th>
                                        <th>Roll Number</th>
                                        <th>Mobile Number</th>
                                        <th>Total Amount</th>
                                        <th>Total Discount</th>
                                        <th>Paid Amount</th>
                                        <th>Remaining Amount</th>
                                        <th>Created Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($records) && ($records->total() > 0))
                                    @foreach ($records as $key => $record)
                                    @php 
                                        $paidAmount = $record->getPaidAmount($record->id, $record->class_id);
                                    @endphp
                                    <tr>
                                        <td>{{ ($records->currentPage() - 1) * $records->perPage() + $loop->iteration }}</td>
                                        <td>{{$record->name}}</td>
                                        <td>{{$record->class_type}}</td>
                                        <td>{{$record->class_program}}</td>
                                        <td>{{$record->batch?->name}}</td>
                                        <td>{{$record->roll_number}}</td>
                                        <td>{{$record->mobile_number}}</td>
                                        <td>Rs.{{$record->class?->amount}}</td>
                                        <td>Rs.{{$record->discounted_amount}}</td>
                                        <td>Rs.{{$paidAmount}}</td>
                                        <td>Rs.{{$record->class?->amount - ($paidAmount + $record->discounted_amount)}}</td>
                                        <td>{{$record->created_at}}</td>
                                        <td>
                                            @if ($record->class?->amount <= ($paidAmount + $record->discounted_amount))
                                            <span class="badge badge-success">PAID</span>
                                            @elseif($paidAmount > 0 && $paidAmount < $record->class?->amount)
                                                <span class="badge badge-warning">PARTIAL PAID</span>
                                            @else
                                                <span class="badge badge-danger">UNPAID</span>
                                            @endif
                                        </td>
                                        <td style="min-width: 150px;">
                                            <a href="{{url('admin/fee-collection/collect-fee/'.$record->id)}}" class="btn btn-success">Collect Fee</a>
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