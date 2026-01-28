@forelse($users as $user)
<tr>
    <td>{{ $user->id }}</td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>{{ $user->type }}</td>
    <td>{{ $user->created_at->format('d M Y') }}</td>
    <td>
        <a href="#" class="btn btn-sm btn-outline-primary">
            <i class="fa fa-eye"></i>
        </a>
        <a href="#" class="btn btn-sm btn-outline-secondary">
            <i class="fa fa-edit"></i>
        </a>
        <button class="btn btn-sm btn-outline-danger">
            <i class="fa fa-trash-o"></i>
        </button>
    </td>
</tr>
@empty
<tr>
    <td colspan="6" class="text-center text-muted">
        No users found
    </td>
</tr>
@endforelse
