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
                    <h1>Expenses List (Total: {{!empty($records) ? $records->total() : 0}})</h1>
                </div>
                <div class="col-sm-6">
                    <div class="add-new float-sm-right">
                        <a href="{{url('admin/expenses/create')}}" class="btn btn-primary">Add New</a>
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
                                        <label for="InputExpenseHead">Expense Head</label>
                                        <select name="expense_head_id" class="form-control" id="InputExpenseHead">
                                            <option value="">Select Expense Head</option>
                                            @if (!empty($expenseHeads))
                                            @foreach($expenseHeads as $key => $expenseHead)
                                                <option value="{{$expenseHead->id}}" {{(Request::get('expense_head_id') == $expenseHead->id) ? 'selected' : ''}}>{{$expenseHead->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <label for="InputInvoiceNumber">Invoice Number</label>
                                        <input type="text" value="{{Request::get('invoice_number')}}" name="invoice_number" class="form-control" id="InputInvoiceNumber" placeholder="Enter invoice number">
                                    </div>
                                    <div class="col-2">
                                        <label for="InputDescription">Description</label>
                                        <input type="text" value="{{Request::get('description')}}" name="description" class="form-control" id="InputDescription" placeholder="Enter description">
                                    </div>
                                    <!-- <div class="col-2">
                                        <label for="InputAmount">Amount</label>
                                        <input type="number" value="{{Request::get('amount')}}" name="amount" class="form-control" id="InputAmount" placeholder="Enter amount">
                                    </div> -->
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
                                        <a href="{{url('admin/expenses/list')}}" class="btn btn-success">Clear All</a>
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
                            <h3 class="card-title">Students list</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Image</th>
                                        <th>Expense Head Name</th>
                                        <th>Inovice Number</th>
                                        <th>Description</th>
                                        <th>Amount</th>
                                        <th>Created Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($records) && ($records->total() > 0))
                                    @foreach ($records as $key => $record)
                                    <tr>
                                        <td>{{ ($records->currentPage() - 1) * $records->perPage() + $loop->iteration }}</td>
                                        <td><img src="@isset($record){{url('public/images/expenses/'.$record->file)}}@else{{url('public/images/avatar.png')}}@endisset" class="border rounded" width="50px" height="50px" alt=""></td>
                                        <td>{{$record->expense_head->name}}</td>
                                        <td>{{$record->invoice_number}}</td>
                                        <td>{{$record->description}}</td>
                                        <td>Rs.{{$record->amount}}</td>
                                        <td>{{$record->created_at}}</td>
                                        <td>
                                            <a href="{{url('admin/expenses/edit/'.$record->id)}}" class="btn btn-primary">Edit</a>
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