<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\OfferCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'offer_course_id' => 'required|exists:offer_courses,id',
            'date' => 'required|date',
            'time_slot' => 'required|string',
            'attendance' => 'required|array',
        ]);

        // ✅ Get course for authorization check
     
       

        // ✅ Prevent marking attendance for a future date
        if (Carbon::parse($request->date)->isFuture()) {
            return back()->with('error', 'You cannot mark attendance for a future date.');
        }

        // ✅ Check if attendance already exists for same course/date/slot
        $alreadyExists = Attendance::where('offer_course_id', $request->offer_course_id)
            ->where('date', $request->date)
            ->where('time_slot', $request->time_slot)
            ->exists();

        if ($alreadyExists) {
            return back()->with('error', 'Attendance already submitted for this course, date, and time slot.');
        }

        // ✅ Prevent empty attendance submissions
        if (empty($request->attendance)) {
            return back()->with('error', 'No student attendance data provided.');
        }

        DB::beginTransaction();
        try {
            $records = [];

            foreach ($request->attendance as $studentId => $status) {
                // ✅ Ensure per-student uniqueness
                $exists = Attendance::where('student_registration_id', $studentId)
                    ->where('offer_course_id', $request->offer_course_id)
                    ->where('date', $request->date)
                    ->where('time_slot', $request->time_slot)
                    ->exists();

                if ($exists) {
                    DB::rollBack();
                    return back()->with('error', "Attendance for student ID {$studentId} already exists.");
                }

                $records[] = [
                    'student_registration_id' => $studentId,
                    'offer_course_id' => $request->offer_course_id,
                    'status' => $status,
                    'date' => $request->date,
                    'time_slot' => $request->time_slot,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            // ✅ Insert all attendance records
            Attendance::insert($records);

            DB::commit();
            return back()->with('success', 'Attendance submitted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error("Attendance store failed", ['error' => $e->getMessage()]);

            return back()->with('error', 'Something went wrong while saving attendance.');
        }
    }
}
