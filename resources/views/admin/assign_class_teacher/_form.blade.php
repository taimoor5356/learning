<div class="card-body">
    <div class="form-group">
        <label for="InputClass">Select Class</label>
        <select name="class_id" class="form-control" id="InputClass">
            <option value="">Select Class</option>
            @foreach($classes as $key => $class)
                <option value="{{$class->id}}" {{ isset($record) && ($class->id == $record->class_id) ? 'selected' : '' }}>{{$class->name}}</option>
            @endforeach
        </select>
        <span class="text-danger">{{$errors->first('class_id')}}</span>
    </div>
    @if ($editSingle == false)
    <div class="form-group">
        <label for="InputTeacher">Select Teacher</label>
        @foreach($teachers as $key => $teacher)
            @php 
                $checked = '';
                if(!empty($getAssignedTeacherId)){
                    foreach ($getAssignedTeacherId as $teacherAssigned) {
                        if($teacher->id == $teacherAssigned->teacher_id){
                            $checked = 'checked';
                            break;
                        }
                    }
                }
            @endphp
        <div>
            <label for="" style="font-weight: normal;">
                <input type="checkbox" name="teacher_id[]" value="{{$teacher->id}}" {{$checked}}> {{$teacher->name}}
            </label>
        </div>
        @endforeach
    </div>
    @else
    <div class="form-group">
        <label for="InputTeacher">Select Teacher</label>
        <select name="teacher_id" class="form-control" id="InputTeacher">
            <option value="">Select Teacher</option>
            @foreach($teachers as $key => $teacher)
                <option value="{{$teacher->id}}" {{ isset($record) && ($teacher->id == $record->teacher_id) ? 'selected' : '' }}>{{$teacher->name}}</option>
            @endforeach
        </select>
        <span class="text-danger">{{$errors->first('status')}}</span>
    </div>
    @endif
    <div class="form-group">
        <label for="InputStatus">Status</label>
        <select name="status" class="form-control" id="InputStatus">
            <option {{ (isset($record) ? (($record->status == '1') ? 'selected' : '') : '') }} value="1">Active</option>
            <option {{ (isset($record) ? (($record->status == '0') ? 'selected' : '') : '') }} value="0">In Active</option>
        </select>
        <span class="text-danger">{{$errors->first('status')}}</span>
    </div>
</div>