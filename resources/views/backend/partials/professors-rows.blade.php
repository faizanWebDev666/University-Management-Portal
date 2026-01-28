@forelse($professors as $prof)
<tr>
    <td>{{ $prof->id }}</td>
    <td>{{ $prof->full_name }}</td>
    <td>{{ $prof->father_name }}</td>
    <td>{{ $prof->cnic }}</td>
    <td>{{ \Carbon\Carbon::parse($prof->dob)->format('d M Y') }}</td>
    <td>{{ ucfirst($prof->gender) }}</td>
    <td>{{ $prof->email }}</td>
</tr>
@empty
<tr>
    <td colspan="7" class="text-center text-muted">
        No professors found
    </td>
</tr>
@endforelse
