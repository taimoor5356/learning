<div class="card-body">
    <div class="form-group">
        <label for="InputName">Subject Name *</label>
        <input type="text" value="{{ old('name') ?? (isset($record) ? $record->name : '') }}" name="name" class="form-control" id="InputName" placeholder="Enter subject name" required>
    </div>
    <div class="form-group">
        <label for="InputType">Subject Type</label>
        <select name="type" class="form-control" id="InputType">
            <option {{ (isset($record) ? (($record->type == 'theory') ? 'selected' : '') : '') }} value="theory">Theory</option>
            <option {{ (isset($record) ? (($record->type == 'practical') ? 'selected' : '') : '') }} value="practical">Practical</option>
        </select>
        <span class="text-danger">{{$errors->first('status')}}</span>
    </div>
    <div class="form-group">
        <label for="InputStatus">Status</label>
        <select name="status" class="form-control" id="InputStatus">
            <option {{ (isset($record) ? (($record->status == 'Active') ? 'selected' : '') : '') }} value="1">Active</option>
            <option {{ (isset($record) ? (($record->status == 'In Active') ? 'selected' : '') : '') }} value="0">In Active</option>
        </select>
        <span class="text-danger">{{$errors->first('status')}}</span>
    </div>
</div>