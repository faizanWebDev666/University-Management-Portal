<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{

public function store(Request $request)
{
    $request->validate([
        'offer_course_id' => 'required|integer|exists:offer_courses,id',
        'date' => 'required|date',
        'time_slot' => 'required|string',
        'attendance' => 'required|array',
    ]);

    $validStudentIds = DB::table('students_registrations')->pluck('id')->toArray();

    foreach ($request->attendance as $studentRegistrationId => $status) {

        if (!in_array($studentRegistrationId, $validStudentIds)) {
            continue;
        }

        $existing = Attendance::where('student_registration_id', $studentRegistrationId)
            ->where('offer_course_id', $request->offer_course_id)
            ->where('date', $request->date)
            ->where('time_slot', $request->time_slot)
            ->first();

        if (!$existing) {
            Attendance::create([
                'student_registration_id' => $studentRegistrationId,
                'offer_course_id' => $request->offer_course_id,
                'status' => $status,
                'date' => $request->date,
                'time_slot' => $request->time_slot,
            ]);
        }
    }
// dd($request->attendance);
    return back()->with('success', 'Attendance submitted successfully.');
}

}
