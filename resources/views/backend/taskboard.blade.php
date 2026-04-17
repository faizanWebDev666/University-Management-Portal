<x-admin-header />
<link rel="stylesheet" href="{{ asset('backend/css/font-fix.css') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
    // Global modal functions
    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.style.display = 'flex';
            modal.style.backgroundColor = 'rgba(0,0,0,0.5)';
            modal.classList.add('show');
            modal.style.alignItems = 'center';
            modal.style.justifyContent = 'center';
            document.body.style.overflow = 'hidden';
        }
    }

    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.style.display = 'none';
            modal.classList.remove('show');
            document.body.style.overflow = 'auto';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Add click handlers for modal triggers
        document.querySelectorAll('[data-target="#addTaskModal"]').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                openModal('addTaskModal');
            });
        });

        // Close modal handlers
        document.querySelectorAll('.close, [data-dismiss="modal"]').forEach(closeBtn => {
            closeBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                const modal = this.closest('.modal');
                if (modal) {
                    modal.style.display = 'none';
                    modal.classList.remove('show');
                    document.body.style.overflow = 'auto';
                }
            });
        });

        // Close modal when clicking outside
        document.querySelectorAll('.modal').forEach(modal => {
            modal.addEventListener('click', function(e) {
                if (e.target === this) {
                    this.style.display = 'none';
                    this.classList.remove('show');
                    document.body.style.overflow = 'auto';
                }
            });
        });

        // Handle escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                document.querySelectorAll('.modal.show').forEach(modal => {
                    modal.style.display = 'none';
                    modal.classList.remove('show');
                });
                document.body.style.overflow = 'auto';
            }
        });
    });
</script>
<div class="section-body">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center">
            <div class="header-action">
                <h1 class="page-title">Taskboard</h1>
                <ol class="breadcrumb page-breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Ericsson</a></li>
                    <li class="breadcrumb-item"><a href="#">University</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Taskboard</li>
                </ol>
            </div>
            <ul class="nav nav-tabs page-header-tab">
                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#task-list">Task List</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#add-task">Add Task</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#task-stats">Statistics</a></li>
            </ul>
        </div>
    </div>
</div>

<div class="section-body mt-4">
    <div class="container-fluid">
        <div class="tab-content">
            <!-- Task List Tab -->
            <div class="tab-pane fade show active" id="task-list">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">All Tasks</h3>
                                <div class="card-options">
                                    <button class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#addTaskModal">
                                        <i class="fa fa-plus"></i> Add New Task
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-vcenter text-nowrap mb-0">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>ID</th>
                                                <th>Task Title</th>
                                                <th>Description</th>
                                                <th>Department</th>
                                                <th>Priority</th>
                                                <th>Status</th>
                                                <th>Created By</th>
                                                <th>Due Date</th>
                                                <th>File</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($tasks->count() > 0)
                                                @foreach ($tasks as $task)
                                                    <tr>
                                                        <td>{{ $task->id }}</td>
                                                        <td><strong>{{ $task->title }}</strong></td>
                                                        <td>{{ Str::limit($task->description, 50) }}</td>
                                                        <td><span
                                                                class="badge badge-info">{{ $task->department }}</span>
                                                        </td>
                                                        <td>
                                                            <span
                                                                class="badge badge-{{ $task->priority == 'Urgent'
                                                                    ? 'danger'
                                                                    : ($task->priority == 'High'
                                                                        ? 'warning'
                                                                        : ($task->priority == 'Medium'
                                                                            ? 'info'
                                                                            : 'secondary')) }}">
                                                                {{ $task->priority }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <span
                                                                class="badge badge-{{ $task->status == 'Completed'
                                                                    ? 'success'
                                                                    : ($task->status == 'In Progress'
                                                                        ? 'primary'
                                                                        : ($task->status == 'Overdue'
                                                                            ? 'danger'
                                                                            : 'warning')) }}">
                                                                {{ $task->status }}
                                                            </span>
                                                        </td>
                                                        <td>{{ $task->creator->name ?? 'Unknown' }}</td>
                                                        <td>{{ $task->due_date->format('M d, Y') }}</td>
                                                        <td>
                                                            @if ($task->file_path)
                                                                <a href="{{ asset('storage/' . $task->file_path) }}"
                                                                    target="_blank"
                                                                    class="btn btn-sm btn-outline-primary"
                                                                    title="View Attachment">
                                                                    <i class="fa fa-paperclip"></i>
                                                                </a>
                                                            @else
                                                                <span class="text-muted">-</span>
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            <div class="btn-group">
                                                                <button class="btn btn-sm btn-info"
                                                                    onclick="openTaskPreview({{ $task->id }})"
                                                                    title="View Task">
                                                                    <i class="fa fa-eye"></i>
                                                                </button>
                                                                <button class="btn btn-sm btn-warning"
                                                                    title="Edit Task">
                                                                    <i class="fa fa-edit"></i>
                                                                </button>
                                                                <div class="btn-group">
                                                                    <button type="button"
                                                                        class="btn btn-sm btn-success dropdown-toggle"
                                                                        data-toggle="dropdown" title="Manage Status">
                                                                        <i class="fa fa-check-circle"></i>
                                                                    </button>
                                                                    <div class="dropdown-menu dropdown-menu-right">
                                                                        <form method="POST"
                                                                            action="{{ route('admin.task.updateStatus', $task->id) }}"
                                                                            class="status-form">
                                                                            @csrf
                                                                            @method('PATCH')
                                                                            <input type="hidden" name="status"
                                                                                value="Pending">
                                                                            <button type="submit"
                                                                                class="dropdown-item {{ $task->status == 'Pending' ? 'active' : '' }}">
                                                                                <span
                                                                                    class="badge badge-warning mr-2">Pending</span>
                                                                                Set as Pending
                                                                            </button>
                                                                        </form>
                                                                        <form method="POST"
                                                                            action="{{ route('admin.task.updateStatus', $task->id) }}"
                                                                            class="status-form">
                                                                            @csrf
                                                                            @method('PATCH')
                                                                            <input type="hidden" name="status"
                                                                                value="In Progress">
                                                                            <button type="submit"
                                                                                class="dropdown-item {{ $task->status == 'In Progress' ? 'active' : '' }}">
                                                                                <span
                                                                                    class="badge badge-primary mr-2">In
                                                                                    Progress</span> Set as In Progress
                                                                            </button>
                                                                        </form>
                                                                        <form method="POST"
                                                                            action="{{ route('admin.task.updateStatus', $task->id) }}"
                                                                            class="status-form">
                                                                            @csrf
                                                                            @method('PATCH')
                                                                            <input type="hidden" name="status"
                                                                                value="Completed">
                                                                            <button type="submit"
                                                                                class="dropdown-item {{ $task->status == 'Completed' ? 'active' : '' }}">
                                                                                <span
                                                                                    class="badge badge-success mr-2">Completed</span>
                                                                                Set as Completed
                                                                            </button>
                                                                        </form>
                                                                        <form method="POST"
                                                                            action="{{ route('admin.task.updateStatus', $task->id) }}"
                                                                            class="status-form">
                                                                            @csrf
                                                                            @method('PATCH')
                                                                            <input type="hidden" name="status"
                                                                                value="Overdue">
                                                                            <button type="submit"
                                                                                class="dropdown-item {{ $task->status == 'Overdue' ? 'active' : '' }}">
                                                                                <span
                                                                                    class="badge badge-danger mr-2">Overdue</span>
                                                                                Set as Overdue
                                                                            </button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="9" class="text-center py-5">
                                                        <div class="empty-state">
                                                            <i class="fa fa-tasks fa-3x text-muted mb-3"></i>
                                                            <h4 class="text-muted">No tasks found</h4>
                                                            <p class="text-muted">Create your first task to get
                                                                started!</p>
                                                            <button class="btn btn-primary" data-toggle="modal"
                                                                data-target="#addTaskModal">
                                                                <i class="fa fa-plus"></i> Add Your First Task
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add Task Tab -->
            <div class="tab-pane fade" id="add-task">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Create New Task</h3>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('admin.task.store') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label>Task Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="title" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Description <span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="description" rows="4" required></textarea>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Department <span class="text-danger">*</span></label>
                                                <select class="form-control" name="department" required>
                                                    <option value="">Select Department</option>
                                                    @foreach ($departments as $department)
                                                        <option value="{{ $department }}">{{ $department }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Priority <span class="text-danger">*</span></label>
                                                <select class="form-control" name="priority" required>
                                                    <option value="">Select Priority</option>
                                                    <option value="Low">Low</option>
                                                    <option value="Medium">Medium</option>
                                                    <option value="High">High</option>
                                                    <option value="Urgent">Urgent</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Due Date <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control" name="due_date" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Attach File (Optional)</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="file"
                                                        id="taskFileTab">
                                                    <label class="custom-file-label" for="taskFileTab">Choose
                                                        file</label>
                                                </div>
                                                <small class="text-muted">Max file size: 10MB (PDF, DOC,
                                                    Images)</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-save"></i> Create Task
                                        </button>
                                        <button type="reset" class="btn btn-secondary">
                                            <i class="fa fa-refresh"></i> Reset
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Quick Stats</h3>
                            </div>
                            <div class="card-body">
                                <div class="d-flex mb-3">
                                    <div class="flex-fill">
                                        <div class="h6 mb-0">Total Tasks</div>
                                        <div class="font-20 font-weight-bold">{{ $tasks->count() }}</div>
                                    </div>
                                    <div class="flex-fill text-right">
                                        <div class="h6 mb-0">Pending</div>
                                        <div class="font-20 font-weight-bold text-warning">
                                            {{ $tasks->where('status', 'Pending')->count() }}</div>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="flex-fill">
                                        <div class="h6 mb-0">Completed</div>
                                        <div class="font-20 font-weight-bold text-success">
                                            {{ $tasks->where('status', 'Completed')->count() }}</div>
                                    </div>
                                    <div class="flex-fill text-right">
                                        <div class="h6 mb-0">Overdue</div>
                                        <div class="font-20 font-weight-bold text-danger">
                                            {{ $tasks->where('status', 'Overdue')->count() }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Shared Files Tab -->
            <div class="tab-pane fade" id="shared-files">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Shared Files & Information</h3>
                                <div class="card-options">
                                    <button class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#shareFileModal">
                                        <i class="fa fa-share"></i> Share File/Information
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-vcenter text-nowrap mb-0">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>ID</th>
                                                <th>File/Info Title</th>
                                                <th>Type</th>
                                                <th>Department</th>
                                                <th>Shared By</th>
                                                <th>Shared Date</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="8" class="text-center">No shared files found. Share
                                                    your first file!</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Task Modal -->
<div class="modal fade" id="addTaskModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header"
                style="background: linear-gradient(135deg, #188ccc 0%, #117a8b 100%); color: white;">
                <h5 class="modal-title"><i class="fa fa-plus-circle mr-2"></i> Add New Task</h5>
                <button type="button" class="close" data-dismiss="modal" style="color: white;">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('admin.task.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label class="font-weight-bold">Task Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title" placeholder="Enter task title"
                            required>
                    </div>

                    <div class="form-group mb-3">
                        <label class="font-weight-bold">Description <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="description" rows="4" placeholder="Enter detailed description" required></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="font-weight-bold">Department <span class="text-danger">*</span></label>
                                <select class="form-control" name="department" required>
                                    <option value="">Select Department</option>
                                    @foreach ($departments as $dept)
                                        <option value="{{ $dept->name }}">{{ $dept->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="font-weight-bold">Priority <span class="text-danger">*</span></label>
                                <select class="form-control" name="priority" required>
                                    <option value="">Select Priority</option>
                                    <option value="Low">Low</option>
                                    <option value="Medium">Medium</option>
                                    <option value="High">High</option>
                                    <option value="Urgent">Urgent</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="font-weight-bold">Due Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="due_date" required
                                    min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="font-weight-bold">Attach File</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="file" id="taskFile">
                                    <label class="custom-file-label" for="taskFile">Choose file</label>
                                </div>
                                <small class="text-muted">Max file size: 10MB (PDF, DOC, Images)</small>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="form-group text-right mb-0">
                        <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary px-4 ml-2"
                            style="background: #f35d85; border-color: #f35d85;">
                            <i class="fa fa-save mr-1"></i> Create Task
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Update custom file label on change
    document.addEventListener('change', function(e) {
        if (e.target && (e.target.id === 'taskFile' || e.target.id === 'taskFileTab' || e.target.id ===
                'shareFiles')) {
            var fileName = e.target.files.length > 1 ? e.target.files.length + ' files selected' : (e.target
                .files[0]?.name || 'Choose file');
            var label = e.target.nextElementSibling;
            if (label && label.classList.contains('custom-file-label')) {
                label.innerText = fileName;
            }
        }
    });
</script>

<!-- Share File Modal -->
<div class="modal fade" id="shareFileModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header"
                style="background: linear-gradient(135deg, #188ccc 0%, #117a8b 100%); color: white;">
                <h5 class="modal-title"><i class="fa fa-share mr-2"></i> Share File/Information</h5>
                <button type="button" class="close" data-dismiss="modal" style="color: white;">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('admin.file.share') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label class="font-weight-bold">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title" placeholder="Enter title"
                            required>
                    </div>

                    <div class="form-group mb-3">
                        <label class="font-weight-bold">Description/Message <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="description" rows="3" placeholder="Enter message" required></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="font-weight-bold">Department <span class="text-danger">*</span></label>
                                <select class="form-control" name="department" required>
                                    <option value="">Select Department</option>
                                    <option value="Accommodation">Accommodation</option>
                                    <option value="Finance">Finance</option>
                                    <option value="Registration">Registration</option>
                                    <option value="All Departments">All Departments</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="font-weight-bold">Type <span class="text-danger">*</span></label>
                                <select class="form-control" name="type" required>
                                    <option value="">Select Type</option>
                                    <option value="File">File Attachment</option>
                                    <option value="Information">Information Only</option>
                                    <option value="Notice">Notice</option>
                                    <option value="Announcement">Announcement</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="font-weight-bold">Attach Files (Optional)</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="files[]" id="shareFiles" multiple>
                            <label class="custom-file-label" for="shareFiles">Choose files</label>
                        </div>
                        <small class="text-muted">You can upload multiple files</small>
                    </div>

                    <hr>
                    <div class="form-group text-right mb-0">
                        <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary px-4 ml-2"
                            style="background: #f35d85; border-color: #f35d85;">
                            <i class="fa fa-share mr-1"></i> Share
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Task Preview Modal -->
<div class="modal fade" id="taskPreviewModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header"
                style="background: linear-gradient(135deg, #188ccc 0%, #117a8b 100%); color: white;">
                <h5 class="modal-title"><i class="fa fa-eye mr-2"></i> Task Preview</h5>
                <button type="button" class="close" onclick="closeModal('taskPreviewModal')"
                    style="color: white;">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body" id="taskPreviewContent">
                <!-- Task details will be loaded here dynamically -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    onclick="closeModal('taskPreviewModal')">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Task data storage
    const tasksData = @json($tasks->keyBy('id'));

    // Open task preview modal
    function openTaskPreview(taskId) {
        const task = tasksData[taskId];
        if (!task) return;

        const priorityBadgeClass = {
            'Urgent': 'danger',
            'High': 'warning',
            'Medium': 'info',
            'Low': 'secondary'
        } [task.priority] || 'secondary';

        const statusBadgeClass = {
            'Completed': 'success',
            'In Progress': 'primary',
            'Overdue': 'danger',
            'Pending': 'warning'
        } [task.status] || 'warning';

        const content = `
        <div class="task-preview">
            <!-- Task Header -->
            <div class="text-center mb-4">
                <h3 class="font-weight-bold">${task.title}</h3>
                <div class="d-flex justify-content-center gap-2 mt-2">
                    <span class="badge badge-${priorityBadgeClass} px-3 py-2">${task.priority} Priority</span>
                    <span class="badge badge-${statusBadgeClass} px-3 py-2">${task.status}</span>
                </div>
            </div>
            
            <!-- Task Details Grid -->
            <div class="row mb-4">
                <div class="col-md-6 mb-3">
                    <div class="detail-card p-3 rounded" style="background: #f8f9fa;">
                        <small class="text-muted d-block mb-1">Department</small>
                        <strong style="color: #333;"><i class="fa fa-building mr-2" style="color: #188ccc;"></i>${task.department}</strong>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="detail-card p-3 rounded" style="background: #f8f9fa;">
                        <small class="text-muted d-block mb-1">Due Date</small>
                        <strong style="color: #333;"><i class="fa fa-calendar mr-2" style="color: #188ccc;"></i>${new Date(task.due_date).toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' })}</strong>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="detail-card p-3 rounded" style="background: #f8f9fa;">
                        <small class="text-muted d-block mb-1">Created By</small>
                        <strong style="color: #333;"><i class="fa fa-user mr-2" style="color: #188ccc;"></i>${task.creator?.name || 'Unknown'}</strong>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="detail-card p-3 rounded" style="background: #f8f9fa;">
                        <small class="text-muted d-block mb-1">Created Date</small>
                        <strong style="color: #333;"><i class="fa fa-clock-o mr-2" style="color: #188ccc;"></i>${new Date(task.created_at).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' })}</strong>
                    </div>
                </div>
            </div>
            
            <!-- Description Section -->
            <div class="mb-4">
                <h5 class="font-weight-bold mb-3" style="color: #188ccc;">
                    <i class="fa fa-align-left mr-2"></i>Description
                </h5>
                <div class="p-3 rounded" style="background: #f8f9fa; border-left: 4px solid #188ccc;">
                    <p class="mb-0" style="line-height: 1.8; white-space: pre-wrap; color: #333;">${task.description}</p>
                </div>
            </div>

            ${task.file_path ? `
            <!-- Attachment Section -->
            <div class="mb-4">
                <h5 class="font-weight-bold mb-3" style="color: #188ccc;">
                    <i class="fa fa-paperclip mr-2"></i>Attachment
                </h5>
                <div class="p-3 rounded d-flex align-items-center justify-content-between" style="background: #f8f9fa; border: 1px dashed #188ccc;">
                    <div class="d-flex align-items-center">
                        <i class="fa fa-file-pdf-o fa-2x mr-3 text-danger"></i>
                        <div>
                            <span class="d-block font-weight-bold" style="color: #333;">Task Attachment</span>
                            <small class="text-muted">Click to view or download</small>
                        </div>
                    </div>
                    <a href="/storage/${task.file_path}" target="_blank" class="btn btn-sm btn-primary" style="background: #f35d85; border-color: #f35d85;">
                        <i class="fa fa-download mr-1"></i> View File
                    </a>
                </div>
            </div>
            ` : ''}
            
            <!-- Status Management Section -->
            <div class="mb-3">
                <h5 class="font-weight-bold mb-3" style="color: #188ccc;">
                    <i class="fa fa-tasks mr-2"></i>Manage Status
                </h5>
                <div class="d-flex flex-wrap gap-2">
                    <form method="POST" action="/admin/task/${task.id}/status" class="m-0">
                        <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]')?.content || ''}">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="status" value="Pending">
                        <button type="submit" class="btn ${task.status === 'Pending' ? 'btn-warning' : 'btn-outline-warning'}">
                            <i class="fa fa-clock-o mr-1"></i> Pending
                        </button>
                    </form>
                    <form method="POST" action="/admin/task/${task.id}/status" class="m-0">
                        <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]')?.content || ''}">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="status" value="In Progress">
                        <button type="submit" class="btn ${task.status === 'In Progress' ? 'btn-primary' : 'btn-outline-primary'}">
                            <i class="fa fa-spinner mr-1"></i> In Progress
                        </button>
                    </form>
                    <form method="POST" action="/admin/task/${task.id}/status" class="m-0">
                        <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]')?.content || ''}">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="status" value="Completed">
                        <button type="submit" class="btn ${task.status === 'Completed' ? 'btn-success' : 'btn-outline-success'}">
                            <i class="fa fa-check mr-1"></i> Completed
                        </button>
                    </form>
                    <form method="POST" action="/admin/task/${task.id}/status" class="m-0">
                        <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]')?.content || ''}">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="status" value="Overdue">
                        <button type="submit" class="btn ${task.status === 'Overdue' ? 'btn-danger' : 'btn-outline-danger'}">
                            <i class="fa fa-exclamation-triangle mr-1"></i> Overdue
                        </button>
                    </form>
                </div>
            </div>
        </div>
    `;

        document.getElementById('taskPreviewContent').innerHTML = content;
        openModal('taskPreviewModal');
    }
</script>
