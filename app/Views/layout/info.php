<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ShoesStore Elegan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <link rel="stylesheet" href="/assets/styles.css">
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg">
    <div class="container">
      <a class="navbar-brand" href="#">Sneakers Jayapura</a>
      <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarElegant">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarElegant">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" href="#"><i class="bi bi-house-door-fill me-1"></i>Beranda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"><i class="bi bi-bag-fill me-1"></i>Produk</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"><i class="bi bi-cart-fill me-1"></i>Keranjang</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"><i class="bi bi-info-circle-fill me-1"></i>Tentang</a>
          </li>
        </ul>
        <?php if (!session()->get('logged_in')) : ?>
          <div class="d-flex">
            <a href="/auth" class="btn btn-outline-light me-2"><i class="bi bi-box-arrow-in-right me-1"></i>Masuk</a>
            <a href="/auth/register" class="btn btn-warning"><i class="bi bi-person-plus-fill me-1"></i>Daftar</a>
          </div>
        <?php endif; ?>
        <?php if (session()->get('logged_in')) : ?>
          <div class="d-flex">
            <a href="/auth/logout" class="btn btn-secondary">
              <i class="bi bi-box-arrow-right me-1"></i> Logout
            </a>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </nav>

  <?= $this->renderSection('content'); ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>