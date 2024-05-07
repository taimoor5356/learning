<div class="card-body">
    <div class="form-group">
        <label for="InputName">Class Name *</label>
        <input type="text" value="{{ old('name') ?? (isset($record) ? $record->name : '') }}" name="name" class="form-control" id="InputName" placeholder="Enter class name" required>
    </div>
    <div class="form-group">
        <label for="InputAmount">Amount (Rs)*</label>
        <input type="number" value="{{ old('amount') ?? (isset($record) ? $record->amount : '') }}" name="amount" class="form-control" id="InputAmount" placeholder="Enter amount" required>
    </div>
    <div class="form-group">
        <label for="InputStatus">Status</label>
        <select name="status" class="form-control" id="InputStatus">
            <option {{ (isset($record) && ($record->status == 'Active')) ? 'selected' : '' }} value="1">Active</option>
            <option {{ (isset($record) && ($record->status == 'In Active')) ? 'selected' : '' }} value="0">In Active</option>
        </select>
        <span class="text-danger">{{$errors->first('status')}}</span>
    </div>
</div>