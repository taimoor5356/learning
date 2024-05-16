<div class="card-body">
    <div class="row">
        <div class="form-group col-3">
            <label for="InputExpenseHeadId">Expense head *</label>
            <select name="expense_head_id" id="InputExpenseHeadId" class="form-control" required>
                <option value="">Select Expense Head</option>
                @if(!empty($expenseHeads))
                @foreach ($expenseHeads as $expenseHead)
                <option value="{{$expenseHead->id}}" {{ isset($record) && ($expenseHead->id == $record->expense_head_id) ? 'selected' : '' }}>{{$expenseHead->name}}</option>
                @endforeach
                @endif
            </select>
        </div>
        <div class="form-group col-3">
            <label for="InputInvoiceNumber">Expense invoice number *</label>
            <input type="text" value="{{ old('invoice_number') ?? (isset($record) ? $record->invoice_number : '') }}" name="invoice_number" class="form-control" id="InputInvoiceNumber" placeholder="Enter invoice number" required>
        </div>
        <div class="form-group col-3">
            <label for="InputDescription">Expense description *</label>
            <textarea name="description" class="form-control" id="InputDescription" placeholder="Enter description" required>{{ old('description') ?? (isset($record) ? $record->description : '') }}</textarea>
        </div>
        <div class="form-group col-3">
            <label for="InputAmount">Expense amount *</label>
            <input type="text" value="{{ old('amount') ?? (isset($record) ? $record->amount : '') }}" name="amount" class="form-control" id="InputAmount" placeholder="Enter amount">
        </div>
        <div class="form-group col-3">
            <label for="InputFile">Document/File *</label>
            <input type="file" value="{{ old('file') ?? (isset($record) ? $record->file : '') }}" name="file" class="form-control" id="InputFile">
            <span class="text-danger">{{$errors->first('file')}}</span>
            <div class="row mt-2">
                <div class="col-12">
                    <img src="@isset($record){{url('public/images/expenses/'.$record->file)}}@else{{url('public/images/avatar.png')}}@endisset" class="border rounded" width="100px" height="100px" alt="">
                </div>
            </div>
        </div>
        </div>
    </div>
</div>