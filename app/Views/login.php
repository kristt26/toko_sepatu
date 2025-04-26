<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - ShoesStore</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #111;
      color: #fff;
    }

    .card {
      background-color: #1c1c1c;
      border: 1px solid #333;
      border-radius: 12px;
      color: #fff;
    }

    .form-control {
      background-color: #2a2a2a;
      border: 1px solid #444;
      color: #fff;
    }

    .form-control:focus {
      border-color: #f4c10f;
      box-shadow: none;
    }

    .btn-warning {
      background-color: #f4c10f;
      border: none;
      font-weight: bold;
      color: #000;
    }

    .btn-warning:hover {
      background-color: #d4a90d;
    }

    .link-warning {
      color: #f4c10f;
      text-decoration: none;
    }

    .link-warning:hover {
      color: #d4a90d;
      text-decoration: underline;
    }

    .invalid-feedback {
      color: #dc3545;
      font-size: 0.875em;
    }

    .is-invalid {
      border-color: #dc3545 !important;
    }

    .alert {
      border-radius: 8px;
    }
  </style>
</head>

<body>
  <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 shadow-lg" style="width: 100%; max-width: 400px;">
      <h3 class="text-center mb-4">Masuk ke ShoesStore</h3>

      <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
      <?php endif; ?>

      <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
      <?php endif; ?>

      <form action="/auth/login" method="POST">
        <div class="mb-3">
          <label for="login" class="form-label">Username atau Email</label>
          <input type="text" class="form-control <?= isset(session('errors')['login']) ? 'is-invalid' : '' ?>"
            id="login" name="login"
            value="<?= old('login') ?>" required>
          <?php if (isset(session('errors')['login'])): ?>
            <div class="invalid-feedback">
              <?= is_array(session('errors')['login']) ? session('errors')['login'][0] : session('errors')['login'] ?>
            </div>
          <?php endif; ?>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Kata Sandi</label>
          <input type="password" class="form-control <?= isset(session('errors')['password']) ? 'is-invalid' : '' ?>"
            id="password" name="password" required>
          <?php if (isset(session('errors')['password'])): ?>
            <div class="invalid-feedback">
              <?= is_array(session('errors')['password']) ? session('errors')['password'][0] : session('errors')['password'] ?>
            </div>
          <?php endif; ?>
        </div>

        <div class="d-grid mb-3">
          <button type="submit" class="btn btn-warning">Masuk</button>
        </div>

        <p class="text-center">Belum punya akun?
          <a href="/auth/register" class="link-warning">Daftar</a>
        </p>
      </form>
    </div>
  </div>
</body>

</html>