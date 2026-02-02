<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inactivity Timeout Test</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="bg-light p-5">
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0"><i class="bi bi-bug"></i> Inactivity Timeout - Debug Test</h3>
                    </div>
                    <div class="card-body">
                        <h5>Instructions:</h5>
                        <ol>
                            <li>This page loads the inactivity timeout JavaScript</li>
                            <li>Open <strong>Developer Tools (F12)</strong></li>
                            <li>Go to <strong>Console Tab</strong></li>
                            <li>You should see initialization messages</li>
                            <li><strong>Do NOT move your mouse or type</strong> for 20 seconds</li>
                            <li>After 10 seconds of inactivity, the modal should appear</li>
                            <li>Check the console for debug messages</li>
                        </ol>

                        <hr>

                        <div class="alert alert-info">
                            <h6><i class="bi bi-info-circle"></i> Console Output:</h6>
                            <div id="console-output" style="background: #000; color: #0f0; padding: 15px; border-radius: 5px; font-family: monospace; font-size: 12px; max-height: 200px; overflow-y: auto;">
                                <p id="console-text">Waiting for console messages...</p>
                            </div>
                        </div>

                        <div class="alert alert-warning">
                            <strong><i class="bi bi-exclamation-triangle"></i> Important:</strong> 
                            <ul style="margin-bottom: 0;">
                                <li>If no modal appears after 10 seconds, check browser console (F12)</li>
                                <li>Make sure you don't interact with the page</li>
                                <li>Bootstrap JS must be loaded before the modal can show</li>
                            </ul>
                        </div>

                        <div class="mt-4">
                            <h6>Status:</h6>
                            <div id="status" class="badge bg-warning">Waiting...</div>
                            <div id="timer" class="mt-2" style="font-size: 24px; font-weight: bold; color: #ff6b6b;">⏱️ 0 seconds inactive</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Inactivity Timeout -->
    <script src="{{ url('js/inactivity-timeout.js') }}"></script>

    <script>
        // Capture console logs
        const originalLog = console.log;
        const consoleText = document.getElementById('console-text');
        
        console.log = function(...args) {
            originalLog.apply(console, args);
            const msg = args.join(' ');
            consoleText.innerHTML += '<div>' + msg + '</div>';
            document.getElementById('console-output').scrollTop = document.getElementById('console-output').scrollHeight;
        };

        // Inactivity timer display
        let inactiveSeconds = 0;
        setInterval(() => {
            inactiveSeconds++;
            if (inactiveSeconds <= 20) {
                document.getElementById('timer').textContent = '⏱️ ' + inactiveSeconds + ' seconds inactive';
                if (inactiveSeconds === 10) {
                    document.getElementById('status').className = 'badge bg-warning';
                    document.getElementById('status').textContent = 'Modal should appear now!';
                } else if (inactiveSeconds > 10 && inactiveSeconds <= 20) {
                    document.getElementById('status').className = 'badge bg-danger';
                    document.getElementById('status').textContent = 'Waiting for logout...';
                }
            }
        }, 1000);

        // Initial log
        console.log('✅ Inactivity Timeout Debug Test Loaded');
        console.log('⏱️ Total timeout: 20 seconds');
        console.log('⚠️ Modal appears after: 10 seconds');
        console.log('⏳ Countdown duration: 10 seconds');
        console.log('');
        console.log('🔍 Checking if manager initialized...');
        
        setTimeout(() => {
            if (window.inactivityManager) {
                console.log('✅ Manager initialized successfully!');
            } else {
                console.log('❌ Manager NOT initialized!');
            }
        }, 500);
    </script>
</body>
</html>
