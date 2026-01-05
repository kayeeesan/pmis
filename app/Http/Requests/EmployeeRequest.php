<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'FirstName'  => 'required|string|max:255',
            'LastName'   => 'required|string|max:255',
            'MiddleName' => 'nullable|string|max:255',
            'Address'    => 'nullable|string|max:255',
            'PhoneNo'    => 'nullable|string|max:50',
            'Status'     => 'required|string|max:50',
        ];
    }

    public function messages(): array
    {
        return [
            'FirstName.required' => 'First Name is required.',
            'LastName.required'  => 'Last Name is required.',
        ];
    }
}
