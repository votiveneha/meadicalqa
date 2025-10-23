<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verify Your MediQA Account</title>
</head>
<body style="font-family: Arial, sans-serif; background-color:#f9fafb; padding:40px;">

    <div style="max-width:600px;margin:auto;background:white;border-radius:8px;padding:32px;box-shadow:0 2px 10px rgba(0,0,0,0.05);">
        <h2 style="color:#1D4ED8;text-align:center;">Welcome to MediQA!</h2>
        <p style="font-size:16px;color:#333;">
            Hi <strong>{{ $user->name ?? 'there' }}</strong>,
        </p>
        <p style="font-size:16px;color:#333;">
            Thanks for registering with MediQA. Please confirm your email address by clicking the button below.
        </p>

        <div style="text-align:center;margin:30px 0;">
            <a href="{{ $verifyUrl }}" style="background-color:#1D4ED8;color:white;padding:14px 28px;border-radius:6px;text-decoration:none;font-weight:bold;">
                Verify Email
            </a>
        </div>

        <p style="font-size:14px;color:#555;">
            If the button doesn’t work, copy and paste this link into your browser:
        </p>
        <p style="font-size:13px;color:#1D4ED8;word-break:break-all;">
            {{ $verifyUrl }}
        </p>

        <hr style="border:none;border-top:1px solid #eee;margin:30px 0;">
        <p style="font-size:12px;color:#999;text-align:center;">
            &copy; {{ date('Y') }} MediQA. All rights reserved.
        </p>
    </div>

</body>
</html>