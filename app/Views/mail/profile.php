<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Notifikasi Kelengkapan Profil</title>
</head>

<body style="margin:0; padding:0; background-color:#f4f4f4; font-family:Arial, sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f4; padding: 20px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 0 10px rgba(0,0,0,0.05);">
                    <tr>
                        <td style="background-color:#28a745; padding: 20px; text-align:center; color:#ffffff;">
                            <h2 style="margin:0;">✅ Profil dan Dokumen Lengkap</h2>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 30px;">
                            <p style="font-size: 16px; margin-bottom: 20px;">
                                Halo <strong><?= esc($nama_pelamar) ?></strong>,
                            </p>

                            <p style="font-size: 16px; margin-bottom: 20px;">
                                Terima kasih telah melengkapi profil Anda dan mengunggah semua dokumen yang dibutuhkan. Berikut adalah daftar berkas yang telah kami terima:
                            </p>

                            <ul style="font-size: 16px; padding-left: 20px; color:#28a745;">
                                <li>KTP</li>
                                <li>Kartu Keluarga (KK)</li>
                                <li>Ijazah</li>
                                <li>SKCK</li>
                                <li>Curriculum Vitae (CV)</li>
                                <li>Pas Foto</li>
                            </ul>

                            <p style="font-size: 16px; margin-top: 20px;">
                                Anda dapat melanjutkan proses seleksi melalui dashboard sistem rekrutmen kami.
                            </p>

                            <div style="margin-top: 30px; text-align: center;">
                                <a href="{link_dashboard}" style="background-color:#28a745; color:#ffffff; padding: 12px 24px; text-decoration:none; border-radius:6px; display:inline-block;">
                                    Buka Dashboard
                                </a>
                            </div>

                            <p style="font-size: 14px; color: #888888; margin-top: 40px; text-align: center;">
                                Email ini dikirim otomatis oleh sistem. Jangan membalas email ini.
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="background-color:#f0f0f0; text-align:center; padding:15px; font-size:12px; color:#888;">
                            &copy; <?= date('Y') ?> Sistem Rekrutmen Perusahaan
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

</body>

</html>