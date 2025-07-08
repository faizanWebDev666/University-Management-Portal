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
        margin-top: 30px;
        margin-bottom: 20px;
        font-size: 2rem;
        border-bottom: 2px solid #00CED1;
        display: inline-block;
        padding-bottom: 5px;
    }

    table {
        width: 80%;
        margin: 30px auto;
        border-collapse: collapse;
        background-color: #1a1a1a;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 0 10px #00CED1;
    }

    th, td {
        padding: 15px;
        text-align: center;
        border-bottom: 1px solid #333;
    }

    th {
        background-color: #00CED1;
        color: #000;
        font-weight: bold;
    }

    tr:hover {
        background-color: #262626;
    }

    td a {
        color: #00CED1;
        font-weight: bold;
        text-decoration: none;
        transition: 0.3s;
    }

    td a:hover {
        color: #20B2AA;
        text-decoration: underline;
    }

    .no-data {
        text-align: center;
        margin-top: 40px;
        color: #888;
        font-size: 1.2rem;
    }
</style>

<h2>Students Assignments</h2>

@if($assignments->isEmpty())
    <div class="no-data">No assignments uploaded yet.</div>
@else
    <table>
        <tr>
            <th>Title</th>
            <th>Class</th>
            <th>Course</th>
            <th>Action</th>
        </tr>
        @foreach($assignments as $assignment)
        <tr>
            <td>{{ $assignment->assignment_title }}</td>
            <td>{{ $assignment->class->formatted_semester ?? 'N/A' }}-{{ $assignment->class->degree_program	 ?? 'N/A' }}{{ $assignment->class->department	 ?? 'N/A' }}-{{ $assignment->class->section	 ?? 'N/A' }}</td>
            <td>{{ $assignment->course->course_name ?? 'N/A' }}</td>
            <td>
                <a href="{{ route('view.assignments', ['id' => $assignment->id]) }}">View Submissions</a>
            </td>
        </tr>
        @endforeach
    </table>
@endif

<x-faculityfooter/>
