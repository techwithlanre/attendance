<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $student = Student::where(function ($query) use ($request) {
            return $query->when($request->filled('graduated'), function ($query) use ($request) {
                return $query->where('graduated', $request->graduated);
            });
        })->where(function ($query) use ($request) {
            return $query->when($request->filled('course'), function ($query) use ($request) {
                return $query->where('course_id', $request->course);
            });
        })->where(function ($query) use ($request) {
            return $query->when($request->filled('search'), function ($query) use ($request) {
                return $query->where('name', 'LIKE', "%{$request->search}%")
                    ->orWhere('email', 'LIKE', "%{$request->search}%")
                    ->orWhere('phone', 'LIKE', "%{$request->search}%");
            });
        })->get();

        return success([
            'students' => $student,
        ]);
    }

    public function store(StoreStudentRequest $request)
    {
        $student = Student::create([
            'course_id'=> $request->course,
            'name'=> $request->name,
            'email'=> $request->email,
            'phone'=> $request->phone,
            'address'=> $request->address,
        ]);

        return success([
            'student' => $student
        ]);
    }

    public function update(UpdateStudentRequest $request, $id)
    {
        $student = Student::find($id);
        $student->course_id = $request->course;
        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->address = $request->address;
        $student->graduated = $request->graduated;
        $student->save();

        return success([
            'student' => $student
        ]);
    }
}
