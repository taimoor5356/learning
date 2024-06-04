<div class="card-body">
    <div class="form-group">
        <label for="InputLessonPlanName">Topic Name *</label>
        <input type="text" value="{{ old('lesson_plan') ?? (isset($record) ? $record->lesson_plan : '') }}" name="lesson_plan" class="form-control" id="InputLessonPlanName" placeholder="Enter topic name" required>
    </div>
    <div class="form-group">
        <label for="InputDescription">Description *</label>
        <textarea name="description" id="InputDescription" class="form-control" placeholder="Enter description">{{ old('description') ?? (isset($record) ? $record->description : '') }}</textarea>
    </div>
    <div class="form-group">
        <label for="InputStatus">Status</label>
        <select name="status" class="form-control" id="InputStatus">
            <option {{ (isset($record) ? (($record->status == '0') ? 'selected' : '') : '') }} value="0">Incomplete</option>
            <option {{ (isset($record) ? (($record->status == '1') ? 'selected' : '') : '') }} value="1">Running</option>
            <option {{ (isset($record) ? (($record->status == '2') ? 'selected' : '') : '') }} value="2">Completed</option>
        </select>
        <span class="text-danger">{{$errors->first('status')}}</span>
    </div>
</div>