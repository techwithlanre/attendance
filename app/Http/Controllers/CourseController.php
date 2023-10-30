<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return success([
            'courses' => Course::all()
        ]);
    }

    public function store(CreateCourseRequest $request)
    {
        $course = Course::create(['name' => $request->name]);
        return success(new CourseResource($course), 201);
    }

    public function show(string $id)
    {
        return success([
            'course' => Course::find($id) == false ? [] : new CourseResource(Course::find($id))
        ]);
    }

    public function update(UpdateCourseRequest $request, string $id)
    {
        $course = Course::find($id);
        $course->name = $request->name;
        $course->save();
        return success(new CourseResource($course));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
