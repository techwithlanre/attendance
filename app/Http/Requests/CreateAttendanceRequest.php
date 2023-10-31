<?php

namespace App\Http\Requests;

use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateAttendanceRequest extends FormRequest
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
    public function rules()
    {
        $request = $this->request->all();
        return [
            'student' => 'required|exists:students,id|'.Rule::unique(Attendance::class, 'student_id')->where(function ($query) use ($request) {
                return $query->where('date', $request['date']);
            }),
            'session' => 'required|exists:sessions,id',
            'date' => 'required|date',
        ];
    }
}
