<?php

namespace App\Http\Controllers;

use App\Models\StudentsRegistration;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function index()
    {
        $students = StudentsRegistration::paginate(10);
        $totalStudents = StudentsRegistration::count();

        return view('backend.finance-dashboard', compact('students', 'totalStudents'));
    }
}
