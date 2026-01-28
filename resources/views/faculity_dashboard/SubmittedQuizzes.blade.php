<x-faculityheader />

<div class="container">
    <h2 class="mb-4">Submissions for Quiz: {{ $quiz->quiz_title }}</h2>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Student Name</th>
                <th>Answer File</th>
                <th>MCQ Answers</th>
                <th>Submitted At</th>
                <th>Marks</th>
                <th>Update Marks</th>
            </tr>
        </thead>
      <tbody>
    @forelse($quiz->submissions as $submission)
        <tr>
            <td>{{ $submission->student->full_name ?? 'Unknown' }}</td>
            <td>
                @if($submission->answer_file)
                    <a href="{{ asset('storage/'.$submission->answer_file) }}" target="_blank" class="btn btn-sm btn-outline-primary">Download</a>
                @else
                    No File
                @endif
            </td>
            <td>
                @if($submission->mcq_answers)
                    <pre>{{ json_encode(json_decode($submission->mcq_answers), JSON_PRETTY_PRINT) }}</pre>
                @else
                    N/A
                @endif
            </td>
            <td>{{ \Carbon\Carbon::parse($submission->submitted_at)->format('d M Y h:i A') }}</td>
            <td>{{ $submission->marks ?? 'Not Graded' }}</td>
            <td>
                <form action="{{ route('teacher.update.marks', $submission->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="input-group">
                        <input type="number" name="marks" step="0.01" class="form-control" value="{{ $submission->marks }}" placeholder="Enter marks">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="6" class="text-center">No submissions yet.</td>
        </tr>
    @endforelse
</tbody>

    </table>
</div>
<x-faculityfooter />
