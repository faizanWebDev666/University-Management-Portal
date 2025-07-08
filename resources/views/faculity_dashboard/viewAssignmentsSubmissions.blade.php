<x-faculityheader/>

<style>
    body {
        background-color: #000;
        color: #E0FFFF;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    h2 {
        color: #00CED1;
        text-align: center;
        margin-top: 20px;
    }

    h4 {
        color: #20B2AA;
        text-align: center;
        margin-top: 10px;
    }

    table {
        width: 90%;
        margin: 20px auto;
        border-collapse: collapse;
        background-color: #1a1a1a;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 0 10px #00CED1;
    }

    th, td {
        padding: 15px;
        text-align: center;
        border-bottom: 1px solid #444;
    }

    th {
        background-color: #00CED1;
        color: #000;
        font-weight: bold;
    }

    td a {
        color: #00CED1;
        text-decoration: underline;
    }

    input[type="number"] {
        width: 100px;
        padding: 8px;
        border: none;
        border-radius: 5px;
        background-color: #333;
        color: #E0FFFF;
    }

    input[type="number"]::placeholder {
        color: #aaa;
    }

    button {
        padding: 8px 12px;
        margin-left: 10px;
        background-color: #00CED1;
        color: black;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
        transition: 0.3s;
    }

    button:hover {
        background-color: #20B2AA;
    }

    form {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 5px;
    }
</style>

<h2>Submissions for: {{ $assignment->title }}</h2>
<h4>Total Marks: {{ $assignment->total_marks }}</h4>

<table>
    <tr>
        <th>Student</th>
        <th>File</th>
        <th>Submitted At</th>
        <th>Marks<br><small>(out of {{ $assignment->total_marks }})</small></th>
        <th>Action</th>
    </tr>
    @foreach($assignment->submissions as $submission)
    <tr>
        <td>{{ $submission->student->name }}</td>
        <td><a href="{{ asset('storage/' . $submission->file_path) }}" target="_blank">View</a></td>
        <td>{{ $submission->submitted_at }}</td>
        <td>{{ $submission->marks ?? 'Not Graded' }}</td>
        <td>
            <form method="POST" action="{{ route('submissions.grade', $submission->id) }}">
                @csrf
                <input type="number" name="marks" placeholder="Enter Marks" min="0" max="{{ $assignment->total_marks }}">
                <button type="submit">Submit</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

<x-faculityfooter/>
