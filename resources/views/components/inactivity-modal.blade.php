<div id="inactivityModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="inactivityModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 rounded-3 shadow-xl inactivity-modal-compact">
            <!-- Compact Header -->
            <div class="modal-header border-0 pb-2 pt-4 px-4" style="background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%);">
                <h6 class="modal-title fw-bold text-white mb-0" id="inactivityModalLabel">
                    <i class="bi bi-exclamation-circle-fill me-2"></i>Session Expiring
                </h6>
            </div>

            <!-- Compact Body -->
            <div class="modal-body text-center py-4 px-4">
                <!-- Large Countdown Circle -->
                <div class="countdown-circle mb-3" style="width: 100px; height: 100px; margin: 0 auto; border-radius: 50%; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%); box-shadow: 0 0 20px rgba(255, 107, 107, 0.3);">
                    <span id="countdownTimer" style="font-size: 2.5rem; font-weight: bold; color: white; line-height: 1;">10</span>
                </div>

                <!-- Message -->
                <p class="text-dark fw-bold mb-2" style="font-size: 0.95rem;">Your session expires in <span class="text-danger" id="countdownDisplay">10</span>s</p>
                <p class="text-muted mb-3" style="font-size: 0.85rem;">Move your mouse or press a key to stay active</p>
            </div>

            <!-- Compact Footer -->
            <div class="modal-footer border-0 bg-white pt-0 px-4 pb-4 gap-2">
                <button type="button" class="btn btn-sm btn-outline-danger rounded-2" id="logoutButton">
                    <i class="bi bi-box-arrow-right me-1"></i>Logout
                </button>
                <button type="button" class="btn btn-sm btn-danger fw-bold rounded-2" id="stayActiveButton">
                    <i class="bi bi-check-circle me-1"></i>Stay Active
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    /* Compact Modal Styling */
    .inactivity-modal-compact {
        max-width: 300px !important;
        width: 100% !important;
    }

    .inactivity-modal-compact .modal-header {
        background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%) !important;
        border-radius: 12px 12px 0 0;
    }

    .inactivity-modal-compact .modal-content {
        animation: slideDownCompact 0.3s ease-out;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
    }

    @keyframes slideDownCompact {
        from {
            opacity: 0;
            transform: translateY(-20px) scale(0.95);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    /* Countdown Timer Animation */
    #countdownTimer {
        animation: countdownPulse 1s infinite;
    }

    @keyframes countdownPulse {
        0% {
            transform: scale(1);
            opacity: 1;
        }
        50% {
            transform: scale(1.05);
            opacity: 1;
        }
        100% {
            transform: scale(1);
            opacity: 1;
        }
    }

    /* Professional Button Styling */
    .inactivity-modal-compact .btn-sm {
        padding: 0.5rem 1rem;
        font-size: 0.85rem;
        border-radius: 20px;
        transition: all 0.2s ease;
    }

    .inactivity-modal-compact .btn-danger {
        background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%);
        border: none;
        color: white;
    }

    .inactivity-modal-compact .btn-danger:hover {
        background: linear-gradient(135deg, #ff5555 0%, #dd4a5e 100%);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 107, 107, 0.4);
    }

    .inactivity-modal-compact .btn-outline-danger {
        border: 1.5px solid #ff6b6b;
        color: #ff6b6b;
    }

    .inactivity-modal-compact .btn-outline-danger:hover {
        background-color: #fff5f5;
        border-color: #ff5555;
        transform: translateY(-2px);
    }

    /* Modal Backdrop */
    .modal.fade.show .inactivity-modal-compact {
        animation: slideDownCompact 0.3s ease-out forwards;
    }

    /* Responsive */
    @media (max-width: 480px) {
        .inactivity-modal-compact {
            max-width: 280px !important;
        }

        #countdownTimer {
            font-size: 2rem !important;
        }

        .inactivity-modal-compact .modal-body {
            padding: 1rem !important;
        }
    }
</style>
