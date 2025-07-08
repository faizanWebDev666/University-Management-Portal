<x-header />

<section class="course-list-section pt-100 pb-100">
    <div class="container">
         <div class="text-center mb-5">
            <h2 class="text-white py-3" style="background-color: #009A9A; font-size: 30px;">Offer Courses List</h2>
        </div>

        @if (session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>Course No</th>
                        <th>Course Name</th>
                        <th>Credits</th>
                        <th>Professor</th>
                        <th>Class</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($offeredCourses as $offer)
                        @php
                            $registration = \App\Models\StudentCourseRegistration::where('student_id', session('id'))
                                ->where('offered_course_id', $offer->id)
                                ->first();
                        @endphp
                        <tr>
                            <td>{{ $offer->course->course_code ?? 'N/A' }}</td>
                            <td>{{ $offer->course->course_name ?? 'N/A' }}</td>
                            <td>({{ $offer->course->credit_hours ?? 'N/A' }})</td>
                            <td>{{ $offer->professor->name ?? 'N/A' }}</td>
                            <td>
                                @if ($offer->class)
                                    @php
                                        $semesterMap = [
                                            'Spring' => 'SP',
                                            'Fall' => 'FA',
                                            'Summer' => 'SU',
                                        ];
                                        $semester = $semesterMap[$offer->class->semester] ?? $offer->class->semester;
                                        $year = substr($offer->class->year, -2);
                                        $degree = strtoupper(substr($offer->class->degree_program, 0, 1));
                                        $department = strtoupper($offer->class->department);
                                        $section = strtoupper($offer->class->section);
                                    @endphp
                                    {{ $semester }}{{ $year }}-{{ $degree }}{{ $department }}-{{ $section }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('course.register') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="offered_course_id" value="{{ $offer->id }}">
                                    @if (!$registration)
                                        <button type="submit" class="btn btn-warning">Register</button>
                                    @elseif ($registration->status === 'registered')
                                        <button type="submit" class="btn btn-success">Unregister</button>
                                    @else
                                        <button type="submit" class="btn btn-warning">Register</button>
                                    @endif
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

<style>
    .course-list-section {
        background-color: #f8f9fa;
    }

    .btn-primary,
    .btn-success,
    .btn-warning {
        font-weight: bold;
        padding: 6px 12px;
    }
</style>
