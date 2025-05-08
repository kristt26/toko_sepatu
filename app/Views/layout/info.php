<!DOCTYPE html>
<html lang="id" ng-app="apps" ng-controller="indexController" ng-cloak>

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
        <ul class="navbar-nav me-auto mb-2 mb-lg-0  justify-content-center w-100">
          <li class="nav-item">
            <a class="nav-link <?= current_url() == base_url('/') ? 'active' : '' ?>" href="/"><i class="bi bi-house-door-fill me-1"></i>Beranda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= current_url() == base_url('/produk') ? 'active' : '' ?>" href="/produk"><i class="bi bi-bag-fill me-1"></i>Produk</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= current_url() == base_url('/checkout') ? 'active' : '' ?>" href="/checkout"><i class="bi bi-cart-fill me-1"></i>Keranjang
            <?php if (session()->get('logged_in')) : ?>
              <sup>
                <span class="badge bg-danger" id="cart-count">{{keranjang.cart.length}}</span>
              </sup>
              <?php endif; ?>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= current_url() == base_url('/tentang') ? 'active' : '' ?>" href="/tentang"><i class="bi bi-info-circle-fill me-1"></i>Tentang</a>
          </li>
        </ul>
        <?php if (!session()->get('logged_in')) : ?>
          <div class="d-flex">
            <a href="/auth" class="btn btn-outline-light me-2 d-flex align-items-center"><i class="bi bi-box-arrow-in-right me-1"></i>Masuk</a>
            <a href="/auth/register" class="btn btn-warning d-flex align-items-center"><i class="bi bi-person-plus-fill me-1"></i>Daftar</a>
          </div>
        <?php endif; ?>
        <?php if (session()->get('logged_in')) : ?>
          <div class="d-flex">
            <a href="/auth/logout" class="btn btn-secondary d-flex align-items-center me-2">
              <i class="bi bi-box-arrow-right me-1"></i> Logout
            </a>
            <a href="/profile" class="btn btn-info d-flex align-items-center">
              <i class="bi bi-person-circle me-1"></i> Profile
            </a>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </nav>

  <?= $this->renderSection('content'); ?>

  <script src="/libs/angular/angular.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/js/info.js"></script>
  <script src="/assets/js/jquery-3.3.1.min.js"></script>
  <script src="/js/services/helper.services.js"></script>
  <script src="/js/services/auth.services.js"></script>
  <script src="/js/services/info.services.js"></script>
  <script src="/js/services/pesan.services.js"></script>
  <script src="/js/controllers/info.controllers.js"></script>
  <script src="/libs/angular-ui-select2/src/select2.js"></script>
  <script src="/libs/angular-datatables/dist/angular-datatables.js"></script>
  <script src="/libs/angular-locale_id-id.js"></script>
  <script src="/libs/input-mask/angular-input-masks-standalone.min.js"></script>
  <script src="/libs/jquery.PrintArea.js"></script>
  <script src="/libs/angular-base64-upload/dist/angular-base64-upload.min.js"></script>
  <script src="/libs/sweetalert2/dist/sweetalert2.all.min.js"></script>
  <script src="/libs/datatables/jquery.dataTables.min.js"></script>
  <script src="/libs/datatables/dataTables.bootstrap4.min.js"></script>
  <script src="/libs/datatables/dataTables.responsive.min.js"></script>
  <script src="/libs/datatables/btn.js"></script>
  <script src="/libs/datatables/print.js"></script>
  <script src="/libs/loading/dist/loadingoverlay.min.js"></script>
  <script src="/libs/angularjs-currency-input-mask/dist/angularjs-currency-input-mask.js"></script>
  <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
    <script>
        const navLinks = document.querySelectorAll('.navbar-nav .nav-link');

        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                navLinks.forEach(nav => nav.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
</body>

</html>