<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAttendanceRequest;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $attendances = Attendance::withAll()->where(function ($query) use ($request) {
            $query->when($request->filled('from'), function ($query) use ($request) {
                $end_date = $request->filled('to') ? $request->to : date('Y-m-d');
                return $query->whereBetween('date', [
                    date('Y-m-d', strtotime($request->from)),
                    date('Y-m-d', strtotime($end_date))
                ]);
            });
        })->get();

        return success([
            'attendances' => $attendances
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateAttendanceRequest $request)
    {
        $attendance = Attendance::create([
            'student_id' => $request->student,
            'session_id' => $request->session,
            'date' => date('Y-m-d', strtotime($request->date)),
        ]);

        return success([
            'attendance' => $attendance
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        //
    }
}
