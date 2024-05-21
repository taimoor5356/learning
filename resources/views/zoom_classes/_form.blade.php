<div class="card-body">
    <div class="row">
        <div class="form-group col-3">
            <label for="InputSubjectId">Subject *</label>
            <select name="subject_id" class="form-control" id="InputSubjectId">
                <option value="">Select Subject</option>
                @if (!empty($subjects))
                @foreach($subjects as $subject)
                    <option {{ (isset($record) && ($record->subject_id == $subject->id)) ? 'selected' : '' }} value="{{$subject->id}}">{{$subject->name}}</option>
                @endforeach
                @endif
            </select>
        </div>
        <div class="form-group col-3">
            <label for="InputDate">Date *</label>
            <input type="date" value="{{ old('date') ?? (isset($record) ? $record->date : '') }}" name="date" class="form-control" id="InputDate" required>
            <span class="text-danger">{{$errors->first('date')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputTime">Time *</label>
            <input type="time" value="{{ old('time') ?? (isset($record) ? $record->time : '') }}" name="time" class="form-control" id="InputTime" required>
            <span class="text-danger">{{$errors->first('time')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputDescription">Short Description *</label>
            <input type="text" value="{{ old('description') ?? (isset($record) ? $record->description : '') }}" name="description" class="form-control" id="InputDescription" placeholder="Enter short description" required>
            <span class="text-danger">{{$errors->first('description')}}</span>
        </div>
        <div class="form-group col-12">
            <label for="InputZoomLink">Zoom Link *</label>
            <input type="zoom_link" value="{{ old('zoom_link') ?? (isset($record) ? $record->zoom_link : '') }}" name="zoom_link" class="form-control" id="InputZoomLink" placeholder="Enter zoom link" required>
            <span class="text-danger">{{$errors->first('zoom_link')}}</span>
        </div>
        <div class="form-group col-12">
            <label for="InputStatus">Status *</label>
            <br>
            <input {{ (isset($record) && ($record->status == 1)) ? 'checked' : '' }} type="checkbox" name="status" id="InputStatus" required>
            <span class="text-danger">{{$errors->first('status')}}</span>
        </div>
    </div>
</div>