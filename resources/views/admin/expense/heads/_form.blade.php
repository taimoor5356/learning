<div class="card-body">
    <div class="row">
        <div class="form-group col-3">
            <label for="InputExpenseHeadName">Expense head name *</label>
            <input type="text" value="{{ old('name') ?? (isset($record) ? $record->name : '') }}" name="name" class="form-control" id="InputExpenseHeadName" placeholder="Enter expense head name" required>
        </div>
    </div>
</div>