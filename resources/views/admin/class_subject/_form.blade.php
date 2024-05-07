<div class="card-body">
    <div class="form-group">
        <label for="InputClass">Select Class</label>
        <select name="class_id" class="form-control" id="InputClass">
            <option value="">Select Class</option>
            @foreach($classes as $key => $class)
                <option value="{{$class->id}}" {{ isset($record) && ($class->id == $record->class_id) ? 'selected' : '' }}>{{$class->name}}</option>
            @endforeach
        </select>
        <span class="text-danger">{{$errors->first('status')}}</span>
    </div>
    @if ($editSingle == false)
    <div class="form-group">
        <label for="InputSubject">Select Subject</label>
        @foreach($subjects as $key => $subject)
            @php 
                $checked = '';
                if(isset($getAssignedSubjectId)){
                    foreach ($getAssignedSubjectId as $subjectAssigned) {
                        if($subject->id == $subjectAssigned->subject_id){
                            $checked = 'checked';
                            break;
                        }
                    }
                }
            @endphp
        <div>
            <label for="" style="font-weight: normal;">
                <input type="checkbox" name="subject_id[]" value="{{$subject->id}}" {{$checked}}> {{$subject->name}}
            </label>
        </div>
        @endforeach
    </div>
    @else
    <div class="form-group">
        <label for="InputSubject">Select Subject</label>
        <select name="subject_id" class="form-control" id="InputSubject">
            <option value="">Select Subject</option>
            @foreach($subjects as $key => $subject)
                <option value="{{$subject->id}}" {{ isset($record) && ($subject->id == $record->subject_id) ? 'selected' : '' }}>{{$subject->name}}</option>
            @endforeach
        </select>
        <span class="text-danger">{{$errors->first('status')}}</span>
    </div>
    @endif
    <div class="form-group">
        <label for="InputStatus">Status</label>
        <select name="status" class="form-control" id="InputStatus">
            <option {{ (isset($record) ? (($record->status == 'Active') ? 'selected' : '') : '') }} value="1">Active</option>
            <option {{ (isset($record) ? (($record->status == 'In Active') ? 'selected' : '') : '') }} value="0">In Active</option>
        </select>
        <span class="text-danger">{{$errors->first('status')}}</span>
    </div>
</div>