<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Email Inquiry</title>
</head>

<body>
    <div style="font-family: 'Segoe UI'; width: 100%; background: #FAFAFA; padding-top: 50px; padding-bottom: 50px;">
        <div style="width: 100%; margin: 0 auto; ">
            <div style="width: 100%; margin-top: 15px; margin-bottom: 15px;">
                <img src="https://portfolio.codebyeo.com/images/logo.png" alt="logo"
                    style="width: 75px; height: 75px; display: block; margin: 0 auto;">
            </div>
            <div style="background: #FFFFFF; max-width: 506px; padding: 32px; margin: 0 auto;">
                <h1 style="font-weight: bold; font-size: 18px; color: #18181B; margin-bottom: 20px;">Hi {{ $userName }},</h1>

                <p style="font-weight: 400; color: #52525B; margin-bottom: 20px;"> 
                    Thank you for reaching out through my portfolio website. I've received your message and appreciate you taking the time to contact me.
                </p>

                <p style="font-weight: 400; color: #52525B; margin-bottom: 20px;"> 
                    I'll review your inquiry and get back to you as soon as possible.
                </p>
                
                <div style="margin-bottom: 20px;">
                    <p style="margin-bottom: 0px; font-weight: 400; color: #52525B">Regards,</p>
                    <p style="margin-top: 0px; font-weight: 400; color: #52525B">{{ config('mail.from.name') }}</p>
                </div>

                <hr style="border-top: 1px solid #A1A1AA; width: 100%;">

                <p style="text-align: center; font-size: 12px; color: #A1A1AA;">
                    Copyright © 2026 {{ config('app.name') }} by {{ config('app.owner') }}. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</body>

</html>