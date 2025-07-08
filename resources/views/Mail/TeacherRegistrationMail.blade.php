<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Online Portal</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #800000;
            padding: 20px;
            text-align: center;
            color: #ffffff;
        }
        .header h1 {
            margin: 0;
            font-size: 26px;
        }
        .content {
            padding: 30px;
            color: #333333;
            line-height: 1.6;
            font-size: 16px;
        }
        .content p {
            margin: 15px 0;
        }
        .credentials {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 6px;
            margin: 20px 0;
            font-size: 15px;
        }
        .credentials strong {
            color: #800000;
        }
        .footer {
            text-align: center;
            padding: 15px;
            font-size: 13px;
            color: #777777;
            background-color: #f8f8f8;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>Registration Successful!</h1>
        </div>
        <div class="content">
            <p>Dear <strong>{{ $details['user_name'] }}</strong>,</p>

            <p>Congratulations! You have successfully registered as a <strong>Professor</strong> on our Online Portal.</p>

            <p>You can now log in using the following credentials:</p>

            <div class="credentials">
                <p><strong>Email:</strong> {{ $details['email'] }}</p>
                <p><strong>Password:</strong> {{ $details['password'] }}</p>
            </div>

            <p>For your security, we recommend you change your password after your first login.</p>

            <p>If you face any issues, feel free to contact our support team anytime.</p>

            <p>Welcome aboard!</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Online Portal. All rights reserved.
        </div>
    </div>
</body>
</html>
