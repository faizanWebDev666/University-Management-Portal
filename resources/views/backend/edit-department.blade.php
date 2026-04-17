<x-admin-header />

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header border-0 py-4" style="background: linear-gradient(135deg, #188ccc 0%, #117a8b 100%) !important;">
                    <h4 class="mb-0 text-white fw-bold"><i class="fa fa-edit mr-2"></i> Edit Department: {{ $department->name }}</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('departments.update', $department->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-4">
                            <label class="font-weight-bold text-dark mb-2">Department Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control rounded-3" value="{{ old('name', $department->name) }}" required>
                        </div>

                        <div class="form-group mb-4">
                            <label class="font-weight-bold text-dark mb-2">Department Code <span class="text-danger">*</span></label>
                            <input type="text" name="code" class="form-control rounded-3" value="{{ old('code', $department->code) }}" required>
                        </div>

                        <hr class="my-4 opacity-50">

                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('departments.index') }}" class="btn btn-secondary px-4 rounded-pill">
                                <i class="fa fa-arrow-left mr-1"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary px-5 rounded-pill shadow-sm" style="background: #f35d85; border-color: #f35d85;">
                                <i class="fa fa-save mr-1"></i> Update Department
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<x-admin-footer />