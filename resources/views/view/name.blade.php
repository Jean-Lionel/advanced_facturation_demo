<!-- resources/views/emails/welcome.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Email</title>
</head>
<body>
    <h1>Welcome to our Application!</h1>

    <p>Dear {{ $user->name }},</p>

    <p>Welcome to our application. We are excited to have you on board!</p>

    <p>Thank you,</p>
    <p>Your Application Team</p>
</body>
</html>
