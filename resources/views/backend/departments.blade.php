<x-admin-header />
<link rel="stylesheet" href="{{ asset('backend/css/taskboard-fix.css') }}">

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 style="color: #f35d85;">Departments</h2>
        <!-- Add New Department -->
        <a href="{{ route('departments.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"></i> Add New Department
        </a>
    </div>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead style="background: #f8f9fa;">
                    <tr>
                        <th class="px-4 py-3 text-muted small text-uppercase fw-bold">Code</th>
                        <th class="py-3 text-muted small text-uppercase fw-bold">Department Name</th>
                        <th class="py-3 text-center text-muted small text-uppercase fw-bold">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($departments as $dept)
                        <tr>
                            <td class="px-4 fw-bold text-dark">{{ $dept->code }}</td>
                            <td>
                                <a href="{{ route('departments.show', $dept->name) }}" class="text-decoration-none fw-bold" style="color: #188ccc;">
                                    {{ $dept->name }}
                                </a>
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('departments.edit', $dept->name) }}" class="btn btn-sm btn-outline-info" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-danger" title="Delete" 
                                            onclick="confirmDelete('{{ $dept->id }}', '{{ $dept->name }}')">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    <form id="delete-form-{{ $dept->id }}" action="{{ route('departments.destroy', $dept->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-5 text-muted">
                                <i class="fa fa-building fa-3x mb-3 d-block opacity-25"></i>
                                No departments found. Create your first department to get started!
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteConfirmModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content shadow-lg border-0">
            <div class="modal-header bg-danger text-white border-0 py-3">
                <h5 class="modal-title fw-bold"><i class="fa fa-exclamation-triangle mr-2"></i> Confirm Delete</h5>
                <button type="button" class="close text-white" onclick="closeModal('deleteConfirmModal')">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body p-4 text-center">
                <div class="mb-3">
                    <i class="fa fa-trash-o fa-4x text-danger opacity-25"></i>
                </div>
                <h5 class="text-dark mb-2">Are you sure?</h5>
                <p class="text-muted small mb-0">You are about to delete <strong id="deleteDeptName" class="text-danger"></strong>. This action will also remove all associated classes and students!</p>
            </div>
            <div class="modal-footer border-0 p-3 bg-light d-flex justify-content-between">
                <button type="button" class="btn btn-secondary px-4 rounded-pill" onclick="closeModal('deleteConfirmModal')">Cancel</button>
                <button type="button" id="confirmDeleteBtn" class="btn btn-danger px-4 rounded-pill shadow-sm">Delete Now</button>
            </div>
        </div>
    </div>
</div>

<script>
let currentDeleteId = null;

function openModal(id) {
    const modal = document.getElementById(id);
    modal.classList.add('show');
    modal.style.display = 'block';
    document.body.style.overflow = 'hidden';
}

function closeModal(id) {
    const modal = document.getElementById(id);
    modal.classList.remove('show');
    modal.style.display = 'none';
    document.body.style.overflow = 'auto';
}

function confirmDelete(id, name) {
    currentDeleteId = id;
    document.getElementById('deleteDeptName').innerText = name;
    openModal('deleteConfirmModal');
}

document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
    if (currentDeleteId) {
        document.getElementById('delete-form-' + currentDeleteId).submit();
    }
});

// Close modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('deleteConfirmModal');
    if (event.target == modal) {
        closeModal('deleteConfirmModal');
    }
}
</script>

<x-admin-footer />
