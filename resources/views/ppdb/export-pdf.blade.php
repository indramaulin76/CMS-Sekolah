<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pendaftar PPDB - {{ now()->format('d F Y') }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 11px;
            line-height: 1.4;
            color: #333;
        }
        .container {
            max-width: 100%;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #1e3a5f;
            padding-bottom: 15px;
        }
        .header h1 {
            font-size: 18px;
            color: #1e3a5f;
            margin-bottom: 5px;
        }
        .header p {
            color: #666;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 6px 8px;
            text-align: left;
            vertical-align: top;
        }
        th {
            background-color: #1e3a5f;
            color: white;
            font-weight: 600;
            font-size: 10px;
            text-transform: uppercase;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f0f7ff;
        }
        .badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 9px;
            font-weight: 600;
        }
        .badge-success {
            background-color: #d4edda;
            color: #155724;
        }
        .badge-warning {
            background-color: #fff3cd;
            color: #856404;
        }
        .badge-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
        .badge-info {
            background-color: #d1ecf1;
            color: #0c5460;
        }
        .footer {
            margin-top: 20px;
            text-align: right;
            font-size: 10px;
            color: #666;
        }
        @media print {
            body {
                font-size: 9px;
            }
            .no-print {
                display: none;
            }
            th, td {
                padding: 4px 6px;
            }
        }
        .print-btn {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #1e3a5f;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
        .print-btn:hover {
            background: #2c5282;
        }
    </style>
</head>
<body>
    <button class="print-btn no-print" onclick="window.print()">
        🖨️ Cetak / Simpan PDF
    </button>

    <div class="container">
        <div class="header">
            <h1>DATA PENDAFTAR PPDB</h1>
            <p>SMA Tunas Harapan | Dicetak: {{ now()->format('d F Y, H:i') }} WIB</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama Lengkap</th>
                    <th>L/P</th>
                    <th>TTL</th>
                    <th>Agama</th>
                    <th>NISN</th>
                    <th>Asal Sekolah</th>
                    <th>HP Siswa</th>
                    <th>Nama Ortu</th>
                    <th>HP Ortu</th>
                    <th>Status</th>
                    <th>Berkas</th>
                </tr>
            </thead>
            <tbody>
                @forelse($registrations as $index => $reg)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $reg->registration_code }}</td>
                    <td>{{ $reg->full_name }}</td>
                    <td>{{ $reg->gender == 'Laki-laki' ? 'L' : 'P' }}</td>
                    <td>{{ $reg->birth_place }}, {{ $reg->birth_date?->format('d/m/Y') }}</td>
                    <td>{{ $reg->religion }}</td>
                    <td>{{ $reg->nisn }}</td>
                    <td>{{ $reg->school_origin }}</td>
                    <td>{{ $reg->student_phone }}</td>
                    <td>{{ $reg->parent_name }}</td>
                    <td>{{ $reg->parent_phone }}</td>
                    <td>
                        @php
                            $statusClass = match($reg->status?->value ?? $reg->status) {
                                'pending' => 'badge-warning',
                                'verified' => 'badge-info',
                                'accepted' => 'badge-success',
                                'rejected' => 'badge-danger',
                                default => 'badge-warning',
                            };
                        @endphp
                        <span class="badge {{ $statusClass }}">
                            {{ $reg->status?->getLabel() ?? ucfirst($reg->status) }}
                        </span>
                    </td>
                    <td>{{ $reg->files_submitted ? '✓' : '✗' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="13" style="text-align: center; padding: 20px;">Belum ada data pendaftar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="footer">
            <p>Total: {{ $registrations->count() }} pendaftar</p>
        </div>
    </div>
</body>
</html>
