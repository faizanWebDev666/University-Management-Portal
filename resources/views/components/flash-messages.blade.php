<style>
    .custom-alert {
        border: none;
        border-left: 4px solid;
        border-radius: 6px;
        padding: 0.75rem 1.25rem;
        margin-bottom: 1rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        position: relative;
        transition: all 0.3s ease;
        background-color: #fff;
    }

    .custom-alert .alert-icon {
        font-size: 1.2rem;
        margin-right: 0.75rem;
    }

    .custom-alert .alert-content {
        flex-grow: 1;
        font-size: 0.95rem;
        font-weight: 500;
    }

    .custom-alert .close-btn {
        background: none;
        border: none;
        font-size: 1.5rem;
        cursor: pointer;
        padding: 0;
        line-height: 1;
        margin-left: 1rem;
        transition: transform 0.2s, opacity 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        color: inherit;
        font-weight: 300;
    }

    .custom-alert .close-btn:hover {
        background-color: rgba(0, 0, 0, 0.05);
        transform: scale(1.1);
    }

    /* Success Theme - Darker Green & Thinner */
    .custom-alert-success {
        border-left-color: #f35d85; /* Matching site primary Blush color */
        background-color: #fdf2f7;
        color: #83143b;
    }
    .custom-alert-success .alert-icon { color: #f35d85; }
    .custom-alert-success .close-btn { color: #f35d85; }

    /* Error Theme - Thinner */
    .custom-alert-danger {
        border-left-color: #991b1b;
        background-color: #fef2f2;
        color: #991b1b;
    }
    .custom-alert-danger .alert-icon { color: #dc2626; }
    .custom-alert-danger .close-btn { color: #991b1b; }

    /* Info Theme - Thinner */
    .custom-alert-info {
        border-left-color: #1e40af;
        background-color: #eff6ff;
        color: #1e40af;
    }
    .custom-alert-info .alert-icon { color: #2563eb; }
    .custom-alert-info .close-btn { color: #1e40af; }

    /* Animation */
    @keyframes slideInDown {
        from { transform: translateY(-10px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
    .fade-in-alert {
        animation: slideInDown 0.3s ease-out;
    }

    /* Support for BS4 close functionality */
    .custom-alert .close {
        display: none !important;
    }
</style>

@if (session('success'))
    <div class="alert custom-alert custom-alert-success fade show fade-in-alert d-flex align-items-center" role="alert">
        <div class="alert-icon">
            <i class="fa fa-check-circle"></i>
        </div>
        <div class="alert-content">
            {{ session('success') }}
        </div>
        <button type="button" class="close-btn" data-dismiss="alert" data-bs-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
            &times;
        </button>
    </div>
@endif

@if (session('error'))
    <div class="alert custom-alert custom-alert-danger fade show fade-in-alert d-flex align-items-center" role="alert">
        <div class="alert-icon">
            <i class="fa fa-exclamation-circle"></i>
        </div>
        <div class="alert-content">
            {{ session('error') }}
        </div>
        <button type="button" class="close-btn" data-dismiss="alert" data-bs-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
            &times;
        </button>
    </div>
@endif

@if (session('message'))
    <div class="alert custom-alert custom-alert-info fade show fade-in-alert d-flex align-items-center" role="alert">
        <div class="alert-icon">
            <i class="fa fa-info-circle"></i>
        </div>
        <div class="alert-content">
            {{ session('message') }}
        </div>
        <button type="button" class="close-btn" data-dismiss="alert" data-bs-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
            &times;
        </button>
    </div>
@endif

@if ($errors->any())
    <div class="alert custom-alert custom-alert-danger fade show fade-in-alert d-flex align-items-start" role="alert">
        <div class="alert-icon mt-1">
            <i class="fa fa-times-circle"></i>
        </div>
        <div class="alert-content">
            <ul class="mb-0 pl-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <button type="button" class="close-btn" data-dismiss="alert" data-bs-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
            &times;
        </button>
    </div>
@endif
