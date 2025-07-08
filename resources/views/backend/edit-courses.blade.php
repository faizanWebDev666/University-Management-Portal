<x-admin-header />

<div class="container mt-5">
    <h2>Edit Course</h2>

    <form action="{{ route('courses.update', $course->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="course_name">Course Name</label>
            <input type="text" class="form-control" id="course_name" name="course_name" value="{{ $course->course_name }}"
                required>
        </div>

        <div class="form-group">
            <label for="course_code">Course Code</label>
            <input type="text" class="form-control" id="course_code" name="course_code"
                value="{{ $course->course_code }}" required>
        </div>

        <div class="form-group">
            <label for="credit_hours">Credit Hours</label>
            <select class="form-control" id="credit_hours" name="credit_hours" required>
                <option value="" disabled
                    {{ old('credit_hours', $course->credit_hours) == '' ? 'selected' : '' }}>Select Credit Hours
                </option>
                <option value="3,1" {{ old('credit_hours', $course->credit_hours) == '3,1' ? 'selected' : '' }}>3,1
                </option>
                <option value="4,1" {{ old('credit_hours', $course->credit_hours) == '4,1' ? 'selected' : '' }}>4,1
                </option>
                <option value="3,0" {{ old('credit_hours', $course->credit_hours) == '3,0' ? 'selected' : '' }}>3,0
                </option>
                <option value="2,1" {{ old('credit_hours', $course->credit_hours) == '2,1' ? 'selected' : '' }}>2,1
                </option>
                <option value="4,0" {{ old('credit_hours', $course->credit_hours) == '4,0' ? 'selected' : '' }}>4,0
                </option>
            </select>
        </div>



        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="4" required>{{ $course->description }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Course</button>
        <a href="{{ route('display.Courses') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<x-admin-footer />
