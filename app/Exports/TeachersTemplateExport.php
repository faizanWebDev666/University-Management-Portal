<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TeachersTemplateExport implements FromArray, WithHeadings
{
    public function array(): array
    {
        return [
            [
                'Dr. John Doe',
                'Mr. Doe',
                '12345-6789012-3',
                '1985-01-01',
                'Male',
                'john.doe@example.com',
                '03001234567',
                'monthly',
                '50000',
                'PhD CS',
                'AI',
                'Computer Science',
                'Professor',
                '2024-01-01',
                'john.doe',
                'password123',
                '123 Street',
                'Pakistan',
                'Lahore',
                'Punjab'
            ]
        ];
    }

    public function headings(): array
    {
        return [
            'Full Name',
            'Father Name',
            'CNIC',
            'DOB (YYYY-MM-DD)',
            'Gender (Male/Female)',
            'Email',
            'Phone',
            'Salary Type (monthly/weekly/hourly)',
            'Salary',
            'Qualification',
            'Specialization',
            'Department Name',
            'Designation',
            'Joining Date (YYYY-MM-DD)',
            'Username',
            'Password',
            'Address',
            'Country',
            'City',
            'State'
        ];
    }
}
