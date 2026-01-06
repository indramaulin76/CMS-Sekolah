<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kartu Pendaftaran PPDB</title>
    <style>
        @page {
            size: A4;
            margin: 0;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            -webkit-print-color-adjust: exact;
        }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 11px;
            line-height: 1.3;
            color: #333;
            background: #eee;
            padding: 20px;
        }
        .card {
            width: 100%;
            max-width: 210mm; /* A4 Width */
            margin: 0 auto;
            background: white;
            border: 2px solid #1e3a5f;
            border-radius: 0;
            overflow: hidden;
            position: relative;
            min-height: 290mm; /* A4 Height approx */
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        @media print {
            body {
                padding: 0;
                background: white;
            }
            .card {
                border: none;
                box-shadow: none;
                min-height: auto;
                max-width: 100%;
            }
        }
        .header {
            background: #1e3a5f;
            color: white;
            padding: 15px;
            text-align: center;
        }
        .header h1 {
            font-size: 16px;
            margin-bottom: 2px;
        }
        .header p {
            font-size: 10px;
            opacity: 0.9;
        }
        .title-bar {
            background: #ffd700;
            color: #1e3a5f;
            padding: 6px;
            text-align: center;
            font-weight: bold;
            font-size: 12px;
            border-bottom: 1px solid #1e3a5f;
        }
        .content {
            padding: 15px 25px;
        }
        .reg-code {
            background: #f0f4f8;
            border: 2px dashed #1e3a5f;
            padding: 10px;
            text-align: center;
            margin-bottom: 15px;
            border-radius: 6px;
        }
        .reg-code .label {
            font-size: 9px;
            color: #666;
            margin-bottom: 2px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .reg-code .code {
            font-size: 20px;
            font-weight: bold;
            color: #1e3a5f;
            letter-spacing: 3px;
        }
        .info-section {
            margin-bottom: 10px;
        }
        .info-section h3 {
            background: #e2e8f0;
            padding: 5px 8px;
            font-size: 10px;
            color: #1e3a5f;
            margin-bottom: 5px;
            border-left: 4px solid #1e3a5f;
            text-transform: uppercase;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
        }
        table td {
            padding: 4px 8px;
            border-bottom: 1px solid #eee;
            vertical-align: top;
        }
        table td:first-child {
            width: 30%;
            font-weight: 600;
            color: #555;
        }
        .photo-box {
            width: 3cm;
            height: 4cm;
            border: 1px dashed #ccc;
            background: #fafafa;
            display: flex;
            align-items: center;
            justify-content: center;
            float: right;
            margin-left: 15px;
            font-size: 9px;
            color: #aaa;
            text-align: center;
        }
        .footer {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: #f8f9fa;
            padding: 10px 20px;
            border-top: 1px solid #e2e8f0;
            font-size: 9px;
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
            padding-right: 20px;
            margin-bottom: 40px;
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
            font-weight: bold;
            font-size: 10px;
        }
        .note {
            background: #fff3cd;
            border: 1px solid #ffc107;
            padding: 8px;
            margin-top: 15px;
            font-size: 9px;
            border-radius: 4px;
            color: #856404;
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
                        <td>{{ $registration->previous_school }}</td>
                    </tr>
                    <tr>
                        <td>No. HP Siswa</td>
                        <td>{{ $registration->phone }}</td>
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
    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>
