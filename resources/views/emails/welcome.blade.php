<!DOCTYPE html>
<html lang="id" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Selamat Datang di Newsletter {{ $schoolName }}</title>
    <!--[if mso]>
    <noscript>
        <xml>
            <o:OfficeDocumentSettings>
                <o:PixelsPerInch>96</o:PixelsPerInch>
            </o:OfficeDocumentSettings>
        </xml>
    </noscript>
    <![endif]-->
    <style type="text/css">
        /* Reset */
        body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
        table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
        img { -ms-interpolation-mode: bicubic; border: 0; outline: none; text-decoration: none; }
        body { margin: 0 !important; padding: 0 !important; background-color: #f0f4f8; }

        /* Feature card columns */
        .feature-col {
            width: 50%;
            display: inline-block;
            vertical-align: top;
            box-sizing: border-box;
        }

        /* Mobile responsive */
        @media screen and (max-width: 600px) {
            .email-wrapper { width: 100% !important; }
            .email-container { width: 100% !important; max-width: 100% !important; }
            .header-title { font-size: 22px !important; }
            .header-sub { font-size: 13px !important; }
            .body-padding { padding: 24px 16px !important; }
            .feature-col {
                width: 100% !important;
                display: block !important;
                padding: 0 !important;
            }
            .feature-card {
                margin: 0 0 12px 0 !important;
            }
            .footer-padding { padding: 20px 16px !important; }
        }
    </style>
</head>
<body style="margin:0;padding:0;background-color:#f0f4f8;">

    <!-- Outer wrapper table -->
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0"
           style="background-color:#f0f4f8;">
        <tr>
            <td align="center" style="padding: 24px 12px;">

                <!-- Email Container -->
                <table class="email-container" role="presentation" width="600" cellspacing="0"
                       cellpadding="0" border="0"
                       style="max-width:600px;width:100%;background-color:#ffffff;border-radius:8px;overflow:hidden;box-shadow:0 2px 12px rgba(0,0,0,0.08);">

                    <!-- ===== HEADER ===== -->
                    <tr>
                        <td align="center"
                            style="background: linear-gradient(135deg, #1a365d 0%, #2d5a9e 100%); padding: 40px 30px;">
                            <p style="margin:0 0 6px 0; font-size:32px;">🎉</p>
                            <h1 class="header-title"
                                style="margin:0 0 10px 0; font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;
                                       font-size:26px; font-weight:700; color:#fbbf24; line-height:1.2;">
                                Selamat Datang!
                            </h1>
                            <p class="header-sub"
                               style="margin:0; font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;
                                      font-size:14px; color:#cbd5e0; line-height:1.5;">
                                Terima kasih telah bergabung dengan Newsletter {{ $schoolName }}
                            </p>
                        </td>
                    </tr>

                    <!-- ===== BODY ===== -->
                    <tr>
                        <td class="body-padding"
                            style="padding: 32px 28px; font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;
                                   color:#333333; line-height:1.8;">

                            <h2 style="margin:0 0 12px 0; font-size:20px; color:#1a365d; font-weight:600;">
                                Halo{{ $subscriberName ? ', ' . $subscriberName : '' }}! 👋
                            </h2>

                            <p style="margin:0 0 16px 0; font-size:15px; color:#4a5568;">
                                Kami sangat antusias menyambut Anda! Mulai sekarang, Anda akan menjadi
                                yang <strong>pertama tahu</strong> tentang berbagai kabar terbaru dari
                                lingkungan sekolah kami.
                            </p>

                            <p style="margin:0 0 20px 0; font-size:15px; color:#4a5568;">
                                Berikut adalah informasi yang akan kami bagikan secara berkala:
                            </p>

                            <!-- ===== 4 FEATURE CARDS — 2x2 table grid ===== -->
                            <!--
                                Teknik: Gunakan <table> dengan 2 kolom (<td>) per baris.
                                Di mobile, setiap .feature-col akan jadi display:block (1 kolom)
                                via media query di atas.
                            -->
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
                                <!-- ROW 1 -->
                                <tr>
                                    <td class="feature-col" width="50%"
                                        style="padding: 0 6px 12px 0; vertical-align:top;">
                                        <table class="feature-card" role="presentation" width="100%"
                                               cellspacing="0" cellpadding="0" border="0"
                                               style="background:#f7f9fc; border-left:4px solid #fbbf24;
                                                      border-radius:4px;">
                                            <tr>
                                                <td style="padding:16px;">
                                                    <p style="margin:0 0 4px 0; font-size:13px; font-weight:700;
                                                               color:#1a365d; font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;">
                                                        📰 Berita &amp; Kegiatan
                                                    </p>
                                                    <p style="margin:0; font-size:12px; color:#718096;
                                                               font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;
                                                               line-height:1.5;">
                                                        Sorotan kegiatan siswa dan program sekolah terbaru.
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td class="feature-col" width="50%"
                                        style="padding: 0 0 12px 6px; vertical-align:top;">
                                        <table class="feature-card" role="presentation" width="100%"
                                               cellspacing="0" cellpadding="0" border="0"
                                               style="background:#f7f9fc; border-left:4px solid #fbbf24;
                                                      border-radius:4px;">
                                            <tr>
                                                <td style="padding:16px;">
                                                    <p style="margin:0 0 4px 0; font-size:13px; font-weight:700;
                                                               color:#1a365d; font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;">
                                                        📅 Agenda Penting
                                                    </p>
                                                    <p style="margin:0; font-size:12px; color:#718096;
                                                               font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;
                                                               line-height:1.5;">
                                                        Pengingat jadwal ujian, hari libur, dan acara besar sekolah.
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <!-- ROW 2 -->
                                <tr>
                                    <td class="feature-col" width="50%"
                                        style="padding: 0 6px 0 0; vertical-align:top;">
                                        <table class="feature-card" role="presentation" width="100%"
                                               cellspacing="0" cellpadding="0" border="0"
                                               style="background:#f7f9fc; border-left:4px solid #fbbf24;
                                                      border-radius:4px;">
                                            <tr>
                                                <td style="padding:16px;">
                                                    <p style="margin:0 0 4px 0; font-size:13px; font-weight:700;
                                                               color:#1a365d; font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;">
                                                        🏫 Info PPDB
                                                    </p>
                                                    <p style="margin:0; font-size:12px; color:#718096;
                                                               font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;
                                                               line-height:1.5;">
                                                        Pembaruan dan jalur pendaftaran untuk calon peserta didik baru.
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td class="feature-col" width="50%"
                                        style="padding: 0 0 0 6px; vertical-align:top;">
                                        <table class="feature-card" role="presentation" width="100%"
                                               cellspacing="0" cellpadding="0" border="0"
                                               style="background:#f7f9fc; border-left:4px solid #fbbf24;
                                                      border-radius:4px;">
                                            <tr>
                                                <td style="padding:16px;">
                                                    <p style="margin:0 0 4px 0; font-size:13px; font-weight:700;
                                                               color:#1a365d; font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;">
                                                        🏆 Prestasi
                                                    </p>
                                                    <p style="margin:0; font-size:12px; color:#718096;
                                                               font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;
                                                               line-height:1.5;">
                                                        Kebanggaan atas pencapaian gemilang siswa dan guru kita.
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            <!-- ===== END FEATURE CARDS ===== -->

                            <!-- Divider -->
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
                                <tr>
                                    <td style="padding: 24px 0 20px 0; border-top: 1px solid #e2e8f0;">
                                        <p style="margin:0; font-size:15px; color:#4a5568; line-height:1.8;">
                                            Jika Anda memiliki pertanyaan atau masukan, pintu kami selalu
                                            terbuka. Silakan balas email ini ke
                                            <a href="mailto:{{ $schoolEmail }}"
                                               style="color:#2d5a9e; text-decoration:none; font-weight:600;">
                                                {{ $schoolEmail }}
                                            </a>
                                            atau hubungi kami di
                                            <strong style="color:#1a365d;">{{ $schoolPhone }}</strong>.
                                        </p>
                                    </td>
                                </tr>
                            </table>

                            <p style="margin:0; font-size:15px; color:#4a5568; line-height:1.8;">
                                Salam hangat,<br>
                                <strong style="color:#1a365d;">Tim Admin {{ $schoolName }}</strong>
                            </p>

                        </td>
                    </tr>

                    <!-- ===== FOOTER ===== -->
                    <tr>
                        <td class="footer-padding"
                            style="background-color:#f7f9fc; padding:24px 28px; text-align:center;
                                   border-top:1px solid #e2e8f0;">
                            <p style="margin:0 0 6px 0; font-size:12px; color:#a0aec0;
                                       font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;">
                                &copy; {{ date('Y') }} {{ $schoolName }}. All rights reserved.
                            </p>
                            <p style="margin:0 0 6px 0; font-size:12px; color:#a0aec0;
                                       font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;">
                                Email ini dikirim karena Anda mendaftar sebagai pelanggan newsletter kami.
                            </p>
                            <p style="margin:0; font-size:12px; font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;">
                                <a href="{{ url('/hubungi-kami') }}"
                                   style="color:#2d5a9e; text-decoration:none;">Hubungi Kami</a>
                            </p>
                        </td>
                    </tr>

                </table>
                <!-- End Email Container -->

            </td>
        </tr>
    </table>
    <!-- End Outer Wrapper -->

</body>
</html>
