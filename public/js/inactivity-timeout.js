/**
 * Session Inactivity Timeout Handler
 * Tracks user inactivity and shows a warning modal with countdown before logout
 */

class InactivityTimeoutManager {
    constructor(options = {}) {
        // Configuration
        this.inactivityMinutes = options.inactivityMinutes || 1; // 1 minute for inactivity
        this.warningSeconds = options.warningSeconds || 20; // Show warning 10 seconds before logout
        this.inactivityMilliseconds = this.inactivityMinutes * 60 * 1000; // Convert to milliseconds
        this.warningMilliseconds = this.warningSeconds * 1000; // Convert to milliseconds
        
        // State management
        this.warningShown = false;
        this.countdownStarted = false;
        this.timeoutId = null;
        this.countdownId = null;
        this.remainingSeconds = this.warningSeconds;
        
        // Events to track activity
        this.events = ['mousedown', 'keydown', 'scroll', 'touchstart', 'click'];
        
        // Initialize
        this.init();
    }

    /**
     * Initialize the inactivity timeout manager
     */
    init() {
        console.log('[Inactivity Manager] Initialized with ' + this.inactivityMinutes + ' minute(s) timeout');
        this.startInactivityTimer();
        this.attachEventListeners();
        this.setupModalButtons();
    }

    /**
     * Start the inactivity timer
     */
    startInactivityTimer() {
        // Clear any existing timeout
        if (this.timeoutId) {
            clearTimeout(this.timeoutId);
        }

        // Set timeout for showing warning modal
        this.timeoutId = setTimeout(() => {
            console.log('[Inactivity Manager] Showing warning modal');
            this.showWarningModal();
            this.startCountdown();
        }, this.inactivityMilliseconds - this.warningMilliseconds);
    }

    /**
     * Attach event listeners for user activity
     */
    attachEventListeners() {
        this.events.forEach(event => {
            document.addEventListener(event, () => this.resetInactivityTimer(), true);
        });
    }

    /**
     * Reset the inactivity timer when user is active
     */
    resetInactivityTimer() {
        // Don't reset if warning modal is shown
        if (this.warningShown) {
            return;
        }

        console.log('[Inactivity Manager] Activity detected, resetting timer');
        
        // Clear the timeout
        if (this.timeoutId) {
            clearTimeout(this.timeoutId);
        }

        // Restart the timer
        this.startInactivityTimer();
    }

    /**
     * Show the warning modal
     */
    showWarningModal() {
        this.warningShown = true;
        const modal = document.getElementById('inactivityModal');
        
        if (modal) {
            // Create Bootstrap modal instance
            const bootstrapModal = new bootstrap.Modal(modal, {
                backdrop: 'static', // Prevent closing by clicking backdrop
                keyboard: false     // Prevent closing by ESC key
            });
            bootstrapModal.show();
        } else {
            console.error('[Inactivity Manager] Modal element not found');
        }
    }

    /**
     * Hide the warning modal
     */
    hideWarningModal() {
        const modal = document.getElementById('inactivityModal');
        
        if (modal) {
            const bootstrapModal = bootstrap.Modal.getInstance(modal);
            if (bootstrapModal) {
                bootstrapModal.hide();
            }
        }

        this.warningShown = false;
        this.countdownStarted = false;
        this.remainingSeconds = this.warningSeconds;
        
        // Update display
        document.getElementById('countdownDisplay').textContent = this.warningSeconds;
        document.getElementById('countdownTimer').textContent = this.warningSeconds;
    }

    /**
     * Start the countdown timer
     */
    startCountdown() {
        this.countdownStarted = true;
        this.remainingSeconds = this.warningSeconds;

        // Update display immediately
        this.updateCountdownDisplay();

        // Start countdown
        this.countdownId = setInterval(() => {
            this.remainingSeconds--;
            this.updateCountdownDisplay();

            if (this.remainingSeconds <= 0) {
                clearInterval(this.countdownId);
                this.logoutDueToInactivity();
            }
        }, 1000);
    }

    /**
     * Update countdown display
     */
    updateCountdownDisplay() {
        const countdownDisplay = document.getElementById('countdownDisplay');
        const countdownTimer = document.getElementById('countdownTimer');
        
        if (countdownDisplay) {
            countdownDisplay.textContent = this.remainingSeconds;
        }
        if (countdownTimer) {
            countdownTimer.textContent = this.remainingSeconds;
        }

        console.log('[Inactivity Manager] Countdown: ' + this.remainingSeconds + ' seconds remaining');
    }

    /**
     * Setup modal button event listeners
     */
    setupModalButtons() {
        const stayActiveButton = document.getElementById('stayActiveButton');
        const logoutButton = document.getElementById('logoutButton');

        if (stayActiveButton) {
            stayActiveButton.addEventListener('click', () => {
                console.log('[Inactivity Manager] User clicked "Stay Active"');
                this.handleStayActive();
            });
        }

        if (logoutButton) {
            logoutButton.addEventListener('click', () => {
                console.log('[Inactivity Manager] User clicked "Logout"');
                this.logoutDueToInactivity();
            });
        }
    }

    /**
     * Handle stay active button click
     */
    handleStayActive() {
        // Stop the countdown
        if (this.countdownId) {
            clearInterval(this.countdownId);
        }

        // Hide the modal
        this.hideWarningModal();

        // Reset the inactivity timer
        this.startInactivityTimer();

        console.log('[Inactivity Manager] User stayed active, timer reset');
    }

    /**
     * Logout due to inactivity
     */
    logoutDueToInactivity() {
        console.log('[Inactivity Manager] Logging out due to inactivity');

        // Stop the countdown
        if (this.countdownId) {
            clearInterval(this.countdownId);
        }

        // Redirect to logout
        window.location.href = '/logout';
    }

    /**
     * Destroy the manager
     */
    destroy() {
        // Remove event listeners
        this.events.forEach(event => {
            document.removeEventListener(event, () => this.resetInactivityTimer(), true);
        });

        // Clear timeouts
        if (this.timeoutId) {
            clearTimeout(this.timeoutId);
        }

        if (this.countdownId) {
            clearInterval(this.countdownId);
        }

        console.log('[Inactivity Manager] Destroyed');
    }
}

// Initialize on document ready
document.addEventListener('DOMContentLoaded', function() {
    // Create and start the inactivity timeout manager
    // Total timeout: 20 seconds
    // - 10 seconds: inactivity detection
    // - 10 seconds: warning countdown
    window.inactivityManager = new InactivityTimeoutManager({
        inactivityMinutes: 1,   // 20 seconds total (10 sec inactivity + 10 sec warning)
        warningSeconds: 20          // Show warning countdown for 10 seconds
    });
});
