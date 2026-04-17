<?php

namespace App\Imports;

use App\Models\TeacherRegistration;
use App\Models\User;
use App\Models\Department;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class TeachersImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        // Skip if email already exists in either table
        if (User::where('email', $row['email'])->exists() || TeacherRegistration::where('email', $row['email'])->exists()) {
            return null;
        }

        // Find department
        $department = Department::where('name', $row['department_name'])->first();
        if (!$department) {
            return null;
        }

        return DB::transaction(function () use ($row, $department) {
            // Create Teacher
            $teacher = TeacherRegistration::create([
                'full_name'      => $row['full_name'],
                'father_name'    => $row['father_name'],
                'cnic'           => $row['cnic'],
                'dob'            => $row['dob'],
                'gender'         => $row['gender'],
                'email'          => $row['email'],
                'phone'          => $row['phone'],
                'salary_type'    => strtolower($row['salary_type'] ?? 'monthly'),
                'salary'         => $row['salary'],
                'qualification'  => $row['qualification'],
                'specialization' => $row['specialization'],
                'department_id'  => $department->id,
                'designation'    => $row['designation'],
                'joining_date'   => $row['joining_date'],
                'username'       => $row['username'],
                'password'       => Hash::make($row['password']),
                'role'           => 'Professor',
                'address'        => $row['address'],
                'country'        => $row['country'] ?? 'Pakistan',
                'city'           => $row['city'],
                'state'          => $row['state'],
            ]);

            // Create User
            User::create([
                'name'          => $row['full_name'],
                'email'         => $row['email'],
                'password'      => Hash::make($row['password']),
                'type'          => 'professor',
                'active_status' => 1,
            ]);

            return $teacher;
        });
    }

    public function rules(): array
    {
        return [
            'full_name'       => 'required|string',
            'email'           => 'required|email',
            'username'        => 'required|string',
            'password'        => 'required|min:6',
            'department_name' => 'required|exists:departments,name',
        ];
    }
}
