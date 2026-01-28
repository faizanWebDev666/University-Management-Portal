<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login Notification</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;">
    <table role="presentation" style="max-width: 600px; margin: 20px auto; background: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        <tr>
            <td style="background-color: #800000; padding: 15px 20px; text-align: center; color: #ffffff;">
                <h1 style="margin: 0; font-size: 20px;">Login Successful</h1>
            </td>
        </tr>
        <tr>
            <td style="padding: 20px; color: #333333;">
                <h2 style="margin-top: 0;">Hello {{ $details['name'] }},</h2>
                <p style="font-size: 15px; line-height: 1.5;">
                    We noticed a successful login to your account on <strong>{{ $details['time'] }}</strong>.
                </p>
                <p style="font-size: 15px; line-height: 1.5;">
                    If this was you, no further action is needed. However, if you did not log in, we strongly recommend you reset your password immediately to secure your account.
                </p>
                <p style="text-align: center; margin: 25px 0;">
                    <a href="{{ url('/reset-password') }}" style="background-color: #800000; color: #ffffff; text-decoration: none; padding: 12px 25px; border-radius: 4px; font-weight: bold;">
                        Reset Password
                    </a>
                </p>
                <p style="font-size: 13px; color: #888888;">
                    This is an automated email from ResellZone. Please do not reply directly to this message.
                </p>
            </td>
        </tr>
        <tr>
            <td style="background-color: #f1f1f1; padding: 10px 20px; text-align: center; font-size: 12px; color: #666666;">
                &copy; {{ date('Y') }} ResellZone. All rights reserved.
            </td>
        </tr>
    </table>
</body>
</html>
