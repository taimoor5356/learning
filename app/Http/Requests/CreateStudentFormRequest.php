<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class CreateStudentFormRequest extends FormRequest
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
            'password' => Hash::make(12345678),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'regex:/^[^\d]+$/'], // This regex disallows any digits
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'father_name' => 'required',
            'father_occupation' => 'required',
            'cnic' => 'required',
            'whatsapp_number' => 'required',
            'emergency_contact_number' => 'required',
            'user_type' => 'required',
            'marital_status' => 'required',
            'address' => 'nullable',
            'status' => 'required',
            'gender' => 'required',
            'interview_type' => 'required',
            'date_of_birth' => 'required',
            'admission_date' => 'required',
            'roll_number' => 'required|roll_number|unique:users,roll_number',
            'class_year' => 'required',
            'class_id' => 'required',
            'caste' => 'nullable',
            'religion' => 'nullable',
            'mobile_number' => 'required|min_digits:10|max_digits:15',
            'blood_group' => ['nullable', Rule::in(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'])],
            'height' => 'nullable|regex:/^\d+(\.\d+)?$/|min:0|max:7',
            'weight' => 'nullable|regex:/^\d+(\.\d+)?$/|min:0|max:100',
            'marital_status' => 'nullable',
            'current_address' => 'nullable',
            'permanent_address' => 'nullable',
            'work_experience' => 'nullable',
            'note' => 'nullable',
            'class_type' => 'required',
            'class_program' => 'required',
            'domicile' => 'nullable',
            'batch_starting_date' => 'required',
            'batch_number' => 'required',
            'exam_id' => 'required',
            'discounted_amount' => 'nullable',
            'discount_reason' => 'nullable',
            'freeze_date' => 'nullable',
            'left_date' => 'nullable',
        ];
    }
}
