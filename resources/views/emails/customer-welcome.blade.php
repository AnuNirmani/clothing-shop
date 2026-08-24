<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>
<body style="font-family: Arial, sans-serif; color: #333333; line-height: 1.6;">
    <h2 style="color: #7C3AED;">Welcome to Lanka Open Soft!</h2>

    <p>Hi {{ $customer->name ?: 'Customer' }},</p>

    <p>Your account has been created successfully with this email address:</p>
    <p><strong>{{ $customer->email }}</strong></p>

    <p>Thanks for joining us. You can now explore and shop with your new account.</p>

    <p>Best regards,<br>Lanka Open Soft</p>
</body>
</html>
