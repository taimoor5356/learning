<div class="card-body">

    <div class="row">
        <div class="offset-6"></div>
        <div class="form-group col-3">
            <label for="InputProfilePicture">Profile Picture <span class="text-danger">*</span></label>
            <input type="file" name="profile_pic" class="form-control" id="InputProfilePicture">
            <span class="text-danger">{{$errors->first('profile_pic')}}</span>
            <div class="row mt-2">
                <div class="col-12">
                    <img src="@isset($record){{$record->getProfilePic()}}@else{{url('public/images/avatar.png')}}@endisset" class="border rounded" width="100px" height="100px" alt="">
                </div>
            </div>
        </div>
        <div class="form-group col-3">
            <label for="InputFeeSlipPicture">Fee Slip <span class="text-danger">*</span></label>
            <input type="file" name="fee_slip" class="form-control" id="InputFeeSlipPicture">
            <span class="text-danger">{{$errors->first('fee_slip')}}</span>
            <div class="row mt-2">
                <div class="col-12">
                    <img src="" class="border rounded" width="100px" height="100px" alt="">
                </div>
            </div>
        </div>
        <!-- <div class="form-group col-3">
            <label for="InputBatchStartingDate">Batch starting date <span class="text-danger">*</span></label>
            <input type="date" value="{{ old('batch_starting_date') ?? (isset($record) ? $record->batch_starting_date : '') }}" disabled class="form-control" id="InputBatchStartingDate" >
            <span class="text-danger">{{$errors->first('batch_starting_date')}}</span>
        </div> -->
    </div>
    <div class="row">
        <div class="form-group col-3">
            <label for="InputFullName">Full Name <span class="text-danger">*</span></label>
            <input type="text" value="{{ old('name') ?? (isset($record) ? $record->name : '') }}" name="name" class="form-control" id="InputFullName" placeholder="Enter full name">
            <span class="text-danger">{{$errors->first('name')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputGender">Gender <span class="text-danger">*</span></label>
            <select name="gender" id="InputGender" class="form-control">
                <option value="">Select Gender</option>
                <option value="male" {{ isset($record) ? ($record->gender == 'male' ? 'selected' : '') : (old('gender') == 'male' ? 'selected' : '') }}>Male</option>
                <option value="female" {{ isset($record) ? ($record->gender == 'female' ? 'selected' : '') : (old('gender') == 'female' ? 'selected' : '') }}>Female</option>
            </select>
            <span class="text-danger">{{$errors->first('gender')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputFatherName">Father Name <span class="text-danger">*</span></label>
            <input type="text" value="{{ old('father_name') ?? (isset($record) ? $record->father_name : '') }}" name="father_name" class="form-control" id="InputFatherName" placeholder="Enter father name">
            <span class="text-danger">{{$errors->first('father_name')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputDateOfBirth">Date of Birth <span class="text-danger">*</span></label>
            <input type="date" name="date_of_birth" class="form-control" id="InputDateOfBirth" value="{{ old('date_of_birth') ?? (isset($record) ? $record->date_of_birth : '') }}">
            <span class="text-danger">{{$errors->first('date_of_birth')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputRollNo">Roll Number <span class="text-danger">*</span></label>
            <input type="text" value="{{ old('roll_number') ?? (isset($record) ? $record->roll_number : '') }}" disabled class="form-control" id="InputRollNo" placeholder="Enter roll number">
            <span class="text-danger">{{$errors->first('roll_number')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputCnic">CNIC <span class="text-danger">*</span></label>
            <input type="number" value="{{ old('cnic') ?? (isset($record) ? $record->cnic : '') }}" name="cnic" class="form-control" id="InputCnic" placeholder="Enter cnic">
            <span class="text-danger">{{$errors->first('cnic')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputFatherOccupation">Father Occupation <span class="text-danger">*</span></label>
            <input type="text" value="{{ old('father_occupation') ?? (isset($record) ? $record->father_occupation : '') }}" name="father_occupation" class="form-control" id="InputFatherOccupation" placeholder="Enter father occupation">
            <span class="text-danger">{{$errors->first('father_occupation')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputDomicile">Select Domicile <span class="text-danger">*</span></label>
            <select class="form-control" id="InputDomicile" name="domicile">
                <option value="">Select Domicile</option>
                <option value="isb" {{ isset($record) ? ($record->domicile == 'isb' ? 'selected' : '') : (old('domicile') == 'isb' ? 'selected' : '') }}>Islamabad</option>
                <option value="punjab" {{ isset($record) ? ($record->domicile == 'punjab' ? 'selected' : '') : (old('domicile') == 'punjab' ? 'selected' : '') }}>Punjab</option>
                <option value="sindh" {{ isset($record) ? ($record->domicile == 'sindh' ? 'selected' : '') : (old('domicile') == 'sindh' ? 'selected' : '') }}>Sindh</option>
                <option value="balochistan" {{ isset($record) ? ($record->domicile == 'balochistan' ? 'selected' : '') : (old('domicile') == 'balochistan' ? 'selected' : '') }}>Balochistan</option>
                <option value="kpk" {{ isset($record) ? ($record->domicile == 'kpk' ? 'selected' : '') : (old('domicile') == 'kpk' ? 'selected' : '') }}>KPK</option>
            </select>
            <span class="text-danger">{{$errors->first('domicile')}}</span>
        </div>
    </div>
    <hr>
    <div class="row degree-qualification">
        @php
        $qualifications = isset($record) ? json_decode($record->qualification) : array();
        @endphp
        @if (!empty($qualifications))
        @foreach ($qualifications as $key => $qualification)
        <div class="all-cols-degree-qualification container-fluid">
            <div class="row">
                <div class="form-group col-2">
                    <label for="InputDegree">Certificate/Degree <span class="text-danger">*</span></label>
                    <input type="text" value="{{ old('degree') ?? (isset($record) ? $qualification->degree : '') }}" class="form-control" id="InputDegree" placeholder="Enter certificate/degree name" name="degree[]">
                    <span class="text-danger">{{$errors->first('degree')}}</span>
                </div>
                <div class="form-group col-3">
                    <label for="InputMajorSubjects">Major Subjects <span class="text-danger">*</span></label>
                    <input type="text" value="{{ old('major_subjects') ?? (isset($record) ? $qualification->major_subjects : '') }}" class="form-control" id="InputMajorSubjects" placeholder="Enter subjects name" name="major_subjects[]">
                    <span class="text-danger">{{$errors->first('major_subjects')}}</span>
                </div>
                <div class="form-group col-2">
                    <label for="InputCgpa">CGPA/Percentage <span class="text-danger">*</span></label>
                    <input type="text" value="{{ old('cgpa') ?? (isset($record) ? $qualification->cgpa : '') }}" class="form-control" id="InputCgpa" placeholder="Enter CGPA/Percentage" name="cgpa[]">
                    <span class="text-danger">{{$errors->first('cgpa')}}</span>
                </div>
                <div class="form-group col-4">
                    <label for="InputUniversityName">Institute Name <span class="text-danger">*</span></label>
                    <input type="text" value="{{ old('university_name') ?? (isset($record) ? $qualification->university_name : '') }}" class="form-control" id="InputUniversityName" placeholder="Enter institute name" name="university_name[]">
                    <span class="text-danger">{{$errors->first('university_name')}}</span>
                </div>
                <div class="form-group col-1 d-flex justify-content-end">
                    <div>
                        <label for="InputUniversityName"></label>
                        <br>
                        @if ($key == 0)
                        <button type="button" class="btn btn-primary mt-2" id="add-new-qualification">+</button>
                        @else
                        <button type="button" class="btn btn-danger remove-qualification mt-2">-</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @else
        <div class="all-cols-degree-qualification container-fluid">
            <div class="row">
                <div class="form-group col-2">
                    <label for="InputDegree">Certificate/Degree <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="InputDegree" placeholder="Enter degree name" name="degree[]">
                    <span class="text-danger">{{$errors->first('degree')}}</span>
                </div>
                <div class="form-group col-3">
                    <label for="InputMajorSubjects">Major Subjects <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="InputMajorSubjects" placeholder="Enter subjects name" name="major_subjects[]">
                    <span class="text-danger">{{$errors->first('major_subjects')}}</span>
                </div>
                <div class="form-group col-2">
                    <label for="InputCgpa">CGPA/Percentage <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="InputCgpa" placeholder="Enter CGPA" name="cgpa[]">
                    <span class="text-danger">{{$errors->first('cgpa')}}</span>
                </div>
                <div class="form-group col-4">
                    <label for="InputUniversityName">School/College/University Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="InputUniversityName" placeholder="Enter university name" name="university_name[]">
                    <span class="text-danger">{{$errors->first('university_name')}}</span>
                </div>
                <div class="form-group col-1 d-flex justify-content-end">
                    <div>
                        <label for="InputUniversityName"></label>
                        <br>
                        <button type="button" class="btn btn-primary mt-2" id="add-new-qualification">+</button>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    <hr>
    <div class="row">
        <div class="form-group col-3">
            <label for="InputCurrentAddress">Current address <span class="text-danger">*</span></label>
            <input type="text" value="{{ old('current_address') ?? (isset($record) ? $record->current_address : '') }}" name="current_address" class="form-control" id="InputCurrentAddress" placeholder="Enter current address">
            <span class="text-danger">{{$errors->first('current_address')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputPermanentAddress">Permanent Address <span class="text-danger">*</span></label>
            <input type="text" value="{{ old('permanent_address') ?? (isset($record) ? $record->permanent_address : '') }}" name="permanent_address" class="form-control" id="InputPermanentAddress" placeholder="Enter permanent address">
            <span class="text-danger">{{$errors->first('permanent_address')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputEmail">Email <span class="text-danger">*</span></label>
            <input type="email" value="{{ old('email') ?? (isset($record) ? $record->email : '') }}" name="email" class="form-control" id="InputEmail" placeholder="Enter email">
            <span class="text-danger">{{$errors->first('email')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputPassword">Password <span class="text-danger">*</span></label>
            <input type="password" value="{{ old('password') }}" name="password" class="form-control" id="InputPassword" placeholder="Enter password">
            <span class="text-danger">{{$errors->first('password')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputWhatsAppNumber">WhatsApp Number <span class="text-danger">*</span></label>
            <input type="number" value="{{ old('whatsapp_number') ?? (isset($record) ? $record->whatsapp_number : '') }}" name="whatsapp_number" class="form-control" id="InputWhatsAppNumber" placeholder="Enter whatsapp number">
            <span class="text-danger">{{$errors->first('whatsapp_number')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputWhatsAppNumber">Join WhatsApp Group <span class="text-danger">*</span></label>
            <br>
            <a href="#" class="btn btn-default w-100">Join WhatsApp Group Now!</a>
        </div>
        <div class="form-group col-3">
            <label for="InputMobileNumber">Mobile Number <span class="text-danger">*</span></label>
            <input type="number" value="{{ old('mobile_number') ?? (isset($record) ? $record->mobile_number : '') }}" name="mobile_number" class="form-control" id="InputMobileNumber" placeholder="Enter mobile number">
            <span class="text-danger">{{$errors->first('mobile_number')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputContactNumber">Emergency Contact Number <span class="text-danger">*</span></label>
            <input type="number" value="{{ old('emergency_contact_number') ?? (isset($record) ? $record->emergency_contact_number : '') }}" name="emergency_contact_number" class="form-control" id="InputContactNumber" placeholder="Enter emergency contact number">
            <span class="text-danger">{{$errors->first('emergency_contact_number')}}</span>
        </div>

        <div class="form-group col-3">
            <label for="InputMaritalStatus">Select Marital Status <span class="text-danger">*</span></label>
            <select class="form-control" id="InputMaritalStatus" name="marital_status">
                <option value="">Select Marital Status</option>
                <option value="un_married" {{ isset($record) ? ($record->marital_status == 'un_married' ? 'selected' : '') : (old('marital_status') == 'un_married' ? 'selected' : '') }}>Un Married</option>
                <option value="married" {{ isset($record) ? ($record->marital_status == 'married' ? 'selected' : '') : (old('marital_status') == 'married' ? 'selected' : '') }}>Married</option>
            </select>
            <span class="text-danger">{{$errors->first('marital_status')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputWorkExperience">Profession/Work Experience <span class="text-danger">*</span></label>
            <input type="text" value="{{ old('work_experience') ?? (isset($record) ? $record->work_experience : '') }}" name="work_experience" class="form-control" id="InputWorkExperience" placeholder="Enter work experience">
            <span class="text-danger">{{$errors->first('work_experience')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputShortNote">Short Note <span class="text-danger">*</span></label>
            <input type="text" value="{{ old('note') ?? (isset($record) ? $record->note : '') }}" name="note" class="form-control" id="InputShortNote" placeholder="Enter short note">
            <span class="text-danger">{{$errors->first('note')}}</span>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-6">
            <small class="font-weight-bold">Rules and Regulation <input type="checkbox" name="rules_regulations" value="1" @isset($record) @if($record->rules_regulations == '1') checked @endif @endisset></small>
            <p class="text-danger" style="font-size: 12px">Dues once paid are neither refundable nor adjustable in any case. Any damage caused by the student will be charged accordingly. Institution will not in any case be responsible for any loss suffered by a student. Morally presentable dress code is to be observed.</p>
        </div>
        <div class="form-group col-6">
            <small class="font-weight-bold">Declaration <input type="checkbox" name="declaration" value="1" @isset($record) @if($record->declaration == '1') checked @endif @endisset></small>
            <p class="text-danger my-0" style="font-size: 12px">
                1. I hereby certify that the information give here is authentic to the best of my knowledge and belief.
            </p>
            <p class="text-danger my-0" style="font-size: 12px">
                2. Undertake that I will abide by all the rules and regulations of the institute and those that will be implemented in figure.
            </p>
            <p class="text-danger my-0" style="font-size: 12px">
                3. Acknowledge that the administration reserves the right to expel the student without any refund of fee for voilating the rules of the institute.
            </p>
            <p class="text-danger my-0" style="font-size: 12px">
                4. Therefore, agree to uphold all the rules and regulations and co-operate with administration and teachers.
            </p>
        </div>

        <!---------------------->
        <!-- Academic Details -->
        <!---------------------->

        <!-- <div class="form-group col-3">
            <label for="InputClass">Select Class <span class="text-danger">*</span></label>
            <select disabled class="form-control" id="InputClass">
                <option value="">Select Class</option>
                @foreach($classes as $key => $class)
                <option value="{{$class->id}}" {{ isset($record) ? ($class->id == $record->class_id ? 'selected' : '') : (old('class_id') == $class->id ? 'selected' : '') }}>{{$class->name}}</option>
                @endforeach
            </select>
            <span class="text-danger">{{$errors->first('class_id')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputClassType">Class Type <span class="text-danger">*</span></label>
            <select disabled id="InputClassType" class="form-control">
                <option value="">Select Class Type</option>
                <option value="on_campus" {{ isset($record) ? ($record->class_type == 'on_campus' ? 'selected' : '') : (old('class_type') == 'on_campus' ? 'selected' : '') }}>On Campus</option>
                <option value="online" {{ isset($record) ? ($record->class_type == 'online' ? 'selected' : '') : (old('class_type') == 'online' ? 'selected' : '') }}>Onlie</option>
            </select>
            <span class="text-danger">{{$errors->first('class_type')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputClassProgram">Select Class Program <span class="text-danger">*</span></label>
            <select class="form-control" id="InputClassProgram" disabled>
                <option value="">Select Class Program</option>
                <option value="css" {{ isset($record) ? ($record->class_program == 'css' ? 'selected' : '') : (old('class_program') == 'css' ? 'selected' : '') }}>CSS</option>
                <option value="pms" {{ isset($record) ? ($record->class_program == 'pms' ? 'selected' : '') : (old('class_program') == 'pms' ? 'selected' : '') }}>PMS</option>
                <option value="examination" {{ isset($record) ? ($record->class_program == 'examination' ? 'selected' : '') : (old('class_program') == 'examination' ? 'selected' : '') }}>Examination</option>
                <option value="interview" {{ isset($record) ? ($record->class_program == 'interview' ? 'selected' : '') : (old('class_program') == 'interview' ? 'selected' : '') }}>Interview</option>
                <option value="others" {{ isset($record) ? ($record->class_program == 'others' ? 'selected' : '') : (old('class_program') == 'others' ? 'selected' : '') }}>Others</option>
            </select>
            <span class="text-danger">{{$errors->first('class_program')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputInterview">Select Interview Type <span class="text-danger">*</span></label>
            <select class="form-control" id="InputInterview" disabled>
                <option value="">Select Interview Type</option>
                <option value="class" {{ isset($record) ? ($record->interview_type == 'class' ? 'selected' : '') : (old('interview_type') == 'class' ? 'selected' : '') }}>Class</option>
                <option value="mock" {{ isset($record) ? ($record->interview_type == 'mock' ? 'selected' : '') : (old('interview_type') == 'mock' ? 'selected' : '') }}>Mock</option>
            </select>
            <span class="text-danger">{{$errors->first('interview_type')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputExam">Select Exam <span class="text-danger">*</span></label>
            <select disabled class="form-control" id="InputExam">
                <option value="">Select Exam</option>
                @if(!empty($exams))
                @foreach($exams as $key => $exam)
                <option value="{{$exam->id}}" {{ isset($record) ? ($exam->id == $record->exam_id ? 'selected' : '') : (old('exam_id') == $exam->id ? 'selected' : '') }}>{{$exam->name}}</option>
                @endforeach
                @endif
            </select>
            <span class="text-danger">{{$errors->first('exam_id')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputDiscountedAmount">Discounted Amount <span class="text-danger">*</span></label>
            <input type="number" disabled class="form-control" id="InputDiscountedAmount" value="{{ old('discounted_amount') ?? (isset($record) ? $record->discounted_amount : '') }}" placeholder="Enter discounted amount">
            <span class="text-danger">{{$errors->first('discounted_amount')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputDiscountReason">Discount Reason <span class="text-danger">*</span></label>
            <input type="text" disabled class="form-control" id="InputDiscountReason" value="{{ old('discount_reason') ?? (isset($record) ? $record->discount_reason : '') }}" placeholder="Enter discount reason">
            <span class="text-danger">{{$errors->first('discount_reason')}}</span>
        </div> -->
        <!-- <div class="form-group col-3">
            <label for="InputOptionalSubjects">Optional Subjects <span class="text-danger">*</span></label>
            <span class="text-danger">{{$errors->first('optional_subjects')}}</span>
        </div> -->
    </div>
    <hr>
    @if (isset($record))
    @if ($record->class_program == 'examination')
    <!-- Written Exam Form -->
    <div class="row">
        <div class="col-12">
            <h5 class="my-2 p-2 bg-primary rounded">Written Exam Information
            </h5>
        </div>
        <div class="col-6">
            <label for="InputWrittenExamSerialNumber">Written Exam Serial Number</label>
            <br>
            <input value="{{ old('written_exam_serial_number') ?? (isset($record) ? $record->written_exam_serial_number : '') }}" type="text" name="written_exam_serial_number" id="InputWrittenExamSerialNumber" class="form-control" placeholder="Enter your written exam serial number">
        </div>
        <div class="col-6">
            <label for="InputWrittenExamRollNumber">Written Exam Roll Number</label>
            <br>
            <input value="{{ old('exam_roll_number') ?? (isset($record) ? $record->exam_roll_number : '') }}" type="text" name="exam_roll_number" id="InputWrittenExamRollNumber" class="form-control" placeholder="Enter your written exam roll number">
        </div>
        <div class="col-3">
            <label for="InputWrittenExamApplyingFor">Applying For</label>
            <br>
            <select name="full_interview_mock_preparation" id="InputWrittenExamApplyingFor" class="form-control">
                <option value="">Applying For</option>
                <option value="full_interview" {{ isset($record) ? ($record->full_interview_mock_preparation == 'full_interview' ? 'selected' : '') : (old('full_interview_mock_preparation') == 'full_interview' ? 'selected' : '') }}>Full Interview Preparation</option>
                <option value="mock_preparation" {{ isset($record) ? ($record->full_interview_mock_preparation == 'mock_preparation' ? 'selected' : '') : (old('full_interview_mock_preparation') == 'mock_preparation' ? 'selected' : '') }}>Mock Preparation</option>
            </select>
        </div>
        <div class="col-3">
            <label for="InputWrittenExamMockInterview">Select Mock Interview</label>
            <select name="mock_interview" id="InputWrittenExamMockInterview" class="form-control">
                <option value="">Select Mock Interview</option>
                <option value="1" {{ isset($record) ? ($record->mock_interview == '1' ? 'selected' : '') : (old('mock_interview') == '1' ? 'selected' : '') }}>1</option>
                <option value="2" {{ isset($record) ? ($record->mock_interview == '2' ? 'selected' : '') : (old('mock_interview') == '2' ? 'selected' : '') }}>2</option>
                <option value="3" {{ isset($record) ? ($record->mock_interview == '3' ? 'selected' : '') : (old('mock_interview') == '3' ? 'selected' : '') }}>3</option>
            </select>
        </div>
        <div class="col-3">
            <label for="InputMockInterviewDateTime">Mock Interview Date</label>
            <br>
            <input type="date" value="{{ old('mock_interview_date') ?? (isset($record) ? $record->mock_interview_date : '') }}" name="mock_interview_date" id="InputMockInterviewDateTime" class="form-control">
        </div>
        <div class="col-3">
            <label for="InputMockInterviewDateTime">Mock Interview Time</label>
            <br>
            <input value="{{ old('mock_interview_time') ?? (isset($record) ? $record->mock_interview_time : '') }}" type="time" name="mock_interview_time" id="InputMockInterviewDateTime" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="col-3">
            <label for="InputWrittenExamPreparation">Written Exam Preparation from CSPs</label>
            <br>
            <input type="checkbox" name="written_exam_preparation_from_csps" id="InputWrittenExamPreparation" {{ isset($record) ? ($record->written_exam_preparation_from_csps ? 'checked' : '') : (old('written_exam_preparation_from_csps') ? 'checked' : '') }}>
        </div>
        <div class="col-3">
            <label for="InputJoinWhatsAppGroup">Join WhatsApp Group</label>
            <br>
            <input type="checkbox" name="join_whatsapp_group" id="InputJoinWhatsAppGroup" {{ isset($record) ? ($record->join_whatsapp_group ? 'checked' : '') : (old('join_whatsapp_group') ? 'checked' : '') }}>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="form-group col-6">
            <input type="checkbox" name="rules_regulations_policies" value="1" @isset($record) @if($record->rules_regulations_policies == '1') checked @endif @endisset> <small class="font-weight-bold">All the rules, regulations will follow and policies of institution are acceptable </small>
        </div>
    </div>
    @endif
    @endif
</div>