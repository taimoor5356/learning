<div class="card-body">
    <div class="row">
        <div class="form-group col-4">
            <label for="InputFullName">Full Name <span class="text-danger">*</span></label>
            <input type="text" value="{{ old('name') ?? (isset($record) ? $record->name : '') }}" name="name" class="form-control" id="InputFullName" placeholder="Enter full name" required>
            <span class="text-danger">{{$errors->first('name')}}</span>
        </div>
        <div class="form-group col-4">
            <label for="InputAdmissionNumber">Admission Number <span class="text-danger">*</span></label>
            <input type="text" value="{{ old('admission_number') ?? (isset($record) ? $record->admission_number : '') }}" disabled class="form-control" id="InputAdmissionNumber" placeholder="Enter admission number" required>
            <span class="text-danger">{{$errors->first('admission_number')}}</span>
        </div>
        <div class="form-group col-4">
            <label for="InputRollNo">Roll Number <span class="text-danger">*</span></label>
            <input type="text" value="{{ old('roll_number') ?? (isset($record) ? $record->roll_number : '') }}" disabled class="form-control" id="InputRollNo" placeholder="Enter roll number" required>
            <span class="text-danger">{{$errors->first('roll_number')}}</span>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-4">
            <label for="InputClass">Select Class <span class="text-danger">*</span></label>
            <select disabled class="form-control" id="InputClass" required>
                <option value="">Select Class</option>
                @foreach($classes as $key => $class)
                    <option value="{{$class->id}}" {{ isset($record) ? ($class->id == $record->class_id ? 'selected' : '') : (old('class_id') == $class->id ? 'selected' : '') }}>{{$class->name}}</option>
                @endforeach
            </select>
            <span class="text-danger">{{$errors->first('class_id')}}</span>
        </div>
        <div class="form-group col-4">
            <label for="InputGender">Gender <span class="text-danger">*</span></label>
            <select name="gender" id="InputGender" class="form-control" required>
                <option value="">Select Gender</option>
                <option value="male" {{ isset($record) ? ($record->gender == 'male' ? 'selected' : '') : (old('gender') == 'male' ? 'selected' : '') }}>Male</option>
                <option value="female" {{ isset($record) ? ($record->gender == 'female' ? 'selected' : '') : (old('gender') == 'female' ? 'selected' : '') }}>Female</option>
            </select>
            <span class="text-danger">{{$errors->first('gender')}}</span>
        </div>
        <div class="form-group col-4">
            <label for="InputDateOfBirth">Date of Birth <span class="text-danger">*</span></label>
            <input type="date" name="date_of_birth" class="form-control" id="InputDateOfBirth" value="{{ old('date_of_birth') ?? (isset($record) ? $record->date_of_birth : '') }}" required>
            <span class="text-danger">{{$errors->first('date_of_birth')}}</span>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-4">
            <label for="InputCaste">Caste <span class="text-danger">*</span></label>
            <input type="text" value="{{ old('caste') ?? (isset($record) ? $record->caste : '') }}" name="caste" class="form-control" id="InputCaste" placeholder="Enter caste" required>
            <span class="text-danger">{{$errors->first('caste')}}</span>
        </div>
        <div class="form-group col-4">
            <label for="InputReligion">Religion <span class="text-danger">*</span></label>
            <input type="text" value="{{ old('religion') ?? (isset($record) ? $record->religion : '') }}" name="religion" class="form-control" id="InputReligion" placeholder="Enter religion name" required>
            <span class="text-danger">{{$errors->first('religion')}}</span>
        </div>
        <div class="form-group col-4">
            <label for="InputMobileNumber">Mobile Number <span class="text-danger">*</span></label>
            <input type="number" value="{{ old('mobile_number') ?? (isset($record) ? $record->mobile_number : '') }}" name="mobile_number" class="form-control" id="InputMobileNumber" placeholder="Enter mobile number" required>
            <span class="text-danger">{{$errors->first('mobile_number')}}</span>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-4">
            <label for="InputAdmissionDate">Admission Date <span class="text-danger">*</span></label>
            <input type="date" value="{{ old('admission_date') ?? (isset($record) ? $record->admission_date : '') }}" disabled class="form-control" id="InputAdmissionDate" required>
            <span class="text-danger">{{$errors->first('admission_date')}}</span>
        </div>
        <div class="form-group col-4">
            <label for="InputProfilePicture">Profile Picture <span class="text-danger">*</span></label>
            <input type="file" value="{{ old('profile_pic') ?? (isset($record) ? $record->profile_pic : '') }}" name="profile_pic" class="form-control" id="InputProfilePicture">
            <span class="text-danger">{{$errors->first('profile_pic')}}</span>
            <div class="row mt-2">
                <div class="col-12">
                    <img src="@isset($record){{$record->getProfilePic()}}@else{{url('public/images/avatar.png')}}@endisset" class="border rounded" width="100px" height="100px" alt="">
                </div>
            </div>
        </div>
        <div class="form-group col-4">
            <label for="InputBloodGroup">Blood Group <span class="text-danger">*</span></label>
            <select name="blood_group" id="blood_group" class="form-control" required>
                <option value="">Select Blood Group</option>
                <option value="A+" {{ isset($record) ? ($record->blood_group == 'A+' ? 'selected' : '') : (old('blood_group') == 'A+' ? 'selected' : '') }}>A+</option>
                <option value="A-" {{ isset($record) ? ($record->blood_group == 'A-' ? 'selected' : '') : (old('blood_group') == 'A-' ? 'selected' : '') }}>A-</option>
                <option value="B+" {{ isset($record) ? ($record->blood_group == 'B+' ? 'selected' : '') : (old('blood_group') == 'B+' ? 'selected' : '') }}>B+</option>
                <option value="B-" {{ isset($record) ? ($record->blood_group == 'B-' ? 'selected' : '') : (old('blood_group') == 'B-' ? 'selected' : '') }}>B-</option>
                <option value="AB+" {{ isset($record) ? ($record->blood_group == 'AB+' ? 'selected' : '') : (old('blood_group') == 'AB+' ? 'selected' : '') }}>AB+</option>
                <option value="AB-" {{ isset($record) ? ($record->blood_group == 'AB-' ? 'selected' : '') : (old('blood_group') == 'AB-' ? 'selected' : '') }}>AB-</option>
                <option value="O+" {{ isset($record) ? ($record->blood_group == 'O+' ? 'selected' : '') : (old('blood_group') == 'O+' ? 'selected' : '') }}>O+</option>
                <option value="O-" {{ isset($record) ? ($record->blood_group == 'O-' ? 'selected' : '') : (old('blood_group') == 'O-' ? 'selected' : '') }}>O-</option>
            </select>
            <span class="text-danger">{{$errors->first('blood_group')}}</span>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-4">
            <label for="InputStatus">Status <span class="text-danger">*</span></label>
            <select disabled id="status" class="form-control" required>
                <option value="">Select Status</option>
                <option value="1" {{ isset($record) ? ($record->status == '1' ? 'selected' : '') : (old('status') == '1' ? 'selected' : '') }}>Active</option>
                <option value="0" {{ isset($record) ? ($record->status == '0' ? 'selected' : '') : (old('status') == '0' ? 'selected' : '') }}>Inactive</option>
            </select>
            <span class="text-danger">{{$errors->first('status')}}</span>
        </div>
        <div class="form-group col-4">
            <label for="InputHeight">Height <span class="text-danger">*</span></label>
            <input type="number" value="{{ old('height') ?? (isset($record) ? $record->height : '') }}" name="height" class="form-control" id="InputHeight" placeholder="Enter height" required>
            <span class="text-danger">{{$errors->first('height')}}</span>
        </div>
        <div class="form-group col-4">
            <label for="InputWeight">Weight <span class="text-danger">*</span></label>
            <input type="number" value="{{ old('weight') ?? (isset($record) ? $record->weight : '') }}" name="weight" class="form-control" id="InputWeight" placeholder="Enter weight" required>
            <span class="text-danger">{{$errors->first('weight')}}</span>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-12">
            <label for="InputEmail">Email <span class="text-danger">*</span></label>
            <input type="email" value="{{ old('email') ?? (isset($record) ? $record->email : '') }}" name="email" class="form-control" id="InputEmail" placeholder="Enter email" required>
            <span class="text-danger">{{$errors->first('email')}}</span>
        </div>
    </div>
</div>