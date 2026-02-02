<x-faculityheader />

<div class="container my-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-dark text-white fw-bold fs-5">
            🎓 Student Attendance
        </div>
        <div class="alert alert-info border border-primary shadow-sm mb-4">
            <h5 class="fw-bold text-primary">📝 Important Notes for Marking Attendance</h5>
            <ul class="mb-0">
                <li>Select the correct <strong>Class & Course</strong> before proceeding.</li>
                <li>Ensure the <strong>Date</strong> and <strong>Time Slot</strong> match the actual class schedule.
                </li>
                <li>You can use the <strong>Mark All</strong> options to mark everyone Present/Absent quickly.</li>
                <li>Once submitted, attendance cannot be edited — please double-check before clicking "Submit".</li>
                <li>If a student is missing from the list, ensure they are registered for the course via the system.
                </li>
            </ul>
        </div>

        <div class="card-body">
            <form method="GET" action="">
                <div class="mb-3">
                    <label for="offered_course_id" class="form-label">Select Class & Course</label>
                    <select name="offered_course_id" id="offered_course_id" class="form-select"
                        onchange="this.form.submit()" required>
                        <option value="">-- Select Class & Course --</option>
                        @foreach ($offeredCourses as $course)
                            @if ($course->class)
                                <option value="{{ $course->id }}"
                                    {{ $offeredCourseId == $course->id ? 'selected' : '' }}>
                                    {{ strtoupper(substr($course->class->semester, 0, 2)) }}{{ substr($course->class->year, -2) }}-
                                    {{ strtoupper(substr($course->class->degree_program, 0, 1)) }}{{ strtoupper(substr($course->class->department, 0, 2)) }}-{{ $course->class->section }}
                                    |
                                    {{ $course->course->course_code }} ({{ $course->course->course_name }})
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </form>

            @if ($offeredCourseId && $registeredStudents->count())
                <form action="/submit-attendance" method="POST">
                    @csrf
                    <input type="hidden" name="offer_course_id" value="{{ $offeredCourseId }}">

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="date" class="form-label">Class Date:</label>
                            <input type="date" name="date" class="form-control"
                                value="{{ now()->toDateString() }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="time_slot" class="form-label">Time Slot:</label>
                            <select name="time_slot" class="form-select" required>
                                <option value="">Select Slot</option>
                                <option value="8:30 to 10:00">8:30 to 10:00</option>
                                <option value="10:00 to 11:30">10:00 to 11:30</option>
                                <option value="11:30 to 1:00">11:30 to 1:00</option>
                                <option value="1:00 to 2:30">1:00 to 2:30</option>
                                <option value="3:00 to 4:30">3:00 to 4:30</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="me-3">Mark All:</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="mark_all" id="markAllPresent"
                                value="present">
                            <label class="form-check-label" for="markAllPresent">All Present</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="mark_all" id="markAllAbsent"
                                value="absent">
                            <label class="form-check-label" for="markAllAbsent">All Absent</label>
                        </div>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const presentBtn = document.getElementById('markAllPresent');
                            const absentBtn = document.getElementById('markAllAbsent');

                            presentBtn.addEventListener('change', function() {
                                if (this.checked) {
                                    document.querySelectorAll('input[type=radio][value=present]').forEach(radio => {
                                        radio.checked = true;
                                    });
                                }
                            });

                            absentBtn.addEventListener('change', function() {
                                if (this.checked) {
                                    document.querySelectorAll('input[type=radio][value=absent]').forEach(radio => {
                                        radio.checked = true;
                                    });
                                }
                            });
                        });
                    </script>

                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Roll No & Info</th>
                                    <th>Name</th>
                                    <th>Attendance</th>
                                    <th>Attendance %</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($registeredStudents as $index => $reg)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            {{ strtoupper(substr($reg->offeredCourse->class->semester, 0, 2)) }}
                                            {{ substr($reg->offeredCourse->class->year, -2) }}-
                                            {{ strtoupper(substr($reg->offeredCourse->class->degree_program, 0, 1)) }}
                                            {{ strtoupper(substr($reg->offeredCourse->class->department, 0, 2)) }}-
                                            {{ $reg->student->registration->roll_no ?? 'N/A' }}
                                        </td>
                                        <td>{{ $reg->student->name ?? 'N/A' }}</td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="attendance[{{ $reg->id }}]" value="present" required>
                                                <label class="form-check-label">Present</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="attendance[{{ $reg->id }}]" value="absent">
                                                <label class="form-check-label">Absent</label>
                                            </div>
                                        </td>

                                        <td>{{ $reg->attendance_percentage ?? 0 }}%</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-success px-4">Submit Attendance</button>
                    </div>
                </form>
            @elseif($offeredCourseId)
                <div class="alert alert-warning mt-4">
                    No students registered for this course.
                </div>
            @endif
        </div>
    </div>
</div>

<x-faculityfooter />
