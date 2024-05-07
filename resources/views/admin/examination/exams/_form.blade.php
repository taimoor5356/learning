<div class="card-body">
    <div class="form-group">
        <label for="InputExamName">Exam Name *</label>
        <input type="text" value="{{ old('name') ?? (isset($record) ? $record->name : '') }}" name="name" class="form-control" id="InputExamName" placeholder="Enter exam name" required>
        <span class="text-danger">{{$errors->first('name')}}</span>
    </div>
    <div class="form-group">
        <label for="InputNote">Note *</label>
        <textarea name="note" class="form-control" id="InputNote" cols="1" rows="5" placeholder="Enter note" required>{{ old('note') ?? (isset($record) ? $record->note : '') }}</textarea>
        <span class="text-danger">{{$errors->first('email')}}</span>
    </div>
</div>