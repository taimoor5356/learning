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
        $this->merge([
            'password' => Hash::make($this->password),
        ]);
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
            'name' => ['sometimes', 'string', 'regex:/^[^\d]+$/'], // This regex disallows any digits
            'email' => 'sometimes|email|unique:users,email,'.$id,
            'password' => 'sometimes',
        ];
        $rules['note'] = 'sometimes';
        $userType = Auth::user()->user_type;
        if ($userType == 1) {
            $rules['admission_number'] = 'required';
            $rules['class_program'] = 'required';
            $rules['class_type'] = 'required';
            $rules['batch_starting_date'] = 'required';
            $rules['batch_number'] = 'required';
            $rules['exam_id'] = 'required';
            $rules['class_id'] = 'required';
            $rules['roll_number'] = 'required';
            $rules['admission_date'] = 'required';
            $rules['interview_type'] = 'required';
            $rules['user_type'] = 'sometimes';
            $rules['status'] = 'required';
            $rules['discounted_amount'] = 'nullable';
            $rules['discount_reason'] = 'nullable';
            $rules['freeze_date'] = 'nullable';
            $rules['left_date'] = 'nullable';
        } else {
            $rules['father_name'] = 'required';
            $rules['father_occupation'] = 'required';
            $rules['cnic'] = 'required';
            $rules['emergency_contact_number'] = 'required';
            $rules['marital_status'] = 'required';
            $rules['address'] = 'nullable';
            $rules['gender'] = 'required';
            $rules['date_of_birth'] = 'required';
            $rules['religion'] = 'nullable';
            $rules['mobile_number'] = 'required|min_digits:10|max_digits:15';
            $rules['whatsapp_number'] = 'sometimes|min_digits:10|max_digits:15';
            $rules['emergency_contact_number'] = 'sometimes|min_digits:10|max_digits:15';
            $rules['blood_group'] = ['nullable', Rule::in(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'])];
            $rules['height'] = 'nullable|regex:/^\d+(\.\d+)?$/|min:0|max:7';
            $rules['weight'] = 'nullable|regex:/^\d+(\.\d+)?$/|min:0|max:100';
            $rules['marital_status'] = 'nullable';
            $rules['current_address'] = 'required';
            $rules['permanent_address'] = 'nullable';
            $rules['work_experience'] = 'nullable';
            $rules['domicile'] = 'required';
        }
        return $rules;
    }
}
