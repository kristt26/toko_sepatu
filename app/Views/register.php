<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Daftar - Sneakers Jayapura</title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary: #f4c10f;
            --primary-hover: #d4a90d;
            --dark-bg: #1a1a1a;
            --darker-bg: #111;
            --input-bg: #2a2a2a;
            --border-color: #444;
        }

        body {
            background-color: var(--darker-bg);
            color: #fff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .register-container {
            max-width: 800px;
            margin: 2rem auto;
        }

        .register-card {
            background-color: var(--dark-bg);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        .form-section {
            padding: 2rem;
        }

        .form-title {
            color: var(--primary);
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .form-control {
            background-color: var(--input-bg);
            border: 1px solid var(--border-color);
            color: #fff;
            padding: 12px 15px;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.25rem rgba(244, 193, 15, 0.25);
            background-color: var(--input-bg);
            color: #fff;
        }

        .btn-primary-custom {
            background-color: var(--primary);
            border: none;
            font-weight: 600;
            color: #000;
            padding: 12px;
            border-radius: 8px;
            transition: all 0.3s;
            width: 100%;
        }

        .btn-primary-custom:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
        }

        .input-group-text {
            background-color: var(--input-bg);
            border: 1px solid var(--border-color);
            color: #aaa;
        }

        .password-toggle-icon {
            cursor: pointer;
            color: #aaa;
            transition: all 0.3s;
        }

        .password-toggle-icon:hover {
            color: var(--primary);
        }

        .invalid-feedback {
            display: block;
            margin-top: 5px;
            font-size: 0.85rem;
            color: #dc3545;
        }

        .is-invalid {
            border-color: #dc3545 !important;
        }

        .input-group.is-invalid {
            border: 1px solid #dc3545;
            border-radius: 8px;
        }

        .form-divider {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
            color: #666;
        }

        .form-divider::before,
        .form-divider::after {
            content: "";
            flex: 1;
            border-bottom: 1px solid var(--border-color);
        }

        .form-divider::before {
            margin-right: 1rem;
        }

        .form-divider::after {
            margin-left: 1rem;
        }

        .login-link {
            text-align: center;
            margin-top: 1.5rem;
        }

        .login-link a {
            color: var(--primary);
            text-decoration: none;
        }

        .login-link a:hover {
            color: var(--primary-hover);
            text-decoration: underline;
        }

        .alert {
            border-radius: 8px;
        }

        @media (max-width: 768px) {
            .register-container {
                padding: 0 15px;
            }

            .form-section {
                padding: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <div class="register-container">
        <div class="register-card">
            <div class="row g-0">
                <!-- Form Section -->
                <div class="col-md-12">
                    <div class="form-section">
                        <h3 class="form-title">Buat Akun Baru</h3>

                        <!-- Alert untuk pesan sukses/error -->
                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success">
                                <?= session()->getFlashdata('success') ?>
                            </div>
                        <?php endif; ?>

                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger">
                                <?= session()->getFlashdata('error') ?>
                            </div>
                        <?php endif; ?>

                        <form action="/auth/register" method="POST">
                            <div class="row">
                                <!-- Login Info -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <div class="input-group <?= session('errors.username') ? 'is-invalid' : '' ?>">
                                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                                            <input type="text" class="form-control" id="username" name="username" 
                                                   value="<?= old('username') ?>" placeholder="username" required>
                                        </div>
                                        <?php if (session('errors.username')): ?>
                                            <div class="invalid-feedback"><?= session('errors.username') ?></div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group <?= session('errors.password') ? 'is-invalid' : '' ?>">
                                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                            <input type="password" class="form-control" id="password" name="password" 
                                                   placeholder="Minimal 6 karakter" required>
                                        </div>
                                        <?php if (session('errors.password')): ?>
                                            <div class="invalid-feedback"><?= session('errors.password') ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <!-- Profile Info -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama Lengkap</label>
                                        <div class="input-group <?= session('errors.nama') ? 'is-invalid' : '' ?>">
                                            <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                                            <input type="text" class="form-control" id="nama" name="nama" 
                                                   value="<?= old('nama') ?>" placeholder="Nama lengkap" required>
                                        </div>
                                        <?php if (session('errors.nama')): ?>
                                            <div class="invalid-feedback"><?= session('errors.nama') ?></div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <div class="input-group <?= session('errors.email') ? 'is-invalid' : '' ?>">
                                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                            <input type="email" class="form-control" id="email" name="email" 
                                                   value="<?= old('email') ?>" placeholder="email@contoh.com" required>
                                        </div>
                                        <?php if (session('errors.email')): ?>
                                            <div class="invalid-feedback"><?= session('errors.email') ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Nomor Telepon</label>
                                        <div class="input-group <?= session('errors.phone') ? 'is-invalid' : '' ?>">
                                            <span class="input-group-text"><i class="bi bi-phone"></i></span>
                                            <input type="tel" class="form-control" id="phone" name="phone" 
                                                   value="<?= old('phone') ?>" placeholder="08123456789" required>
                                        </div>
                                        <?php if (session('errors.phone')): ?>
                                            <div class="invalid-feedback"><?= session('errors.phone') ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="alamat" class="form-label">Alamat</label>
                                        <textarea class="form-control <?= session('errors.alamat') ? 'is-invalid' : '' ?>" 
                                                  id="alamat" name="alamat" rows="1" 
                                                  placeholder="Alamat lengkap" required><?= old('alamat') ?></textarea>
                                        <?php if (session('errors.alamat')): ?>
                                            <div class="invalid-feedback"><?= session('errors.alamat') ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-primary-custom">
                                    <i class="bi bi-person-plus"></i> Daftar Sekarang
                                </button>
                            </div>

                            <div class="login-link">
                                Sudah punya akun? <a href="/auth">Masuk disini</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>