<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStudentRequest extends FormRequest
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
            'course' => 'nullable|exists:courses,id',
            'name' => 'required',
            'email' => 'required|unique:students,email,'.$this->route('id'),
            'phone' => 'required|unique:students,phone,'.$this->route('id'),
            'address' => 'nullable',
            'graduated' => 'required'
        ];
    }
}
