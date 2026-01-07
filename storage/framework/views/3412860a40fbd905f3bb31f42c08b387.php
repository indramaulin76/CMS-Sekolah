<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pendaftaran PPDB</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #1e3a5f 0%, #2c5282 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 0 0 10px 10px;
        }
        .code-box {
            background: #1e3a5f;
            color: #ffd700;
            padding: 20px;
            text-align: center;
            border-radius: 8px;
            margin: 20px 0;
        }
        .code-box .label {
            font-size: 12px;
            color: #ccc;
            margin-bottom: 5px;
        }
        .code-box .code {
            font-size: 28px;
            font-weight: bold;
            letter-spacing: 2px;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .info-table td {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }
        .info-table td:first-child {
            font-weight: 600;
            color: #666;
            width: 40%;
        }
        .alert {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .footer {
            text-align: center;
            padding: 20px;
            color: #666;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🎓 SMA Tunas Harapan</h1>
        <p style="margin: 10px 0 0 0; opacity: 0.9;">Konfirmasi Pendaftaran PPDB</p>
    </div>

    <div class="content">
        <p>Yth. <strong><?php echo e($registration->parent_name); ?></strong>,</p>
        
        <p>Terima kasih telah mendaftarkan putra/putri Anda di SMA Tunas Harapan. Pendaftaran telah berhasil diterima dengan data sebagai berikut:</p>

        <div class="code-box">
            <div class="label">NOMOR PENDAFTARAN</div>
            <div class="code"><?php echo e($registration->registration_code); ?></div>
        </div>

        <table class="info-table">
            <tr>
                <td>Nama Lengkap</td>
                <td><strong><?php echo e($registration->full_name); ?></strong></td>
            </tr>
            <tr>
                <td>NISN</td>
                <td><?php echo e($registration->nisn); ?></td>
            </tr>
            <tr>
                <td>Asal Sekolah</td>
                <td><?php echo e($registration->school_origin); ?></td>
            </tr>
            <tr>
                <td>Periode</td>
                <td><?php echo e($registration->period->name ?? '-'); ?></td>
            </tr>
            <tr>
                <td>Status</td>
                <td><span style="color: #f59e0b; font-weight: bold;">⏳ Menunggu Verifikasi</span></td>
            </tr>
        </table>

        <div class="alert">
            <strong>📋 Langkah Selanjutnya:</strong>
            <ol style="margin: 10px 0 0 0; padding-left: 20px;">
                <li>Simpan nomor pendaftaran di atas dengan baik</li>
                <li>Siapkan berkas persyaratan (FC KK, FC Akta, FC Ijazah/SKL)</li>
                <li>Datang ke sekolah untuk verifikasi berkas</li>
                <li>Pantau status pendaftaran secara berkala</li>
            </ol>
        </div>

        <p>Jika ada pertanyaan, silakan hubungi kami melalui nomor telepon/WhatsApp sekolah.</p>

        <p>Salam hangat,<br><strong>Panitia PPDB SMA Tunas Harapan</strong></p>
    </div>

    <div class="footer">
        <p>Email ini dikirim otomatis oleh sistem. Mohon tidak membalas email ini.</p>
        <p>© <?php echo e(date('Y')); ?> SMA Tunas Harapan. All rights reserved.</p>
    </div>
</body>
</html>
<?php /**PATH /var/www/html/resources/views/emails/ppdb-confirmation.blade.php ENDPATH**/ ?>