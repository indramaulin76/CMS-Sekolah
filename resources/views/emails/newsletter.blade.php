<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $subjectLine }}</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 0; background-color: #f4f4f4; }
        .container { max-width: 600px; margin: 0 auto; background-color: #ffffff; }
        .header { background-color: #1a365d; padding: 30px 20px; text-align: center; }
        .header h1 { color: #fbbf24; margin: 0; font-size: 24px; }
        .body { padding: 30px 20px; color: #333; line-height: 1.6; }
        .footer { background-color: #f8f8f8; padding: 20px; text-align: center; font-size: 12px; color: #888; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ $subjectLine }}</h1>
        </div>
        <div class="body">
            {!! nl2br(e($bodyContent)) !!}
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} SMA Tunas Harapan. All rights reserved.</p>
            <p>Email ini dikirim karena Anda berlangganan newsletter SMA Tunas Harapan.</p>
        </div>
    </div>
</body>
</html>
