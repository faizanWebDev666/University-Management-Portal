<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Portal Registration Confirmation</title>
    <style>
        /* Base Styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
            color: #333;
            line-height: 1.5;
        }
        
        /* Email Container */
        .email-container {
            max-width: 680px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border: 1px solid #eaeaea;
        }
        
        /* University Header */
        .university-header {
            background: linear-gradient(135deg, #800000 0%, #a00000 100%);
            padding: 28px 40px;
            text-align: center;
            color: #ffffff;
            border-bottom: 4px solid #f0ad4e;
        }
        
        .university-header h1 {
            margin: 0 0 8px 0;
            font-size: 28px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        
        .university-header p {
            margin: 0;
            font-size: 16px;
            opacity: 0.9;
            font-weight: 300;
        }
        
        /* Content Area */
        .content {
            padding: 40px;
            color: #444;
        }
        
        .greeting {
            font-size: 18px;
            margin-bottom: 25px;
            color: #555;
        }
        
        .greeting strong {
            color: #800000;
            font-weight: 600;
        }
        
        /* Message Sections */
        .message-section {
            margin-bottom: 30px;
            padding-bottom: 25px;
            border-bottom: 1px solid #eee;
        }
        
        .message-section:last-of-type {
            border-bottom: none;
        }
        
        .message-section h2 {
            color: #800000;
            font-size: 20px;
            margin-top: 0;
            margin-bottom: 15px;
            font-weight: 600;
        }
        
        .message-section p {
            margin: 12px 0;
            font-size: 16px;
        }
        
        /* Credentials Box */
        .credentials-container {
            background-color: #f9f9f9;
            border-left: 4px solid #800000;
            padding: 22px;
            border-radius: 8px;
            margin: 25px 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.03);
        }
        
        .credentials-title {
            color: #800000;
            font-size: 17px;
            margin-top: 0;
            margin-bottom: 18px;
            font-weight: 600;
        }
        
        .credential-item {
            display: flex;
            margin-bottom: 12px;
            align-items: center;
        }
        
        .credential-label {
            font-weight: 600;
            color: #555;
            min-width: 100px;
            font-size: 15px;
        }
        
        .credential-value {
            font-family: 'Courier New', monospace;
            background-color: #fff;
            padding: 8px 12px;
            border-radius: 4px;
            border: 1px solid #ddd;
            flex-grow: 1;
            font-size: 15px;
            color: #222;
        }
        
        /* Security Notice */
        .security-notice {
            background-color: #fff8e1;
            border-radius: 8px;
            padding: 18px;
            margin: 25px 0;
            border-left: 4px solid #f0ad4e;
        }
        
        .security-notice h3 {
            color: #d9534f;
            margin-top: 0;
            font-size: 16px;
            display: flex;
            align-items: center;
        }
        
        .security-notice h3:before {
            content: "⚠";
            margin-right: 8px;
            font-size: 18px;
        }
        
        /* Call to Action */
        .cta-section {
            text-align: center;
            margin: 35px 0;
        }
        
        .cta-button {
            display: inline-block;
            background: linear-gradient(to right, #800000, #a00000);
            color: white;
            padding: 14px 32px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            font-size: 16px;
            box-shadow: 0 4px 12px rgba(128, 0, 0, 0.2);
            transition: all 0.3s ease;
        }
        
        .cta-button:hover {
            background: linear-gradient(to right, #700000, #900000);
            box-shadow: 0 6px 16px rgba(128, 0, 0, 0.25);
            transform: translateY(-2px);
        }
        
        /* Support Section */
        .support-section {
            background-color: #f0f8ff;
            padding: 20px;
            border-radius: 8px;
            margin-top: 30px;
            text-align: center;
        }
        
        .support-section p {
            margin: 8px 0;
        }
        
        /* Footer */
        .footer {
            background-color: #2c3e50;
            color: #ecf0f1;
            padding: 25px 40px;
            text-align: center;
            font-size: 14px;
        }
        
        .footer p {
            margin: 8px 0;
            opacity: 0.85;
        }
        
        .footer a {
            color: #f0ad4e;
            text-decoration: none;
        }
        
        .footer a:hover {
            text-decoration: underline;
        }
        
        .copyright {
            font-size: 13px;
            opacity: 0.7;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        /* Responsive Design */
        @media (max-width: 600px) {
            body {
                padding: 10px;
            }
            
            .email-container {
                border-radius: 8px;
            }
            
            .university-header, .content, .footer {
                padding: 20px;
            }
            
            .university-header h1 {
                font-size: 24px;
            }
            
            .credential-item {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .credential-label {
                margin-bottom: 5px;
            }
            
            .cta-button {
                display: block;
                margin: 0 auto;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- University Header -->
        <div class="university-header">
            <h1>Faculty Portal Registration</h1>
            <p>Office of Academic Affairs</p>
        </div>
        
        <!-- Main Content -->
        <div class="content">
            <!-- Greeting -->
            <div class="greeting">
                Dear <strong>Professor {{ $details['user_name'] }}</strong>,
            </div>
            
            <!-- Registration Confirmation -->
            <div class="message-section">
                <h2>Registration Confirmed</h2>
                <p>We are pleased to inform you that your registration as a <strong>Professor</strong> on the University Faculty Portal has been successfully processed.</p>
                <p>Your account has been created with full access to academic resources, course management tools, and institutional systems.</p>
            </div>
            
            <!-- Login Credentials -->
            <div class="credentials-container">
                <h3 class="credentials-title">Portal Access Credentials</h3>
                <div class="credential-item">
                    <span class="credential-label">Email:</span>
                    <span class="credential-value">{{ $details['email'] }}</span>
                </div>
                <div class="credential-item">
                    <span class="credential-label">Password:</span>
                    <span class="credential-value">{{ $details['password'] }}</span>
                </div>
            </div>
            
            <!-- Security Notice -->
            <div class="security-notice">
                <h3>Security Advisory</h3>
                <p>For security purposes, we strongly recommend that you change your temporary password immediately after your first login to the portal.</p>
            </div>
            
            <!-- Call to Action -->
            <div class="cta-section">
                <a href="https://portal.university.edu/login" class="cta-button">Access Faculty Portal</a>
            </div>
            
            <!-- Next Steps -->
            <div class="message-section">
                <h2>Getting Started</h2>
                <p>Upon first login, you will be guided through the portal orientation and prompted to complete your faculty profile. The portal provides access to:</p>
                <ul style="margin-left: 20px; color: #555;">
                    <li>Course management and assignment tools</li>
                    <li>Academic calendar and scheduling system</li>
                    <li>Research collaboration platforms</li>
                    <li>University resource library</li>
                    <li>Faculty communication channels</li>
                </ul>
            </div>
            
            <!-- Support Information -->
            <div class="support-section">
                <p><strong>Need assistance?</strong> Our Faculty Support Team is available to help you.</p>
                <p>Email: <a href="mailto:faculty.support@university.edu">faculty.support@university.edu</a> | Phone: (555) 123-4567</p>
                <p>Support Hours: Monday-Friday, 8:00 AM - 6:00 PM</p>
            </div>
            
            <!-- Closing -->
            <p style="margin-top: 30px; font-style: italic; color: #666;">
                We are delighted to welcome you to our academic community and look forward to your contributions.
            </p>
        </div>
        
        <!-- Footer -->
        <div class="footer">
            <p><strong>University Faculty Portal</strong></p>
            <p>Office of Information Technology | Office of Academic Affairs</p>
            <p>123 University Boulevard, Academic City, State 12345</p>
            <div class="copyright">
                &copy; {{ date('Y') }} University Name. All rights reserved.<br>
                This email was sent to {{ $details['email'] }}
            </div>
        </div>
    </div>
</body>
</html>