<?php

namespace App\Http\Controllers;

use App\Models\StudentCourseRegistration;
use App\Models\Attendance;
use App\Models\Assignment;
use App\Models\Quiz;
use App\Models\StudentQuizSubmission;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function courseDetails($course_id)
    {
        $studentId = session('id');
        
        // Find the registration to ensure the student is enrolled in this course
        $registration = StudentCourseRegistration::with(['course', 'professor', 'class'])
            ->where('id', $course_id)
            ->where('student_id', $studentId)
            ->firstOrFail();

        $offeredCourseId = $registration->offered_course_id;

        // Fetch attendance for this specific course and student (optimized JSON structure)
        $studentRegistration = \App\Models\StudentsRegistration::where('user_id', $studentId)->first();
        $allSessions = Attendance::where('offer_course_id', $offeredCourseId)->get();
        
        $attendances = collect();
        if ($studentRegistration) {
            foreach ($allSessions as $session) {
                $status = $session->getStatusForStudent($studentRegistration->id);
                if ($status) {
                    $attendances->push((object)[
                        'date' => $session->date,
                        'time_slot' => $session->time_slot,
                        'status' => $status
                    ]);
                }
            }
        }

        // Fetch assignments for this course and class
        $assignments = Assignment::where('course_id', $registration->course_id)
            ->where('class_id', $registration->class_id)
            ->with(['submissions' => function($query) use ($studentId) {
                $query->where('student_id', $studentId);
            }])
            ->get();

        // Fetch quizzes for this course and class
        $quizzes = Quiz::where('course_id', $registration->course_id)
            ->where('class_id', $registration->class_id)
            ->with(['submissions' => function($query) use ($studentId) {
                $query->where('student_id', $studentId);
            }])
            ->get();

        $assignmentMarkRows = $assignments->map(function ($assignment) {
            $submission = $assignment->submissions->first();
            return (object) [
                'title' => $assignment->assignment_title,
                'total_marks' => $assignment->total_marks,
                'obtained_marks' => $submission?->marks,
                'is_submitted' => (bool) $submission,
            ];
        });

        $quizMarkRows = $quizzes->map(function ($quiz) use ($studentId) {
            $submission = $quiz->submissions->first()
                ?? StudentQuizSubmission::where('quiz_id', $quiz->id)->where('student_id', $studentId)->first();

            return (object) [
                'title' => $quiz->quiz_title,
                'type' => $quiz->quiz_type,
                'obtained_marks' => $submission?->marks,
                'is_submitted' => (bool) $submission,
            ];
        });

        $assignmentObtained = $assignmentMarkRows->whereNotNull('obtained_marks')->sum('obtained_marks');
        $assignmentTotal = $assignmentMarkRows->sum(function ($item) {
            return is_numeric($item->total_marks) ? (float) $item->total_marks : 0;
        });
        $assignmentGradedCount = $assignmentMarkRows->whereNotNull('obtained_marks')->count();

        $quizObtained = $quizMarkRows->whereNotNull('obtained_marks')->sum('obtained_marks');
        $quizGradedCount = $quizMarkRows->whereNotNull('obtained_marks')->count();

        return view('Course-details', compact(
            'registration',
            'attendances',
            'assignments',
            'quizzes',
            'assignmentMarkRows',
            'quizMarkRows',
            'assignmentObtained',
            'assignmentTotal',
            'assignmentGradedCount',
            'quizObtained',
            'quizGradedCount'
        ));
    }
}
