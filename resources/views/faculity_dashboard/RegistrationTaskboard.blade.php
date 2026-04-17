<x-registrationheader />
<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
    .task-filter-btn {
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }
    .task-filter-btn.active {
        background-color: #6b73ff !important;
        color: white !important;
        border-color: #6b73ff;
    }
    .task-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .task-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    .pending-popup {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        display: none;
    }
</style>

<div class="registration-dashboard" style="background-color: #f0f2f5; min-height: 100vh; padding: 28px 28px 40px;">
    <div class="container-fluid">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="main-title mb-1">Professional Taskboard</h2>
                <p class="text-muted">Manage your tasks and keep track of your progress.</p>
            </div>
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-primary rounded-pill px-4" style="background: #f35d85; border: none;" onclick="showPendingPopup()">
                    <i class="bi bi-bell-fill me-2"></i> Status Summary
                </button>
            </div>
        </div>

        <!-- Filter Toggles -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="bg-white p-3 rounded-4 shadow-sm d-flex gap-3 align-items-center">
                    <span class="fw-bold text-dark me-2">Filter Tasks:</span>
                    <button class="btn btn-light rounded-pill px-4 task-filter-btn active" onclick="filterTasks('all', this)">
                        All Tasks ({{ $tasks->count() }})
                    </button>
                    <button class="btn btn-light rounded-pill px-4 task-filter-btn" onclick="filterTasks('Pending', this)">
                        Pending ({{ $tasks->whereIn('status', ['Pending', 'In Progress'])->count() }})
                    </button>
                    <button class="btn btn-light rounded-pill px-4 task-filter-btn" onclick="filterTasks('Completed', this)">
                        Completed ({{ $tasks->where('status', 'Completed')->count() }})
                    </button>
                </div>
            </div>
        </div>

        <!-- Tasks Grid -->
        <div class="row g-4" id="tasksContainer">
            @forelse($tasks as $task)
                <div class="col-lg-4 col-md-6 task-item" data-status="{{ in_array($task->status, ['Pending', 'In Progress']) ? 'Pending' : $task->status }}">
                    <div class="task-card rounded-4 p-4 h-100 bg-white shadow-sm border-0 position-relative overflow-hidden" 
                         style="cursor: pointer;" onclick="openTaskPreview({{ $task->id }})">
                        
                        <!-- Status Bar -->
                        <div class="position-absolute top-0 start-0 h-100" style="width: 4px; background: 
                            {{ $task->status == 'Completed' ? '#198754' : ($task->status == 'In Progress' ? '#0d6efd' : '#ffc107') }}"></div>

                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="task-icon rounded-3 d-flex align-items-center justify-content-center" 
                                 style="width: 40px; height: 40px; background: rgba(107, 115, 255, 0.1);">
                                <i class="bi bi-clipboard-check fs-5" style="color: #6b73ff;"></i>
                            </div>
                            <span class="badge rounded-pill px-3 py-1" 
                                  style="background: 
                                  {{ $task->status == 'Completed' ? 'rgba(25, 135, 84, 0.1)' : 
                                     ($task->status == 'In Progress' ? 'rgba(13, 110, 253, 0.1)' : 'rgba(255, 193, 7, 0.1)') }}; 
                                     color: 
                                  {{ $task->status == 'Completed' ? '#198754' : 
                                     ($task->status == 'In Progress' ? '#0d6efd' : '#ffc107') }}; 
                                     font-size: 0.75rem;">
                                {{ $task->status }}
                            </span>
                        </div>

                        <h5 class="fw-bold text-dark mb-2">{{ $task->title }}</h5>
                        <p class="text-muted small mb-3">{{ Str::limit($task->description, 100) }}</p>

                        <div class="d-flex justify-content-between align-items-center pt-3 border-top mt-auto">
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-calendar3 text-muted small"></i>
                                <small class="text-muted">{{ $task->due_date->format('M d, Y') }}</small>
                            </div>
                            <span class="badge rounded-pill px-2 py-1" style="background: rgba(243, 93, 133, 0.1); color: #f35d85; font-size: 0.7rem;">
                                {{ $task->priority }}
                            </span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <img src="backend_faculity/images/lazy.svg" data-src="backend_faculity/images/icon/icon_1.svg" alt="" class="lazy-img mb-3" style="width: 60px; opacity: 0.3;">
                    <h5 class="text-muted">No tasks found.</h5>
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Pending Count Popup (Bootstrap Toast Style) -->
<div class="pending-popup p-3 rounded-4 shadow-lg bg-white border-start border-4 border-warning" id="pendingPopup">
    <div class="d-flex align-items-center gap-3">
        <div class="bg-warning rounded-circle d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
            <i class="bi bi-exclamation-circle-fill text-white fs-4"></i>
        </div>
        <div>
            <h6 class="mb-0 fw-bold text-dark">Attention Required!</h6>
            <p class="mb-0 text-muted small">You have <strong>{{ $pendingCount }}</strong> pending tasks to complete.</p>
        </div>
        <button type="button" class="btn-close ms-2" onclick="document.getElementById('pendingPopup').style.display='none'"></button>
    </div>
</div>

<!-- Task Preview Modal (Using existing logic from index) -->
<div class="modal fade" id="taskPreviewModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header border-0 p-4" style="background: linear-gradient(135deg, #188ccc 0%, #117a8b 100%); color: white;">
                <h5 class="modal-title fw-bold"><i class="bi bi-eye-fill me-2"></i> Task Details</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 bg-white" id="taskPreviewContent">
                <!-- Content loaded via JS -->
            </div>
            <div class="modal-footer border-0 p-4 bg-light">
                <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    const tasksData = @json($tasks->keyBy('id'));

    function filterTasks(status, btn) {
        // Update active button
        document.querySelectorAll('.task-filter-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        // Filter items
        const items = document.querySelectorAll('.task-item');
        items.forEach(item => {
            if (status === 'all' || item.getAttribute('data-status') === status) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    }

    function showPendingPopup() {
        const popup = document.getElementById('pendingPopup');
        popup.style.display = 'block';
        setTimeout(() => {
            popup.style.display = 'none';
        }, 5000);
    }

    function openTaskPreview(taskId) {
        const task = tasksData[taskId];
        if (!task) return;
        
        const priorityColors = {
            'Urgent': { bg: 'rgba(220, 53, 69, 0.1)', text: '#dc3545' },
            'High': { bg: 'rgba(255, 193, 7, 0.1)', text: '#ffc107' },
            'Medium': { bg: 'rgba(13, 202, 240, 0.1)', text: '#0dcaf0' },
            'Low': { bg: 'rgba(108, 117, 125, 0.1)', text: '#6c757d' }
        };
        
        const statusColors = {
            'Completed': { bg: 'rgba(25, 135, 84, 0.1)', text: '#198754' },
            'In Progress': { bg: 'rgba(13, 110, 253, 0.1)', text: '#0d6efd' },
            'Overdue': { bg: 'rgba(220, 53, 69, 0.1)', text: '#dc3545' },
            'Pending': { bg: 'rgba(255, 193, 7, 0.1)', text: '#ffc107' }
        };
        
        const pColor = priorityColors[task.priority] || priorityColors['Low'];
        const sColor = statusColors[task.status] || statusColors['Pending'];
        
        const content = `
            <div class="task-preview-wrapper">
                <div class="text-center mb-4">
                    <h3 class="fw-bold text-dark mb-2">${task.title}</h3>
                    <div class="d-flex justify-content-center gap-2">
                        <span class="badge rounded-pill px-3 py-2" style="background: ${pColor.bg}; color: ${pColor.text};">
                            <i class="bi bi-flag-fill me-1"></i> ${task.priority} Priority
                        </span>
                        <span class="badge rounded-pill px-3 py-2" style="background: ${sColor.bg}; color: ${sColor.text};">
                            <i class="bi bi-info-circle-fill me-1"></i> ${task.status}
                        </span>
                    </div>
                </div>
                
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <div class="p-3 rounded-3" style="background: #f8f9fa; border-left: 4px solid #188ccc;">
                            <small class="text-muted d-block mb-1">Due Date</small>
                            <span class="fw-bold text-dark"><i class="bi bi-calendar-event me-2 text-primary"></i>${new Date(task.due_date).toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' })}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 rounded-3" style="background: #f8f9fa; border-left: 4px solid #188ccc;">
                            <small class="text-muted d-block mb-1">Assigned By</small>
                            <span class="fw-bold text-dark"><i class="bi bi-person-badge me-2 text-primary"></i>${task.creator?.name || 'Unknown'}</span>
                        </div>
                    </div>
                </div>
                
                <div class="mb-4">
                    <h6 class="fw-bold text-dark mb-3"><i class="bi bi-text-left me-2 text-primary"></i>Task Description</h6>
                    <div class="p-3 rounded-3" style="background: #f8f9fa; border: 1px solid #eee;">
                        <p class="mb-0 text-muted" style="line-height: 1.6; white-space: pre-wrap;">${task.description}</p>
                    </div>
                </div>

                ${task.file_path ? `
                <div class="mb-4">
                    <h6 class="fw-bold text-dark mb-3"><i class="bi bi-paperclip me-2 text-primary"></i>Attachment</h6>
                    <div class="p-3 rounded-3 d-flex align-items-center justify-content-between" style="background: #f8f9fa; border: 1px dashed #188ccc;">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-file-earmark-pdf-fill fs-3 text-danger me-3"></i>
                            <div>
                                <span class="d-block fw-bold text-dark">Related Document</span>
                                <small class="text-muted">Task reference file</small>
                            </div>
                        </div>
                        <a href="/storage/${task.file_path}" target="_blank" class="btn btn-primary rounded-pill btn-sm px-4" style="background: #f35d85; border-color: #f35d85;">
                            <i class="bi bi-download me-1"></i> View File
                        </a>
                    </div>
                </div>
                ` : ''}
                
                <div class="status-update-section mt-4 pt-4 border-top">
                    <h6 class="fw-bold text-dark mb-3"><i class="bi bi-arrow-repeat me-2 text-primary"></i>Update Status</h6>
                    <div class="d-flex flex-wrap gap-2">
                        <form method="POST" action="/admin/task/${task.id}/status" class="status-form m-0">
                            <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').content}">
                            <input type="hidden" name="_method" value="PATCH">
                            <input type="hidden" name="status" value="Pending">
                            <button type="submit" class="btn btn-sm ${task.status === 'Pending' ? 'btn-warning' : 'btn-outline-warning'} rounded-pill px-3">
                                Pending
                            </button>
                        </form>
                        <form method="POST" action="/admin/task/${task.id}/status" class="status-form m-0">
                            <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').content}">
                            <input type="hidden" name="_method" value="PATCH">
                            <input type="hidden" name="status" value="In Progress">
                            <button type="submit" class="btn btn-sm ${task.status === 'In Progress' ? 'btn-primary' : 'btn-outline-primary'} rounded-pill px-3">
                                In Progress
                            </button>
                        </form>
                        <form method="POST" action="/admin/task/${task.id}/status" class="status-form m-0">
                            <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').content}">
                            <input type="hidden" name="_method" value="PATCH">
                            <input type="hidden" name="status" value="Completed">
                            <button type="submit" class="btn btn-sm ${task.status === 'Completed' ? 'btn-success' : 'btn-outline-success'} rounded-pill px-3">
                                Completed
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        `;
        
        document.getElementById('taskPreviewContent').innerHTML = content;
        const modal = new bootstrap.Modal(document.getElementById('taskPreviewModal'));
        modal.show();
    }
</script>

<x-registrationfooter />