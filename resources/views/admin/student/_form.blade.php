@if(Auth::user()->user_type == 1)
<div class="card-body">
    <div class="row">
        <!-- <div class="form-group col-3">
            <label for="InputProfilePicture">Profile Picture <span class="text-danger">*</span></label>
            <input type="file" value="{{ old('profile_pic') ?? (isset($record) ? $record->profile_pic : '') }}" name="profile_pic" class="form-control" id="InputProfilePicture">
            <span class="text-danger">{{$errors->first('profile_pic')}}</span>
            <div class="row mt-2">
                <div class="col-12">
                    <img src="@isset($record){{$record->getProfilePic()}}@else{{url('public/images/avatar.png')}}@endisset" class="border rounded" width="100px" height="100px" alt="">
                </div>
            </div>
        </div>
        <div class="form-group col-3">
            <label for="InputProfilePicture">Fee Slip <span class="text-danger">*</span></label>
            <input type="file" value="{{ old('profile_pic') ?? (isset($record) ? $record->profile_pic : '') }}" name="profile_pic" class="form-control" id="InputProfilePicture">
            <span class="text-danger">{{$errors->first('profile_pic')}}</span>
            <div class="row mt-2">
                <div class="col-12">
                    <img src="@isset($record){{$record->getProfilePic()}}@else{{url('public/images/avatar.png')}}@endisset" class="border rounded" width="100px" height="100px" alt="">
                </div>
            </div>
        </div> -->
        <div class="form-group col-3 offset-9">
            <label for="InputBatchStartingDate">Batch starting date <span class="text-danger">*</span></label>
            <input type="date" value="{{ old('batch_starting_date') ?? (isset($record) ? $record->batch_starting_date : '') }}" name="batch_starting_date" class="form-control" id="InputBatchStartingDate" required>
            <span class="text-danger">{{$errors->first('batch_starting_date')}}</span>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-3">
            <label for="InputFullName">Full Name <span class="text-danger">*</span></label>
            <input type="text" value="{{ old('name') ?? (isset($record) ? $record->name : '') }}" name="name" class="form-control" id="InputFullName" placeholder="Enter full name" >
            <span class="text-danger">{{$errors->first('name')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputMobileNumber">Mobile Number <span class="text-danger">*</span></label>
            <input type="number" value="{{ old('mobile_number') ?? (isset($record) ? $record->mobile_number : '') }}" name="mobile_number" class="form-control" id="InputMobileNumber" placeholder="Enter mobile number" >
            <span class="text-danger">{{$errors->first('mobile_number')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputGender">Gender <span class="text-danger">*</span></label>
            <select name="gender" id="InputGender" class="form-control" >
                <option value="">Select Gender</option>
                <option value="male" {{ isset($record) ? ($record->gender == 'male' ? 'selected' : '') : (old('gender') == 'male' ? 'selected' : '') }}>Male</option>
                <option value="female" {{ isset($record) ? ($record->gender == 'female' ? 'selected' : '') : (old('gender') == 'female' ? 'selected' : '') }}>Female</option>
            </select>
            <span class="text-danger">{{$errors->first('gender')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputUserType">User Type <span class="text-danger">*</span></label>
            <select name="user_type" class="form-control" id="InputUserType">
                <option value="" disabled>Select User Type</option>
                <option selected value="3" {{ isset($record) ? ($record->user_type == '3' ? 'selected' : '') : (old('user_type') == '3' ? 'selected' : '') }}>Student</option>
            </select>
            <span class="text-danger">{{$errors->first('user_type')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputYear">Year <span class="text-danger">*</span></label>
            <select name="class_year" id="InputYear" class="form-control" required>
                <option value="">Select Year</option>
                <option value="css_2024" {{ isset($record) ? ($record->class_year == 'css_2024' ? 'selected' : '') : (old('year') == 'css_2024' ? 'selected' : '') }}>CSS 2024</option>
                <option value="pms_2024" {{ isset($record) ? ($record->class_year == 'pms_2024' ? 'selected' : '') : (old('year') == 'pms_2024' ? 'selected' : '') }}>PMS 2024</option>
                <option value="css_2025" {{ isset($record) ? ($record->class_year == 'css_2025' ? 'selected' : '') : (old('year') == 'css_2025' ? 'selected' : '') }}>CSS 2025</option>
                <option value="pms_2025" {{ isset($record) ? ($record->class_year == 'pms_2025' ? 'selected' : '') : (old('year') == 'pms_2025' ? 'selected' : '') }}>PMS 2025</option>
                <option value="css_2026" {{ isset($record) ? ($record->class_year == 'css_2026' ? 'selected' : '') : (old('year') == 'css_2026' ? 'selected' : '') }}>CSS 2026</option>
                <option value="pms_2026" {{ isset($record) ? ($record->class_year == 'pms_2026' ? 'selected' : '') : (old('year') == 'pms_2026' ? 'selected' : '') }}>PMS 2026</option>
                <option value="css_2027" {{ isset($record) ? ($record->class_year == 'css_2027' ? 'selected' : '') : (old('year') == 'css_2027' ? 'selected' : '') }}>CSS 2027</option>
                <option value="pms_2027" {{ isset($record) ? ($record->class_year == 'pms_2027' ? 'selected' : '') : (old('year') == 'pms_2027' ? 'selected' : '') }}>PMS 2027</option>
                <option value="css_2028" {{ isset($record) ? ($record->class_year == 'css_2028' ? 'selected' : '') : (old('year') == 'css_2028' ? 'selected' : '') }}>CSS 2028</option>
                <option value="pms_2028" {{ isset($record) ? ($record->class_year == 'pms_2028' ? 'selected' : '') : (old('year') == 'pms_2028' ? 'selected' : '') }}>PMS 2028</option>
                <option value="css_2029" {{ isset($record) ? ($record->class_year == 'css_2029' ? 'selected' : '') : (old('year') == 'css_2029' ? 'selected' : '') }}>CSS 2029</option>
                <option value="pms_2029" {{ isset($record) ? ($record->class_year == 'pms_2029' ? 'selected' : '') : (old('year') == 'pms_2029' ? 'selected' : '') }}>PMS 2029</option>
                <option value="css_2030" {{ isset($record) ? ($record->class_year == 'css_2030' ? 'selected' : '') : (old('year') == 'css_2030' ? 'selected' : '') }}>CSS 2030</option>
                <option value="pms_2030" {{ isset($record) ? ($record->class_year == 'pms_2030' ? 'selected' : '') : (old('year') == 'pms_2030' ? 'selected' : '') }}>PMS 2030</option>
            </select>
            <span class="text-danger">{{$errors->first('gender')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputBatchNumber">Enter Batch <span class="text-danger">*</span></label>
            <select name="batch_number" id="InputBatchNumber" class="form-control">
                <option value="">Select Batch</option>
                @foreach ($batches as $batch)
                <option value="{{$batch->id}}" data-batch-number="{{$batch->name}}" {{ isset($record) ? ($record->batch_number == $batch->id ? 'selected' : '') : (old('batch_number') == $batch->id ? 'selected' : '') }}>{{$batch->name}}</option>
                @endforeach
            </select>
            <!-- <input type="text" class="form-control" name="batch_number" placeholder="Enter batch number" id="InputBatchNumber" value="{{ old('batch_number') ?? (isset($record) ? $record->batch_number : '') }}" required> -->
            <span class="text-danger">{{$errors->first('batch_number')}}</span>
        </div>
        <input type="hidden" id="user_id" value="{{ old('id') ?? (isset($record) ? $record->id : '') }}">
        <!-- <div class="form-group col-3">
            <label for="InputAdmissionNumber">Admission Number <span class="text-danger">*</span></label>
            <input type="text" value="{{ old('admission_number') ?? (isset($record) ? $record->admission_number : '') }}" name="admission_number" class="form-control" id="InputAdmissionNumber" placeholder="Enter admission number">
            <span class="text-danger">{{$errors->first('admission_number')}}</span>
        </div> -->
        <div class="form-group col-3">
            <label for="InputRollNo">Roll Number <span class="text-danger">*</span></label>
            <input type="text" value="{{ old('roll_number') ?? (isset($record) ? $record->roll_number : '') }}" name="roll_number" class="form-control" id="InputRollNo" readonly required>
            <span class="text-danger">{{$errors->first('roll_number')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputEmail">Email <span class="text-danger">*</span></label>
            <input type="email" value="{{ old('email') ?? (isset($record) ? $record->email : '') }}" name="email" class="form-control" id="InputEmail" placeholder="Enter email">
            <span class="text-danger">{{$errors->first('email')}}</span>
        </div>
        <div class="form-group col-6">
            <label for="InputClassType">Class Type <span class="text-danger">*</span></label>
            <select name="class_type" id="InputClassType" class="form-control" required>
                <option value="">Select Class Type</option>
                <option value="on_campus" {{ isset($record) ? ($record->class_type == 'on_campus' ? 'selected' : '') : (old('class_type') == 'on_campus' ? 'selected' : '') }}>On Campus</option>
                <option value="online" {{ isset($record) ? ($record->class_type == 'online' ? 'selected' : '') : (old('class_type') == 'online' ? 'selected' : '') }}>Onlie</option>
            </select>
            <span class="text-danger">{{$errors->first('class_type')}}</span>
        </div>
        <div class="form-group col-6">
            <label for="InputClassProgram">Select Class Program <span class="text-danger">*</span></label>
            <select class="form-control" id="InputClassProgram" name="class_program" required>
                <option value="">Select Class Program</option>
                <option value="css" {{ isset($record) ? ($record->class_program == 'css' ? 'selected' : '') : (old('class_program') == 'css' ? 'selected' : '') }}>CSS</option>
                <option value="pms" {{ isset($record) ? ($record->class_program == 'pms' ? 'selected' : '') : (old('class_program') == 'pms' ? 'selected' : '') }}>PMS</option>
                <option value="examination" {{ isset($record) ? ($record->class_program == 'examination' ? 'selected' : '') : (old('class_program') == 'examination' ? 'selected' : '') }}>Examination</option>
                <option value="interview" {{ isset($record) ? ($record->class_program == 'interview' ? 'selected' : '') : (old('class_program') == 'interview' ? 'selected' : '') }}>Interview</option>
                <option value="others" {{ isset($record) ? ($record->class_program == 'others' ? 'selected' : '') : (old('class_program') == 'others' ? 'selected' : '') }}>Others</option>
            </select>
            <span class="text-danger">{{$errors->first('class_program')}}</span>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-3">
            <label for="InputAppliedFor">Applying for <span class="text-danger">*</span></label>
            <select name="applied_for" class="form-control" id="InputAppliedFor" required>
                <option value="">Applying for</option>
                <option value="written_exam" {{ isset($record) ? ($record->applied_for == 'written_exam' ? 'selected' : '') : (old('applied_for') == 'written_exam' ? 'selected' : '') }}>Written Exam</option>
                <option value="interview" {{ isset($record) ? ($record->interview == 'class' ? 'selected' : '') : (old('interview') == 'class' ? 'selected' : '') }}>Interview</option>
                <option value="examination" {{ isset($record) ? ($record->examination == 'class' ? 'selected' : '') : (old('examination') == 'class' ? 'selected' : '') }}>Examination</option>
            </select>
            <span class="text-danger">{{$errors->first('exam_id')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputSubjectType">Select Subject Type <span class="text-danger">*</span></label>
            <select name="subject_type" class="form-control" id="InputSubjectType" required>
                <option value="" selected>Select Subject Type</option>
                <option {{ isset($record) ? ($record->subject_type == 'english_essay_and_precis' ? 'selected' : '') : (old('subject_type') == 'english_essay_and_precis' ? 'selected' : '') }} value="english_essay_and_precis" >English Essay & Precis</option>
                <option {{ isset($record) ? ($record->subject_type == 'compulsory_only' ? 'selected' : '') : (old('subject_type') == 'compulsory_only' ? 'selected' : '') }} value="compulsory_only" >Compulsory Only</option>
                <option {{ isset($record) ? ($record->subject_type == 'optional_only' ? 'selected' : '') : (old('subject_type') == 'optional_only' ? 'selected' : '') }} value="optional_only" >Optional Subjects</option>
                <option {{ isset($record) ? ($record->subject_type == 'all' ? 'selected' : '') : (old('subject_type') == 'all' ? 'selected' : '') }} value="all" >All</option>
                <option {{ isset($record) ? ($record->subject_type == 'custom' ? 'selected' : '') : (old('subject_type') == 'custom' ? 'selected' : '') }} value="custom" >Custom</option>
            </select>
            <span class="text-danger">{{$errors->first('subject_type')}}</span>
        </div>
        <div class="form-group col-3">
            @php 
                $subjects = isset($record) ? json_decode($record->subjects) : array();
            @endphp
            <label for="InputSubject">Select Subjects <span class="text-danger">*</span></label>
            <select name="subject_id[]" class="form-control select2" multiple id="InputSubject" required>
                @if (!empty($subjects))
                @foreach($subjects as $subject)
                    @php ($subjectFound = \App\Models\Subject::find($subject))
                    <option value="{{$subjectFound->id ?? ''}}" selected>@isset($subjectFound) {{$subjectFound->name . ' (' .$subjectFound->fees. ')'}} @endisset</option>
                @endforeach
                @endif
            </select>
            <span class="text-danger">{{$errors->first('subject_id')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputTotalFee">Total Fee <span class="text-danger">*</span></label>
            <input readonly type="text" name="total_fee" class="form-control" id="InputTotalFee" value="{{ old('total_fee') ?? (isset($record) ? $record->total_fee : '') }}" placeholder="Total Fee">
            <span class="text-danger">{{$errors->first('total_fee')}}</span>
        </div>
        <div class="form-group col-2">
            <label for="InputDiscountedAmount">Discounted Amount <span class="text-danger">*</span></label>
            <input type="number" name="discounted_amount" class="form-control" id="InputDiscountedAmount" value="{{ old('discounted_amount') ?? (isset($record) ? $record->discounted_amount : '') }}" placeholder="Enter discounted amount">
            <span class="text-danger">{{$errors->first('discounted_amount')}}</span>
        </div>
        <div class="form-group col-2">
            <label for="InputDiscountReason">Discount Reason <span class="text-danger">*</span></label>
            <input type="text" name="discount_reason" class="form-control" id="InputDiscountReason" value="{{ old('discount_reason') ?? (isset($record) ? $record->discount_reason : '') }}" placeholder="Enter discount reason">
            <span class="text-danger">{{$errors->first('discount_reason')}}</span>
        </div>
        <div class="form-group col-2">
            <label for="InputAmountToBePaid">Amount to be Paid <span class="text-danger">*</span></label>
            <input disabled type="text" name="amount_to_be_paid" class="form-control" id="InputAmountToBePaid" value="{{ old('amount_to_be_paid') ?? (isset($record) ? $paid_amount : '') }}">
            <span class="text-danger">{{$errors->first('amount_to_be_paid')}}</span>
        </div>
        <div class="form-group col-2">
            <label for="InputPaidFee">Paid Fee <span class="text-danger">*</span></label>
            <input disabled type="text" name="paid_fee" class="form-control" id="InputPaidFee" value="{{ old('paid_fee') ?? (isset($record) ? $paid_amount : '') }}" placeholder="Enter paid fee">
            <span class="text-danger">{{$errors->first('paid_fee')}}</span>
        </div>
        <div class="form-group col-2">
            <label for="InputRemainingDues">Remaining Dues <span class="text-danger">*</span></label>
            <input disabled type="text" name="remaining_dues" class="form-control" id="InputRemainingDues" value="{{ old('remaining_dues') ?? (isset($record) ? $remaining_dues : '') }}" placeholder="Remaining Dues">
            <span class="text-danger">{{$errors->first('remaining_dues')}}</span>
        </div>
        <div class="form-group col-2">
            <label for="InputDueDate">Due Date <span class="text-danger">*</span></label>
            <input type="date" name="due_date" class="form-control" id="InputDueDate" value="{{ old('due_date') ?? (isset($record) ? $record->due_date : '') }}" placeholder="Due Date">
            <span class="text-danger">{{$errors->first('due_date')}}</span>
        </div>
        <div class="form-group col-3 InputInterview">
            <label for="InputInterview">Select Interview Type <span class="text-danger">*</span></label>
            <select class="form-control" id="InputInterview" name="interview_type">
                <option value="">Select Interview Type</option>
                <option value="class" {{ isset($record) ? ($record->interview_type == 'class' ? 'selected' : '') : (old('interview_type') == 'class' ? 'selected' : '') }}>Class</option>
                <option value="mock" {{ isset($record) ? ($record->interview_type == 'mock' ? 'selected' : '') : (old('interview_type') == 'mock' ? 'selected' : '') }}>Mock</option>
            </select>
            <span class="text-danger">{{$errors->first('interview_type')}}</span>
        </div>
        <div class="form-group col-3 InputExam">
            <label for="InputExam">Examination type <span class="text-danger">*</span></label>
            <select name="exam_id" class="form-control" id="InputExam">
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
            <label for="InputInstallments">Installments <span class="text-danger">*</span></label>
            <select name="installments" id="InputInstallments" class="form-control">
                <option value="">Select installment</option>
                <option value="first" {{ isset($record) ? ($record->installments == 'first' ? 'selected' : '') : (old('installments') == 'first' ? 'selected' : '') }}>First</option>
                <option value="second" {{ isset($record) ? ($record->installments == 'second' ? 'selected' : '') : (old('installments') == 'second' ? 'selected' : '') }}>Second</option>
                <option value="third" {{ isset($record) ? ($record->installments == 'third' ? 'selected' : '') : (old('installments') == 'third' ? 'selected' : '') }}>Third</option>
            </select>
            <span class="text-danger">{{$errors->first('status')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputFreezeDate">Freeze Date<span class="text-danger">*</span></label>
            <input type="date" name="freeze_date" class="form-control" id="InputFreezeDate" value="{{ old('freeze_date') ?? (isset($record) ? $record->freeze_date : '') }}">
            <span class="text-danger">{{$errors->first('freeze_date')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="left">Left Date <span class="text-danger">*</span></label>
            <input type="date" name="left_date" class="form-control" id="left_date" value="{{ old('left_date') ?? (isset($record) ? $record->left_date : '') }}">
            <span class="text-danger">{{$errors->first('left_date')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputPaymentMethod">Last Payment Method <span class="text-danger">*</span> ( <a target="_blank" href="@isset($record){{url('admin/fee-collection/list?roll_number='.$record->roll_number)}}@endisset">View All Transactions</a> )</label>
            <input type="text" disabled name="payment_method" class="form-control" id="InputPaymentMethod" value="{{ old('payment_method') ?? (isset($record) ? $payment_method : '') }}" placeholder="Enter payment method">
            <span class="text-danger">{{$errors->first('payment_method')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputPaymentDate">Payment Date <span class="text-danger">*</span></label>
            <input type="date" name="payment_date" class="form-control" id="InputPaymentDate" value="{{ old('payment_date') ?? (isset($record) ? $record->payment_date : '') }}">
            <span class="text-danger">{{$errors->first('payment_date')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputChallanNo">Challan No <span class="text-danger">*</span></label>
            <input type="text" name="challan_number" class="form-control" id="InputChallanNo" value="{{ old('challan_number') ?? (isset($record) ? $record->challan_number : '') }}">
            <span class="text-danger">{{$errors->first('challan_number')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputReceiptNo">Receipt No <span class="text-danger">*</span></label>
            <input type="text" name="receipt_number" class="form-control" id="InputReceiptNo" value="{{ old('receipt_number') ?? (isset($record) ? $record->receipt_number : '') }}" placeholder="Enter receipt number">
            <span class="text-danger">{{$errors->first('receipt_number')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputPaymentRefund">Payment Refund <span class="text-danger">*</span></label>
            <input type="text" name="payment_refund" class="form-control" id="InputPaymentRefund" value="{{ old('payment_refund') ?? (isset($record) ? $record->payment_refund : '') }}" placeholder="Enter payment refund">
            <span class="text-danger">{{$errors->first('payment_refund')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputStatus">Status <span class="text-danger">*</span></label>
            <select name="status" id="status" class="form-control" required>
                <option value="">Select Status</option>
                <option value="1" {{ isset($record) ? ($record->status == '1' ? 'selected' : '') : (old('status') == '1' ? 'selected' : '') }}>Active</option>
                <option value="0" {{ isset($record) ? ($record->status == '0' ? 'selected' : '') : (old('status') == '0' ? 'selected' : '') }}>Inactive</option>
            </select>
            <span class="text-danger">{{$errors->first('status')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputShortNote">Short Note <span class="text-danger">*</span></label>
            <input type="text" value="{{ old('note') ?? (isset($record) ? $record->note : '') }}" name="note" class="form-control" id="InputShortNote" placeholder="Enter short note" >
            <span class="text-danger">{{$errors->first('note')}}</span>
        </div>

        <!---------------------->
        <!-- Academic Details -->
        <!---------------------->
        <div class="form-group col-3">
            <label for="InputAdmissionDate">Admission Date <span class="text-danger">*</span></label>
            <input type="date" value="{{ old('admission_date') ?? (isset($record) ? $record->admission_date : '') }}" name="admission_date" class="form-control" id="InputAdmissionDate" required>
            <span class="text-danger">{{$errors->first('admission_date')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputSendFeeNotification">Send Fee Notification <span class="text-danger">*</span></label>
            <br>
            <input type="checkbox" name="send_fee_notification" id="InputSendFeeNotification">
            <span class="text-danger">{{$errors->first('optional_subjects')}}</span>
        </div>
        <!-- <div class="form-group col-3">
            <label for="InputSendPasswordEmail">Send Password Email</label>
            <br>
            <input type="checkbox" name="send_password_email" id="InputSendPasswordEmail">
            <br>
            <small>It will set a newly generated Password</small>
        </div> -->
        <!-- <div class="form-group col-3">
            <label for="InputOptionalSubjects">Optional Subjects <span class="text-danger">*</span></label>
            <span class="text-danger">{{$errors->first('optional_subjects')}}</span>
        </div> -->
    </div>
</div>
@else
<div class="card-body">
    <div class="row">
        <div class="form-group col-3">
            <label for="InputProfilePicture">Profile Picture <span class="text-danger">*</span></label>
            <input type="file" value="{{ old('profile_pic') ?? (isset($record) ? $record->profile_pic : '') }}" name="profile_pic" class="form-control" id="InputProfilePicture">
            <span class="text-danger">{{$errors->first('profile_pic')}}</span>
            <div class="row mt-2">
                <div class="col-12">
                    <img src="@isset($record){{$record->getProfilePic()}}@else{{url('public/images/avatar.png')}}@endisset" class="border rounded" width="100px" height="100px" alt="">
                </div>
            </div>
        </div>
        <div class="form-group col-3">
            <label for="InputProfilePicture">Fee Slip <span class="text-danger">*</span></label>
            <input type="file" value="{{ old('profile_pic') ?? (isset($record) ? $record->profile_pic : '') }}" name="profile_pic" class="form-control" id="InputProfilePicture">
            <span class="text-danger">{{$errors->first('profile_pic')}}</span>
            <div class="row mt-2">
                <div class="col-12">
                    <img src="@isset($record){{$record->getProfilePic()}}@else{{url('public/images/avatar.png')}}@endisset" class="border rounded" width="100px" height="100px" alt="">
                </div>
            </div>
        </div>
        <div class="form-group col-3">
            <label for="InputBatchStartingDate">Batch starting date <span class="text-danger">*</span></label>
            <input type="date" value="{{ old('batch_starting_date') ?? (isset($record) ? $record->batch_starting_date : '') }}" disabled class="form-control" id="InputBatchStartingDate" >
            <span class="text-danger">{{$errors->first('batch_starting_date')}}</span>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-3">
            <label for="InputFullName">Full Name <span class="text-danger">*</span></label>
            <input type="text" value="{{ old('name') ?? (isset($record) ? $record->name : '') }}" name="name" class="form-control" id="InputFullName" placeholder="Enter full name" >
            <span class="text-danger">{{$errors->first('name')}}</span>
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
            <label for="InputFatherName">Father Name <span class="text-danger">*</span></label>
            <input type="text" value="{{ old('father_name') ?? (isset($record) ? $record->father_name : '') }}" name="father_name" class="form-control" id="InputFatherName" placeholder="Enter father name" >
            <span class="text-danger">{{$errors->first('father_name')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputFatherOccupation">Father Occupation <span class="text-danger">*</span></label>
            <input type="text" value="{{ old('father_occupation') ?? (isset($record) ? $record->father_occupation : '') }}" name="father_occupation" class="form-control" id="InputFatherOccupation" placeholder="Enter father occupation" >
            <span class="text-danger">{{$errors->first('father_occupation')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputCnic">CNIC <span class="text-danger">*</span></label>
            <input type="number" value="{{ old('cnic') ?? (isset($record) ? $record->cnic : '') }}" name="cnic" class="form-control" id="InputCnic" placeholder="Enter cnic" >
            <span class="text-danger">{{$errors->first('cnic')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputMobileNumber">Mobile Number <span class="text-danger">*</span></label>
            <input type="number" value="{{ old('mobile_number') ?? (isset($record) ? $record->mobile_number : '') }}" name="mobile_number" class="form-control" id="InputMobileNumber" placeholder="Enter mobile number" >
            <span class="text-danger">{{$errors->first('mobile_number')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputWhatsAppNumber">WhatsApp Number <span class="text-danger">*</span></label>
            <input type="number" value="{{ old('whatsapp_number') ?? (isset($record) ? $record->whatsapp_number : '') }}" name="whatsapp_number" class="form-control" id="InputWhatsAppNumber" placeholder="Enter whatsapp number" >
            <span class="text-danger">{{$errors->first('whatsapp_number')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputContactNumber">Emergency Contact Number <span class="text-danger">*</span></label>
            <input type="number" value="{{ old('emergency_contact_number') ?? (isset($record) ? $record->emergency_contact_number : '') }}" name="emergency_contact_number" class="form-control" id="InputContactNumber" placeholder="Enter emergency contact number" >
            <span class="text-danger">{{$errors->first('emergency_contact_number')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputUserType">User Type <span class="text-danger">*</span></label>
            <input type="text" disabled value=" {{ isset($record) ? ($record->user_type == '3' ? 'Student' : '') : (old('user_type') == '3' ? 'Student' : '') }}" class="form-control" id="InputUserType">
            <span class="text-danger">{{$errors->first('user_type')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputStatus">Status <span class="text-danger">*</span></label>
            <select disabled id="status" class="form-control">
                <option value="">Select Status</option>
                <option value="1" {{ isset($record) ? ($record->status == '1' ? 'selected' : '') : (old('status') == '1' ? 'selected' : '') }}>Active</option>
                <option value="0" {{ isset($record) ? ($record->status == '0' ? 'selected' : '') : (old('status') == '0' ? 'selected' : '') }}>Inactive</option>
            </select>
            <span class="text-danger">{{$errors->first('status')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputGender">Gender <span class="text-danger">*</span></label>
            <select name="gender" id="InputGender" class="form-control" >
                <option value="">Select Gender</option>
                <option value="male" {{ isset($record) ? ($record->gender == 'male' ? 'selected' : '') : (old('gender') == 'male' ? 'selected' : '') }}>Male</option>
                <option value="female" {{ isset($record) ? ($record->gender == 'female' ? 'selected' : '') : (old('gender') == 'female' ? 'selected' : '') }}>Female</option>
            </select>
            <span class="text-danger">{{$errors->first('gender')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputDateOfBirth">Date of Birth <span class="text-danger">*</span></label>
            <input type="date" name="date_of_birth" class="form-control" id="InputDateOfBirth" value="{{ old('date_of_birth') ?? (isset($record) ? $record->date_of_birth : '') }}" >
            <span class="text-danger">{{$errors->first('date_of_birth')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputDomicile">Select Domicile <span class="text-danger">*</span></label>
            <select class="form-control" id="InputDomicile" name="domicile" >
                <option value="">Select Domicile</option>
                <option value="isb" {{ isset($record) ? ($record->domicile == 'isb' ? 'selected' : '') : (old('domicile') == 'isb' ? 'selected' : '') }}>Islamabad</option>
                <option value="punjab" {{ isset($record) ? ($record->domicile == 'punjab' ? 'selected' : '') : (old('domicile') == 'punjab' ? 'selected' : '') }}>Punjab</option>
                <option value="sindh" {{ isset($record) ? ($record->domicile == 'sindh' ? 'selected' : '') : (old('domicile') == 'sindh' ? 'selected' : '') }}>Sindh</option>
                <option value="balochistan" {{ isset($record) ? ($record->domicile == 'balochistan' ? 'selected' : '') : (old('domicile') == 'balochistan' ? 'selected' : '') }}>Balochistan</option>
                <option value="kpk" {{ isset($record) ? ($record->domicile == 'kpk' ? 'selected' : '') : (old('domicile') == 'kpk' ? 'selected' : '') }}>KPK</option>
            </select>
            <span class="text-danger">{{$errors->first('class_program')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputCaste">Caste <span class="text-danger">*</span></label>
            <input type="text" value="{{ old('caste') ?? (isset($record) ? $record->caste : '') }}" name="caste" class="form-control" id="InputCaste" placeholder="Enter caste">
            <span class="text-danger">{{$errors->first('caste')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputReligion">Religion <span class="text-danger">*</span></label>
            <input type="text" value="{{ old('religion') ?? (isset($record) ? $record->religion : '') }}" name="religion" class="form-control" id="InputReligion" placeholder="Enter religion">
            <span class="text-danger">{{$errors->first('religion')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputBloodGroup">Blood Group <span class="text-danger">*</span></label>
            <select name="blood_group" id="blood_group" class="form-control">
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
        <div class="form-group col-3">
            <label for="InputHeight">Height <span class="text-danger">*</span></label>
            <input type="number" value="{{ old('height') ?? (isset($record) ? $record->height : '') }}" name="height" class="form-control" id="InputHeight" placeholder="Enter height">
            <span class="text-danger">{{$errors->first('height')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputWeight">Weight <span class="text-danger">*</span></label>
            <input type="number" value="{{ old('weight') ?? (isset($record) ? $record->weight : '') }}" name="weight" class="form-control" id="InputWeight" placeholder="Enter weight">
            <span class="text-danger">{{$errors->first('weight')}}</span>
        </div>

        <div class="form-group col-3">
            <label for="InputMaritalStatus">Select Marital Status <span class="text-danger">*</span></label>
            <select class="form-control" id="InputMaritalStatus" name="marital_status" >
                <option value="">Select Marital Status</option>
                <option value="un_married" {{ isset($record) ? ($record->marital_status == 'un_married' ? 'selected' : '') : (old('marital_status') == 'un_married' ? 'selected' : '') }}>Un Married</option>
                <option value="married" {{ isset($record) ? ($record->marital_status == 'married' ? 'selected' : '') : (old('marital_status') == 'married' ? 'selected' : '') }}>Married</option>
            </select>
            <span class="text-danger">{{$errors->first('marital_status')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputCurrentAddress">Current address <span class="text-danger">*</span></label>
            <input type="text" value="{{ old('current_address') ?? (isset($record) ? $record->current_address : '') }}" name="current_address" class="form-control" id="InputCurrentAddress" placeholder="Enter current address" >
            <span class="text-danger">{{$errors->first('current_address')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputPermanentAddress">Permanent Address <span class="text-danger">*</span></label>
            <input type="text" value="{{ old('permanent_address') ?? (isset($record) ? $record->permanent_address : '') }}" name="permanent_address" class="form-control" id="InputPermanentAddress" placeholder="Enter permanent address" >
            <span class="text-danger">{{$errors->first('permanent_address')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputWorkExperience">Work Experience <span class="text-danger">*</span></label>
            <input type="text" value="{{ old('work_experience') ?? (isset($record) ? $record->work_experience : '') }}" name="work_experience" class="form-control" id="InputWorkExperience" placeholder="Enter work experience" >
            <span class="text-danger">{{$errors->first('work_experience')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputShortNote">Short Note <span class="text-danger">*</span></label>
            <input type="text" value="{{ old('note') ?? (isset($record) ? $record->note : '') }}" name="note" class="form-control" id="InputShortNote" placeholder="Enter short note" >
            <span class="text-danger">{{$errors->first('note')}}</span>
        </div>

        <!---------------------->
        <!-- Academic Details -->
        <!---------------------->
        <div class="form-group col-3">
            <label for="InputBatchNumber">Select Batch <span class="text-danger">*</span></label>
            <select class="form-control" id="InputBatchNumber" disabled>
                <option value="">Select Batch</option>
                <option value="80" {{ isset($record) ? ($record->batch_number == '80' ? 'selected' : '') : (old('batch_number') == '80' ? 'selected' : '') }}>80</option>
                <option value="81" {{ isset($record) ? ($record->batch_number == '81' ? 'selected' : '') : (old('batch_number') == '81' ? 'selected' : '') }}>81</option>
                <option value="82" {{ isset($record) ? ($record->batch_number == '82' ? 'selected' : '') : (old('batch_number') == '82' ? 'selected' : '') }}>82</option>
                <option value="83" {{ isset($record) ? ($record->batch_number == '83' ? 'selected' : '') : (old('batch_number') == '83' ? 'selected' : '') }}>83</option>
                <option value="84" {{ isset($record) ? ($record->batch_number == '84' ? 'selected' : '') : (old('batch_number') == '84' ? 'selected' : '') }}>84</option>
            </select>
            <span class="text-danger">{{$errors->first('batch_number')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputAdmissionDate">Admission Date <span class="text-danger">*</span></label>
            <input type="date" value="{{ old('admission_date') ?? (isset($record) ? $record->admission_date : '') }}" disabled class="form-control" id="InputAdmissionDate">
            <span class="text-danger">{{$errors->first('admission_date')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputAdmissionNumber">Admission Number <span class="text-danger">*</span></label>
            <input type="text" value="{{ old('admission_number') ?? (isset($record) ? $record->admission_number : '') }}" disabled class="form-control" id="InputAdmissionNumber" placeholder="Enter admission number">
            <span class="text-danger">{{$errors->first('admission_number')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputRollNo">Roll Number <span class="text-danger">*</span></label>
            <input type="text" value="{{ old('roll_number') ?? (isset($record) ? $record->roll_number : '') }}" readonly class="form-control" id="InputRollNo" placeholder="Enter roll number" required>
            <span class="text-danger">{{$errors->first('roll_number')}}</span>
        </div>
        <div class="form-group col-3">
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
                <option value="online" {{ isset($record) ? ($record->class_type == 'online' ? 'selected' : '') : (old('class_type') == 'online' ? 'selected' : '') }}>Online</option>
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
        </div>
        <div class="form-group col-3">
            <label for="InputFreezeDate">Freeze Date<span class="text-danger">*</span></label>
            <input type="date" disabled class="form-control" id="InputFreezeDate" value="{{ old('freeze_date') ?? (isset($record) ? $record->freeze_date : '') }}">
            <span class="text-danger">{{$errors->first('freeze_date')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="left">Left Date <span class="text-danger">*</span></label>
            <input type="date" disabled class="form-control" id="left_date" value="{{ old('left_date') ?? (isset($record) ? $record->left_date : '') }}">
            <span class="text-danger">{{$errors->first('left_date')}}</span>
        </div>
        <div class="form-group col-3">
            <label for="InputOptionalSubjects">Optional Subjects <span class="text-danger">*</span></label>
            <span class="text-danger">{{$errors->first('optional_subjects')}}</span>
        </div>
    </div>
</div>
@endif