<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Registrasi Berhasil</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap 4 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Google Font & Custom Style -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f9fafb;
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
    }

    .card-modern {
      background: #ffffff;
      border-radius: 16px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.08);
      padding: 40px 30px;
      max-width: 480px;
      text-align: center;
      animation: fadeInUp 0.6s ease-out;
    }

    .success-icon {
      background-color: #e6ffed;
      color: #28a745;
      border-radius: 50%;
      width: 72px;
      height: 72px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 24px;
    }

    .success-icon svg {
      width: 36px;
      height: 36px;
    }

    h1 {
      font-weight: 600;
      font-size: 24px;
      margin-bottom: 12px;
      color: #212529;
    }

    p {
      font-size: 16px;
      color: #6c757d;
    }

    .btn-login {
      margin-top: 24px;
      padding: 12px 24px;
      font-weight: 500;
      font-size: 16px;
      border-radius: 8px;
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
</head>
<body>

  <div class="card-modern">
    <div class="success-icon">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
           stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="12" r="10" />
        <path d="M9 12l2 2 4-4" />
      </svg>
    </div>

    <h1>Registrasi Berhasil</h1>
    <p>Akun Anda telah dibuat dengan sukses. informasi akun anda telah dikirim ke email yang didaftarkan, Silakan login untuk mulai menggunakan sistem rekrutmen kami.</p>

    <a href="<?= base_url('/auth') ?>" class="btn btn-success btn-login">Login Sekarang</a>
  </div>

</body>
</html>
