<x-registrationheader/>

<h2 class="main-title">Allocate Courses to Professor</h2>

<form action="{{ route('professor.courses.store') }}" method="POST">
    @csrf
    <div class="bg-white card-box border-20">
        <h4 class="dash-title-three">Allocate Courses</h4>

        <div class="row">
            <div class="col-md-6">
                <div class="dash-input-wrapper mb-30">
                    <label for="">Select Professor*</label>
                    <select class="nice-select" name="professor_id" required>
                        <option value="" disabled selected>Select Professor</option>
                        @foreach($professors as $professor)
                            <option value="{{ $professor->id }}">{{ $professor->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="dash-input-wrapper mb-30">
                    <label for="">Select Course(s)*</label>
                    <select class="nice-select" name="course_ids[]" multiple required>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                        @endforeach
                    </select>
                    <small>Select multiple courses by holding Ctrl (Windows) or Command (Mac)</small>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="dash-input-wrapper mb-30">
                        <label for="">Select Class*</label>
                        <select class="nice-select" name="class_id" required>
                            <option value="" disabled selected>Select Class</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}">
                                    {{ $class->degree_program }} {{ $class->department }} - {{ $class->section }} ({{ $class->semester }} {{ $class->year }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <div class="button-group d-inline-flex align-items-center mt-30">
        <button type="submit" class="dash-btn-two tran3s me-3">Allocate Courses</button>
        <a href="#" class="dash-cancel-btn tran3s">Cancel</a>
    </div>

</form>

<x-registrationfooter/>
