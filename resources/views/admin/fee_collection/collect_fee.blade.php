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
                    <h1>Collect Fee (Total: {{!empty($records) ? $records->total() : 0}})</h1>
                </div>
                @can('fee_collection_update')
                <div class="col-sm-6">
                    <div class="add-new float-sm-right">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addFeeModal">Add New</button>
                    </div>
                </div>
                @endcan
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
                            <h3 class="card-title">Payment detail  @if(Auth::user()->user_type == 3 && Auth::user()->fee->sum('paid_amount') == Auth::user()->class?->amount) <span class="badge badge-success">Fully PAID</span>@endif</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Batch Number</th>
                                        <th>Total Amount</th>
                                        <th>Paid Amount</th>
                                        <th>Remaining Amount</th>
                                        <th>Payment Type</th>
                                        <th>Installment</th>
                                        <th>Receipt Number</th>
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
                                        <td>{{$record->user?->batch?->name}}</td>
                                        <td>Rs.{{$record->total_amount}}</td>
                                        <td>Rs.{{$record->paid_amount}}</td>
                                        <td>Rs.{{$record->remaining_amount}}</td>
                                        <td>{{$record->payment_type}}</td>
                                        <td>{{$record->installment}}</td>
                                        <td>{{$record->challan_number}}</td>
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


<!-- Modal -->
<div class="modal fade" id="addFeeModal" tabindex="-1" role="dialog" aria-labelledby="addFeeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addFeeModalLabel">Add New</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <label for="">Class Name: {{$user->class?->name}}</label>
                        </div>
                        <br>
                        <br>
                        <div class="col-12">
                            <label for="">Total Amount: Rs.{{$user->total_fees}}</label>
                        </div>
                        <br>
                        <br>
                        <div class="col-12">
                            <label for="">Total Discount: Rs.{{$user->discounted_amount}}</label>
                        </div>
                        <br>
                        <br>
                        <div class="col-12">
                            <label for="">Paid Amount: Rs.{{$paid_amount}}</label>
                        </div>
                        <br>
                        <br>
                        <div class="col-12">
                            <label for="">Remaining Amount: Rs.{{$user->total_fees - $paid_amount - $user->discounted_amount}}</label>
                        </div>
                        <br>
                        <br>
                        <div class="col-12">
                            <label for="">Enter Amount</label>
                            <input type="number" name="amount" class="form-control" placeholder="Enter paying amount" required>
                        </div>
                        <div class="col-12">
                            <label for="">Payment Type</label>
                            <select name="payment_type" class="form-control" required>
                                <option value="">Select Payment Type</option>
                                <option value="cash_in_hand">Cash in hand</option>
                                <option value="" disabled>Bank payment</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="">Installment</label>
                            <select name="installment" class="form-control">
                                <option value="">Select Installment</option>
                                <option value="first">first</option>
                                <option value="second">second</option>
                                <option value="third">third</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="">Description</label>
                            <textarea name="description" class="form-control" placeholder="Enter short remarks"></textarea>
                        </div>
                        <div class="col-12">
                            <label for="">Receipt Number</label>
                            <input type="text" name="challan_number" class="form-control" placeholder="Enter receipt number">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
@endsection
@section('script')
@endsection
