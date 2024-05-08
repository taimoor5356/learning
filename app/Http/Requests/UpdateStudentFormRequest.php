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
            'name' => ['required', 'string', 'regex:/^[^\d]+$/'], // This regex disallows any digits
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'sometimes',
            'father_name' => 'required',
            'father_occupation' => 'required',
            'cnic' => 'required',
            'whatsapp_number' => 'required|min_digits:10|max_digits:15',
            'emergency_contact_number' => 'required|min_digits:10|max_digits:15',
            'marital_status' => 'required',
            'address' => 'sometimes',
            'gender' => 'required',
            'date_of_birth' => 'required',
            'caste' => 'sometimes',
            'religion' => 'sometimes',
            'mobile_number' => 'required|min_digits:10|max_digits:15',
            'blood_group' => ['sometimes', Rule::in(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'])],
            'height' => 'sometimes|regex:/^\d+(\.\d+)?$/|min:0|max:7',
            'weight' => 'sometimes|regex:/^\d+(\.\d+)?$/|min:0|max:100',
            'marital_status' => 'sometimes',
            'current_address' => 'sometimes',
            'permanent_address' => 'sometimes',
            'work_experience' => 'sometimes',
            'note' => 'sometimes',
            'domicile' => 'sometimes',
            'discounted_amount' => 'sometimes',
            'discount_reason' => 'sometimes',
            'freeze_date' => 'sometimes',
            'left_date' => 'sometimes',
        ];
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
        }
        return $rules;
    }
}
