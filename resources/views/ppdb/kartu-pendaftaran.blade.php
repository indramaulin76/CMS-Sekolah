<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kartu Pendaftaran PPDB</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
        }
        .card {
            width: 100%;
            max-width: 700px;
            margin: 0 auto;
            border: 3px solid #1e3a5f;
            border-radius: 10px;
            overflow: hidden;
        }
        .header {
            background: #1e3a5f;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .header h1 {
            font-size: 18px;
            margin-bottom: 5px;
        }
        .header p {
            font-size: 11px;
            opacity: 0.9;
        }
        .title-bar {
            background: #ffd700;
            color: #1e3a5f;
            padding: 8px;
            text-align: center;
            font-weight: bold;
            font-size: 14px;
        }
        .content {
            padding: 20px;
        }
        .reg-code {
            background: #f0f4f8;
            border: 2px dashed #1e3a5f;
            padding: 15px;
            text-align: center;
            margin-bottom: 20px;
            border-radius: 8px;
        }
        .reg-code .label {
            font-size: 10px;
            color: #666;
            margin-bottom: 5px;
        }
        .reg-code .code {
            font-size: 24px;
            font-weight: bold;
            color: #1e3a5f;
            letter-spacing: 3px;
        }
        .info-section {
            margin-bottom: 15px;
        }
        .info-section h3 {
            background: #e2e8f0;
            padding: 8px 10px;
            font-size: 11px;
            color: #1e3a5f;
            margin-bottom: 10px;
            border-left: 4px solid #1e3a5f;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table td {
            padding: 6px 10px;
            border-bottom: 1px solid #eee;
            vertical-align: top;
        }
        table td:first-child {
            width: 35%;
            font-weight: 600;
            color: #555;
        }
        .photo-box {
            width: 100px;
            height: 130px;
            border: 1px solid #ccc;
            display: flex;
            align-items: center;
            justify-content: center;
            float: right;
            margin-left: 20px;
            font-size: 9px;
            color: #999;
            text-align: center;
        }
        .footer {
            background: #f8f9fa;
            padding: 15px 20px;
            border-top: 2px solid #e2e8f0;
            font-size: 10px;
            display: flex;
            justify-content: space-between;
        }
        .footer .left {
            color: #666;
        }
        .footer .right {
            text-align: right;
        }
        .signature {
            margin-top: 20px;
            text-align: right;
            padding-right: 30px;
        }
        .signature .date {
            font-size: 10px;
            margin-bottom: 50px;
        }
        .signature .name {
            border-top: 1px solid #333;
            padding-top: 5px;
            display: inline-block;
            min-width: 150px;
        }
        .note {
            background: #fff3cd;
            border: 1px solid #ffc107;
            padding: 10px;
            margin-top: 15px;
            font-size: 10px;
            border-radius: 5px;
        }
        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="header">
            <h1>SMA TUNAS HARAPAN</h1>
            <p>Jl. Pendidikan No. 123, Jakarta Selatan | Telp: (021) 123-4567</p>
        </div>
        
        <div class="title-bar">
            KARTU BUKTI PENDAFTARAN PPDB {{ $registration->period->academic_year ?? date('Y') }}
        </div>
        
        <div class="content">
            <div class="reg-code">
                <div class="label">NOMOR PENDAFTARAN</div>
                <div class="code">{{ $registration->registration_code }}</div>
            </div>

            <div class="clearfix">
                <div class="photo-box">
                    Pas Foto<br>3x4
                </div>
                
                <div class="info-section">
                    <h3>DATA PRIBADI SISWA</h3>
                    <table>
                        <tr>
                            <td>Nama Lengkap</td>
                            <td><strong>{{ $registration->full_name }}</strong></td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>{{ $registration->gender }}</td>
                        </tr>
                        <tr>
                            <td>Tempat, Tgl Lahir</td>
                            <td>{{ $registration->birth_place }}, {{ $registration->birth_date?->format('d F Y') }}</td>
                        </tr>
                        <tr>
                            <td>Agama</td>
                            <td>{{ $registration->religion }}</td>
                        </tr>
                        <tr>
                            <td>NISN</td>
                            <td>{{ $registration->nisn }}</td>
                        </tr>
                        <tr>
                            <td>NIK</td>
                            <td>{{ $registration->nik }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="info-section">
                <h3>ASAL SEKOLAH & KONTAK</h3>
                <table>
                    <tr>
                        <td>Asal Sekolah</td>
                        <td>{{ $registration->school_origin }}</td>
                    </tr>
                    <tr>
                        <td>No. HP Siswa</td>
                        <td>{{ $registration->student_phone }}</td>
                    </tr>
                </table>
            </div>

            <div class="info-section">
                <h3>DATA ORANG TUA</h3>
                <table>
                    <tr>
                        <td>Nama Orang Tua</td>
                        <td>{{ $registration->parent_name }}</td>
                    </tr>
                    <tr>
                        <td>No. HP Orang Tua</td>
                        <td>{{ $registration->parent_phone }}</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>{{ $registration->parent_address }}</td>
                    </tr>
                </table>
            </div>

            <div class="note">
                <strong>⚠️ PENTING:</strong> Simpan kartu ini dengan baik. Bawa kartu ini saat verifikasi berkas ke sekolah beserta dokumen persyaratan (FC KK, FC Akta Kelahiran, FC Ijazah/SKL).
            </div>

            <div class="signature">
                <div class="date">Jakarta, {{ now()->format('d F Y') }}</div>
                <div class="name">Panitia PPDB</div>
            </div>
        </div>

        <div class="footer">
            <div class="left">
                Dicetak pada: {{ now()->format('d/m/Y H:i') }} WIB
            </div>
            <div class="right">
                Status: <strong style="color: #f59e0b;">{{ $registration->status?->getLabel() ?? 'Pending' }}</strong>
            </div>
        </div>
    </div>
</body>
</html>
