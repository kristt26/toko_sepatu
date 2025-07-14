<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Notifikasi Registrasi Akun</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f4f4f7;
      margin: 0;
      padding: 0;
    }
    .container {
      background-color: #ffffff;
      max-width: 600px;
      margin: 30px auto;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      overflow: hidden;
    }
    .header {
      background-color: #007bff;
      color: #ffffff;
      padding: 20px;
      text-align: center;
    }
    .content {
      padding: 30px;
      color: #333333;
    }
    .footer {
      background-color: #f4f4f7;
      padding: 15px;
      text-align: center;
      font-size: 12px;
      color: #888888;
    }
    .btn {
      background-color: #007bff;
      color: #ffffff;
      padding: 10px 20px;
      text-decoration: none;
      border-radius: 4px;
      display: inline-block;
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h2>Pendaftaran Akun Berhasil</h2>
    </div>
    <div class="content">
      <p>Halo <strong><?= esc($nama_pelamar) ?></strong>,</p>
      <p>Terima kasih telah melakukan pendaftaran akun pada sistem rekrutmen <strong><?= esc($nama_perusahaan) ?></strong>.</p>
      <p>Berikut adalah detail akun Anda:</p>
      <ul>
        <li><strong>NIK:</strong> <?= esc($nik) ?></li>
        <li><strong>Username:</strong> <?= esc($username) ?></li>
        <li><strong>Password:</strong> <?= esc($password) ?></li>
        <li><strong>Email:</strong> <?= esc($email) ?></li>
      </ul>
      <p>Silakan login ke sistem untuk melengkapi profil Anda dan melihat lowongan pekerjaan yang tersedia.</p>
      <a href="<?= esc($link_login) ?>" class="btn">Login Sekarang</a>
      <p style="margin-top: 30px;">Jika Anda tidak melakukan pendaftaran ini, harap abaikan email ini.</p>
    </div>
    <div class="footer">
      &copy; <?= esc($tahun) ?> <?= esc($nama_perusahaan) ?>. All rights reserved.
    </div>
  </div>
</body>
</html>
