<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Selamat Datang</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 0; background-color: #f4f4f4; }
        .container { max-width: 600px; margin: 0 auto; background-color: #ffffff; }
        .header { background: linear-gradient(135deg, #1a365d, #2d4a7a); padding: 40px 20px; text-align: center; }
        .header h1 { color: #fbbf24; margin: 0 0 8px; font-size: 26px; }
        .header p { color: #e2e8f0; margin: 0; font-size: 14px; }
        .body { padding: 30px 20px; color: #333; line-height: 1.8; }
        .body h2 { color: #1a365d; font-size: 20px; margin-top: 0; }
        .features { display: flex; flex-wrap: wrap; gap: 16px; margin: 24px 0; }
        .feature { flex: 1; min-width: 160px; background: #f8fafc; border-left: 4px solid #fbbf24; padding: 16px; border-radius: 4px; }
        .feature h4 { margin: 0 0 4px; color: #1a365d; font-size: 14px; }
        .feature p { margin: 0; color: #666; font-size: 13px; }
        .footer { background-color: #f8f8f8; padding: 24px 20px; text-align: center; font-size: 12px; color: #888; }
        .footer a { color: #1a365d; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Selamat Datang!</h1>
            <p>Terima kasih telah berlangganan newsletter {{ $schoolName }}</p>
        </div>
        <div class="body">
            <h2>Halo{{ $subscriberName ? ' ' . $subscriberName : '' }},</h2>
            <p>Kami senang Anda bergabung! Kini Anda akan mendapat informasi terbaru seputar:</p>

            <div class="features">
                <div class="feature">
                    <h4>Berita & Kegiatan</h4>
                    <p>Informasi terbaru seputar kegiatan sekolah</p>
                </div>
                <div class="feature">
                    <h4>Agenda Penting</h4>
                    <p>Jadwal ujian, libur, dan event sekolah</p>
                </div>
                <div class="feature">
                    <h4>PPDB</h4>
                    <p>Informasi pendaftaran peserta didik baru</p>
                </div>
                <div class="feature">
                    <h4>Prestasi</h4>
                    <p>Pencapaian siswa dan guru terbaru</p>
                </div>
            </div>

            <p style="margin-top: 20px;">Jika ada pertanyaan, jangan ragu menghubungi kami melalui email <strong>{{ $schoolEmail }}</strong> atau telepon <strong>{{ $schoolPhone }}</strong>.</p>

            <p style="margin-top: 24px; color: #666;">Salam hangat,<br><strong>{{ $schoolName }}</strong></p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ $schoolName }}. All rights reserved.</p>
            <p>Email ini dikirim karena Anda berlangganan newsletter {{ $schoolName }}.</p>
            <p><a href="{{ url('/hubungi-kami') }}">Hubungi Kami</a></p>
        </div>
    </div>
</body>
</html>
