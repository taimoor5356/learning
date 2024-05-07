<div class="card-body">
    <div class="row">
        <div class="form-group col-4">
            <label for="InputFullName">Full Name <span class="text-danger">*</span></label>
            <input type="text" value="{{ old('name') ?? (isset($record) ? $record->name : '') }}" name="name" class="form-control" id="InputFullName" placeholder="Enter full name" required>
            <span class="text-danger">{{$errors->first('name')}}</span>
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
            <label for="InputAdmissionDate">Date of Joining <span class="text-danger">*</span></label>
            <input type="date" value="{{ old('admission_date') ?? (isset($record) ? $record->admission_date : '') }}" name="admission_date" class="form-control" id="InputAdmissionDate" placeholder="Enter admission date" required>
            <span class="text-danger">{{$errors->first('admission_date')}}</span>
        </div>
        <div class="form-group col-4">
            <label for="InputMobileNumber">Mobile Number <span class="text-danger">*</span></label>
            <input type="number" value="{{ old('mobile_number') ?? (isset($record) ? $record->mobile_number : '') }}" name="mobile_number" class="form-control" id="InputMobileNumber" placeholder="Enter mobile number" required>
            <span class="text-danger">{{$errors->first('mobile_number')}}</span>
        </div>
        <div class="form-group col-4">
            <label for="InputMaritalStatus">Marital Status <span class="text-danger">*</span></label>
            <select name="marital_status" id="InputMaritalStatus" class="form-control" required>
                <option value="">Select Marital Status</option>
                <option value="married" {{ isset($record) ? ($record->marital_status == 'married' ? 'selected' : '') : (old('marital_status') == 'married' ? 'selected' : '') }}>Married</option>
                <option value="un_married" {{ isset($record) ? ($record->marital_status == 'un_married' ? 'selected' : '') : (old('marital_status') == 'un_married' ? 'selected' : '') }}>Un Married</option>
            </select>
            <span class="text-danger">{{$errors->first('status')}}</span>
        </div>
    </div>
    <div class="row">
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
        <div class="form-group col-4">
            <label for="InputCurrentAddress">Current Address <span class="text-danger">*</span></label>
            <input type="text" value="{{ old('current_address') ?? (isset($record) ? $record->current_address : '') }}" name="current_address" class="form-control" id="InputCurrentAddress" placeholder="Enter current address" required>
            <span class="text-danger">{{$errors->first('current_address')}}</span>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-4">
            <label for="InputPermanentAddress">Permanent Address <span class="text-danger">*</span></label>
            <input type="text" value="{{ old('permanent_address') ?? (isset($record) ? $record->permanent_address : '') }}" name="permanent_address" class="form-control" id="InputPermanentAddress" placeholder="Enter permanent address" required>
            <span class="text-danger">{{$errors->first('permanent_address')}}</span>
        </div>
        <div class="form-group col-4">
            <label for="InputQualification">Qualification <span class="text-danger">*</span></label>
            <input type="text" value="{{ old('qualification') ?? (isset($record) ? $record->qualification : '') }}" name="qualification" class="form-control" id="InputQualification" placeholder="Enter qualification" required>
            <span class="text-danger">{{$errors->first('qualification')}}</span>
        </div>
        <div class="form-group col-4">
            <label for="InputWorkExperience">Work Experience <span class="text-danger">*</span></label>
            <input type="text" value="{{ old('work_experience') ?? (isset($record) ? $record->work_experience : '') }}" name="work_experience" class="form-control" id="InputWorkExperience" placeholder="Enter work experience" required>
            <span class="text-danger">{{$errors->first('work_experience')}}</span>
        </div>
        <div class="form-group col-4">
            <label for="InputNote">Note <span class="text-danger">*</span></label>
            <input type="text" value="{{ old('note') ?? (isset($record) ? $record->note : '') }}" name="note" class="form-control" id="InputNote" placeholder="Enter note" required>
            <span class="text-danger">{{$errors->first('note')}}</span>
        </div>
        <div class="form-group col-4">
            <label for="InputStatus">Status <span class="text-danger">*</span></label>
            <select name="status" id="status" class="form-control" required>
                <option value="">Select Status</option>
                <option value="1" {{ isset($record) ? ($record->status == '1' ? 'selected' : '') : (old('status') == '1' ? 'selected' : '') }}>Active</option>
                <option value="0" {{ isset($record) ? ($record->status == '0' ? 'selected' : '') : (old('status') == '0' ? 'selected' : '') }}>Inactive</option>
            </select>
            <span class="text-danger">{{$errors->first('status')}}</span>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-12">
            <label for="InputEmail">Email <span class="text-danger">*</span></label>
            <input type="email" value="{{ old('email') ?? (isset($record) ? $record->email : '') }}" name="email" class="form-control" id="InputEmail" placeholder="Enter email" required>
            <span class="text-danger">{{$errors->first('email')}}</span>
        </div>
        <div class="form-group col-12">
            <label for="InputPassword">Password <span class="text-danger">*</span></label>
            <input type="password" value="{{ old('password') }}" name="password" class="form-control" id="InputPassword" placeholder="Enter password">
            <span class="text-danger">{{$errors->first('password')}}</span>
        </div>
    </div>
</div>