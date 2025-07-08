<x-header />

<section class="course-list-section pt-100 pb-100">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="text-white py-3" style="background-color: #009A9A; font-size: 30px;">Registered Courses List</h2>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>Course No</th>
                        <th>Course Name</th>
                        <th>Credits</th>
                        <th>Teacher</th>
                        <th>Class</th>
                        <th>Attendance Summary</th>
                    </tr>
                </thead>
<tbody>
@forelse ($courses as $course)
    <tr class="clickable-row"
        data-href="{{ route('student.course.details', ['course_id' => $course->id]) }}">
        <td>{{ $course->course->course_code ?? 'N/A' }}</td>
        <td>{{ $course->course->course_name ?? 'N/A' }}</td>
        <td>({{ $course->course->credit_hours ?? 'N/A' }})</td>
        <td>{{ $course->professor->name ?? 'TBD' }}</td>
        <td>
            @if ($course->class)
                @php
                    $semesterMap = [
                        'Spring' => 'SP',
                        'Fall' => 'FA',
                        'Summer' => 'SU',
                    ];
                    $semester = $semesterMap[$course->class->semester] ?? $course->class->semester;
                    $year = substr($course->class->year, -2);
                    $degree = strtoupper(substr($course->class->degree_program, 0, 1));
                    $department = strtoupper($course->class->department);
                    $section = strtoupper($course->class->section);
                @endphp
                {{ $semester }}{{ $year }}-{{ $degree }}{{ $department }}-{{ $section }}
            @else
                N/A
            @endif
        </td>
        <td>
            @php
                $percent = (int)($attendancePercentages[$course->id] ?? 0);
            @endphp

            @if ($percent === 0)
                <div>0% - No Attendance</div>
            @else
                <div class="progress mb-1" style="height: 25px;">
                    <div class="progress-bar {{ $percent >= 60 ? 'bg-success' : 'bg-danger' }}"
                        role="progressbar" style="width: {{ $percent }}%;">
                        {{ $percent }}%
                    </div>
                </div>
            @endif
        </td>
    </tr>
@empty
    <tr>
        <td colspan="6">No registered courses found.</td>
    </tr>
@endforelse
</tbody>

            </table>
        </div>
    </div>
</section>

<x-footer />
<style>
    .clickable-row {
        cursor: pointer;
        transition: background-color 0.2s ease;
    }
    .clickable-row:hover {
        background-color: #f0f8ff;
    }
</style>


<style>
    .course-list-section {
        background-color: #f8f9fa;
    }

    .progress {
        background-color: #ddd;
        border-radius: 5px;
    }

    .progress-bar {
        font-weight: bold;
        text-align: center;
        color: white;
    }
</style>
