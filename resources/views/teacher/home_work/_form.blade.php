<div class="card-body">
    <div class="row">
        <div class="form-group col-3">
            <label for="InputClass">Select Batch</label>
            <select name="class_id" class="form-control" id="InputClass">
                <option value="">Select Batch</option>
                @if (!empty($classes))
                @foreach($classes as $key => $class)
                <option value="{{$class->class_id}}" {{ isset($record) && ($class->class_id == $record->class_id) ? 'selected' : '' }}>{{$class->class?->name}}</option>
                @endforeach
                @endif
            </select>
            <span class="text-danger">{{$errors->first('status')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputSubject">Select Subject</label>
            <select name="subject_id" class="form-control" id="InputSubject">
                <option value="">Select Subject</option>
                @if (!empty($subjects))
                    @foreach($subjects as $subject)
                        <option {{ isset($record) && ($subject->subject_id == $record->subject_id) ? 'selected' : '' }} value="{{$subject->subject_id}}">{{$subject->subject?->name}}</option>
                    @endforeach
                @endif
            </select>
            <span class="text-danger">{{$errors->first('status')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputHomeworkDate">Homework Date *</label>
            <input type="date" value="{{ old('homework_date') ?? (isset($record) ? $record->homework_date : '') }}" name="homework_date" class="form-control" id="InputHomeworkDate" required>
        </div>
        <div class="form-group col-3">
            <label for="InputSubmissionDate">Submission Date *</label>
            <input type="date" value="{{ old('submission_date') ?? (isset($record) ? $record->submission_date : '') }}" name="submission_date" class="form-control" id="InputSubmissionDate" required>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-12">
            <label for="InputDocument">Document *</label>
            <input type="file" value="{{ old('document') ?? (isset($record) ? $record->document : '') }}" name="document" class="form-control" id="InputDocument">
        </div>
        <div class="form-group col-12">
            <label for="InputMessage">Message *</label>
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Compose New Message</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <textarea id="compose-textarea" name="message" class="form-control" style="height: 300px">@isset($record){{$record->description}}@endisset</textarea>
                    </div>
                </div>
            </div>
            <span class="text-danger">{{$errors->first('email')}}</span>
        </div>
    </div>
</div>