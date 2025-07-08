<x-faculityheader />

<h2 class="main-title">My Courses</h2>

<div class="row">
    @if (!empty($professor->offeredCourses) && count($professor->offeredCourses) > 0)
        @foreach ($professor->offeredCourses as $offered)
            <div class="col-lg-3 col-6">
                <a href="" class="text-decoration-none text-dark">
                    <div class="dash-card-one bg-white border-30 position-relative mb-15">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <img src="{{ asset('images/lazy.svg') }}" data-src="{{ asset('images/icon/icon_12.svg') }}"
                                alt="" class="lazy-img">
                        </div>
                        <div class="order-sm-0">
                            <div class="value fw-500">{{ $offered->course->course_name }}</div>
                            <div class="small-text">
                                By {{ $professor->name }} <br>
                                @if ($offered->class)
                                    {{ strtoupper(substr($offered->class->semester, 0, 2)) }}{{ substr($offered->class->year, -2) }}-
                                    {{ strtoupper(substr($offered->class->degree_program, 0, 1)) }}{{ strtoupper($offered->class->department) }}-
                                    {{ strtoupper($offered->class->section) }}
                                @else
                                    No Class Assigned
                                @endif
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    @else
        <div class="col-12">
            <div class="alert alert-info text-center">
                No assigned courses.
            </div>
        </div>
    @endif
</div>
