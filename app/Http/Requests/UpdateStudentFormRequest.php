<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UpdateStudentFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        // $this->merge([
        //     'password' => Hash::make($this->password),
        // ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->route('id');
        if (Auth::user()->user_type == 3) {
            $id = Auth::user()->id;
        }
        $rules = [
            'name' => ['required', 'string', 'regex:/^[^\d]+$/'], // This regex disallows any digits
            'email' => 'required|email|unique:users,email,'.$id,
            // 'password' => 'sometimes|nullable|string|min:8',
        ];
        $userType = Auth::user()->user_type;
        // if ($userType == 1) {
            $rules['class_type'] = 'sometimes';
            $rules['gender'] = 'sometimes';
            // $rules['qualification'] = 'sometimes';
            $rules['class_year'] = 'sometimes';
            $rules['class_program'] = 'sometimes';
            $rules['domicile'] = 'sometimes';
            $rules['batch_starting_date'] = 'sometimes';
            $rules['batch_number'] = 'sometimes';
            $rules['roll_number'] = 'sometimes';
            $rules['applied_for'] = 'sometimes';
            $rules['class_id'] = 'sometimes';
            $rules['interview_type'] = 'sometimes';
            $rules['exam_id'] = 'sometimes';
            $rules['installments'] = 'sometimes';
            $rules['discounted_amount'] = 'sometimes';
            $rules['discount_reason'] = 'sometimes';
            $rules['paid_fee'] = 'sometimes';
            $rules['total_fee'] = 'sometimes';
            $rules['remaining_dues'] = 'sometimes';
            $rules['due_date'] = 'sometimes';
            $rules['freeze_date'] = 'sometimes';
            $rules['left_date'] = 'sometimes';
            $rules['payment_method'] = 'sometimes';
            $rules['payment_date'] = 'sometimes';
            $rules['challan_number'] = 'sometimes';
            $rules['receipt_number'] = 'sometimes';
            $rules['payment_refund'] = 'sometimes';
            $rules['status'] = 'sometimes';
            $rules['note'] = 'sometimes';
            $rules['admission_date'] = 'sometimes';
            $rules['role_id'] = 'sometimes';
            $rules['admission_number'] = 'sometimes';
            $rules['user_type'] = 'sometimes';
        // } else {
            $rules['profile_pic'] = 'sometimes';
            $rules['fee_slip'] = 'sometimes';
            $rules['father_name'] = 'sometimes';
            $rules['date_of_birth'] = 'sometimes';
            $rules['cnic'] = 'sometimes';
            $rules['father_occupation'] = 'sometimes';
            $rules['work_experience'] = 'sometimes';
            $rules['address'] = 'sometimes';
            $rules['whatsapp_number'] = 'sometimes|min_digits:10|max_digits:15';
            $rules['emergency_contact_number'] = 'sometimes|min_digits:10|max_digits:15';
            $rules['optional_subjects'] = 'sometimes';
            $rules['rules_regulations'] = 'sometimes';
            $rules['declaration'] = 'sometimes';
            
            $rules['written_exam_serial_number'] = 'sometimes';
            $rules['full_interview_mock_preparation'] = 'sometimes';
            $rules['exam_roll_number'] = 'sometimes';
            $rules['written_exam_preparation_from_csps'] = 'sometimes';
            $rules['mock_interview'] = 'sometimes';
            $rules['mock_interview_date'] = 'sometimes';
            $rules['mock_interview_time'] = 'sometimes';
            $rules['join_whatsapp_group'] = 'sometimes';


            $rules['caste'] = 'sometimes';
            $rules['religion'] = 'sometimes';
            $rules['blood_group'] = ['sometimes', Rule::in(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'])];
            $rules['height'] = 'sometimes|regex:/^\d+(\.\d+)?$/|min:0|max:7';
            $rules['weight'] = 'sometimes|regex:/^\d+(\.\d+)?$/|min:0|max:100';
            $rules['marital_status'] = 'sometimes';
            $rules['current_address'] = 'sometimes';
            $rules['permanent_address'] = 'sometimes';
            $rules['mobile_number'] = 'sometimes|min_digits:10|max_digits:15';
        // }
        return $rules;
    }
}
