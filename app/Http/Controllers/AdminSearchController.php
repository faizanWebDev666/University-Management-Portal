<?php

namespace App\Http\Controllers;

use App\Models\TeacherRegistration;
use App\Models\User;
use Illuminate\Http\Request;

class AdminSearchController extends Controller
{
  public function ajaxFilterUsers(Request $request)
    {
        $q = $request->q;
        $users = User::select('id','name','email','type','created_at')
            ->when($q, fn($query) => $query->where(fn($q2) =>
                $q2->where('name', 'like', "%$q%")
                   ->orWhere('email', 'like', "%$q%")
                   ->orWhere('type', 'like', "%$q%")
            ))
            ->orderBy('id','desc')
            ->limit(20)
            ->get();

        return view('backend.partials.users-rows', compact('users'));
    }

    public function ajaxFilterProfessors(Request $request)
    {
        $q = $request->q;
        $professors = TeacherRegistration::select(
                'id','full_name','father_name','cnic','dob','gender','email'
            )
            ->when($q, fn($query) => $query->where(fn($q2) =>
                $q2->where('full_name', 'like', "%$q%")
                   ->orWhere('father_name', 'like', "%$q%")
                   ->orWhere('cnic', 'like', "%$q%")
                   ->orWhere('email', 'like', "%$q%")
            ))
            ->orderBy('id','desc')
            ->limit(20)
            ->get();

        return view('backend.partials.professors-rows', compact('professors'));
    }

    
}


