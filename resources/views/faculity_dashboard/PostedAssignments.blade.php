<x-faculityheader/>
<h2>Your Posted Assignments</h2>
<table>
    <tr>
        <th>Title</th>
        <th>Deadline</th>
        <th>Action</th>
    </tr>
    @foreach($assignments as $assignment)
    <tr>
        <td>{{ $assignment->assignment_title }}</td>
        <td>{{ $assignment->deadline }}</td>
        <td>
            <a href="{{ route('teacher.viewSubmissions', $assignment->id) }}">View Submissions</a>
        </td>
    </tr>
    @endforeach
</table>
