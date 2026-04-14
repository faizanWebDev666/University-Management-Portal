<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\OfferCourse;
use App\Models\ProfessorPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'offer_course_id' => 'required|exists:offer_courses,id',
            'attendance_session_id' => 'nullable|integer|exists:attendances,id',
            'date' => 'required|date',
            'time_slot' => 'required|string',
            'attendance' => 'required|array',
        ]);

        $professorId = session('id');
        if (!$professorId) {
            return back()->with('error', 'Please login first.');
        }

        $offeredCourse = OfferCourse::find($request->offer_course_id);
        if (!$offeredCourse || (int) $offeredCourse->professor_id !== (int) $professorId) {
            return back()->with('error', 'You are not authorized to manage attendance for this course.');
        }

        $canEditMarkedAttendance = ProfessorPermission::where('professor_id', $professorId)
            ->where('can_edit_marked_attendance', true)
            ->exists();

        // ✅ Prevent marking attendance for a future date
        if (Carbon::parse($request->date)->isFuture()) {
            return back()->with('error', 'You cannot mark attendance for a future date.');
        }

        // ✅ Prevent empty attendance submissions
        if (empty($request->attendance)) {
            return back()->with('error', 'No student attendance data provided.');
        }

        $attendanceSessionId = $request->input('attendance_session_id');

        DB::beginTransaction();
        try {
            if ($attendanceSessionId) {
                if (!$canEditMarkedAttendance) {
                    DB::rollBack();
                    return back()->with('error', 'You do not have permission to edit marked attendance.');
                }

                $attendanceSession = Attendance::where('id', $attendanceSessionId)
                    ->where('offer_course_id', $request->offer_course_id)
                    ->first();

                if (!$attendanceSession) {
                    DB::rollBack();
                    return back()->with('error', 'Selected attendance record was not found.');
                }

                $conflictingSession = Attendance::where('offer_course_id', $request->offer_course_id)
                    ->where('date', $request->date)
                    ->where('time_slot', $request->time_slot)
                    ->where('id', '!=', $attendanceSession->id)
                    ->exists();

                if ($conflictingSession) {
                    DB::rollBack();
                    return back()->with('error', 'Another attendance record already exists for this date and time slot.');
                }

                $attendanceSession->update([
                    'date' => $request->date,
                    'time_slot' => $request->time_slot,
                    'attendance_data' => $request->attendance,
                ]);

                DB::commit();
                return back()->with('success', 'Attendance updated successfully for the selected session.');
            }

            $existingAttendance = Attendance::where('offer_course_id', $request->offer_course_id)
                ->where('date', $request->date)
                ->where('time_slot', $request->time_slot)
                ->first();

            if ($existingAttendance) {
                DB::rollBack();
                if ($canEditMarkedAttendance) {
                    return back()->with('error', 'Attendance already exists for this date and time. Open it from Attendance History and click Edit.');
                }

                return back()->with('error', 'Attendance already submitted for this date and time. Ask admin to grant edit permission.');
            }

            Attendance::create([
                'offer_course_id' => $request->offer_course_id,
                'date' => $request->date,
                'time_slot' => $request->time_slot,
                'attendance_data' => $request->attendance,
            ]);

            DB::commit();
            return back()->with('success', 'Attendance submitted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error("Attendance store failed", ['error' => $e->getMessage()]);

            return back()->with('error', 'Something went wrong while saving attendance.');
        }
    }
}
