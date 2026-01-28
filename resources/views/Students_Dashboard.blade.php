<x-header />

<section class="course-list-section pt-100 pb-100">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="text-white py-3" style="background-color:#009A9A;font-size:30px;">
                Registered Courses List
            </h2>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle course-table">
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

                        <td data-label="Course No">
                            {{ $course->course->course_code ?? 'N/A' }}
                        </td>

                        <td data-label="Course Name">
                            {{ $course->course->course_name ?? 'N/A' }}
                        </td>

                        <td data-label="Credits">
                            ({{ $course->course->credit_hours ?? 'N/A' }})
                        </td>

                        <td data-label="Teacher">
                            {{ $course->professor->name ?? 'TBD' }}
                        </td>

                        <td data-label="Class">
                            @if ($course->class)
                                @php
                                    $semesterMap = ['Spring'=>'SP','Fall'=>'FA','Summer'=>'SU'];
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

                        <td data-label="Attendance">
                            @php
                                $percent = (int)($attendancePercentages[$course->id] ?? 0);
                            @endphp

                            @if ($percent === 0)
                                <span class="text-danger fw-bold">0% - No Attendance</span>
                            @else
                                <div class="progress" style="height:22px;">
                                    <div class="progress-bar {{ $percent >= 60 ? 'bg-success' : 'bg-danger' }}"
                                         style="width:{{ $percent }}%">
                                        {{ $percent }}%
                                    </div>
                                </div>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">
                            No registered courses found.
                        </td>
                    </tr>
                @endforelse
                </tbody>

            </table>
        </div>
    </div>
</section>


<style>
/* ================= GENERAL ================= */
.course-list-section {
    background-color: #f8f9fa;
}

.clickable-row {
    cursor: pointer;
    transition: background-color 0.2s ease;
}
.clickable-row:hover {
    background-color: #f0f8ff;
}

.progress {
    background-color: #ddd;
    border-radius: 5px;
}
.progress-bar {
    font-weight: bold;
    color: #fff;
}

/* ================= MOBILE RESPONSIVE ================= */
@media (max-width: 768px) {

    .course-table thead {
        display: none;
    }

    .course-table,
    .course-table tbody,
    .course-table tr,
    .course-table td {
        display: block;
        width: 100%;
    }

    .course-table tr {
        background: #fff;
        margin-bottom: 16px;
        padding: 14px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        text-align: left;
    }

    .course-table td {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border: none;
        padding: 8px 0;
        font-size: 14px;
    }

    .course-table td::before {
        content: attr(data-label);
        font-weight: 600;
        color: #444;
        flex: 0 0 45%;
    }

    .course-table td:last-child {
        padding-bottom: 0;
    }

    .course-table .progress {
        width: 100%;
    }
}
</style>
