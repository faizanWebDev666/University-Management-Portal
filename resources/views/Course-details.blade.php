<div class="container py-5">
    <h2 class="mb-4 text-center text-white py-2" style="background-color: #009A9A;">Course Details</h2>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ $course->course->course_name ?? 'N/A' }}</h4>

            <p><strong>Course Code:</strong> {{ $course->course->course_code ?? 'N/A' }}</p>
            <p><strong>Credit Hours:</strong> {{ $course->course->credit_hours ?? 'N/A' }}</p>
            <p><strong>Professor:</strong> {{ $course->professor->name ?? 'TBD' }}</p>

            <p><strong>Class:</strong>
                @if ($course->class)
                    @php
                        $semesterMap = ['Spring' => 'SP', 'Fall' => 'FA', 'Summer' => 'SU'];
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
            </p>

            <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Back to Course List</a>
        </div>
    </div>
</div>