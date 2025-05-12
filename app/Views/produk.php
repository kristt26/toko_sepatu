<?= $this->extend('layout/info') ?>
<?= $this->section('content') ?>
<div class="container mt-5">
  <!-- Header: Produk Terlaris + Pencarian -->
  <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
    <h2 class="fw-bold text-warning mb-3 mb-md-0">PRODUK TERLARIS</h2>
    <div class="search-box">
      <input type="text" class="form-control rounded-pill py-2 px-4" ng-model="cari" placeholder="Cari sepatu favoritmu..." />
      <i class="bi bi-search"></i>
    </div>
  </div>
  <div class="row">

    <!-- Produk 1 -->
    <div class="col-md-3 col-sm-6 mb-4">
      <div class="card h-100 bg-dark text-light border-warning">
        <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Produk 1">
        <div class="card-body">
          <h5 class="card-title">Nike Air Max</h5>
          <p class="card-text text-warning fw-bold">Rp 1.200.000</p>
        </div>
        <div class="card-footer bg-transparent border-0">
          <button class="btn btn-warning w-100" data-bs-toggle="modal" data-bs-target="#modalProduk1">Deskripsi</button>
        </div>
      </div>
    </div>

    <!-- Modal Produk 1 -->
    <div class="modal fade" id="modalProduk1" tabindex="-1">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-dark text-light">
          <div class="modal-header border-0">
            <h5 class="modal-title text-warning">Nike Air Max</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <img src="https://via.placeholder.com/600x400" class="img-fluid mb-3 rounded">
            <p>Sepatu Nike Air Max dengan bantalan empuk, cocok untuk aktivitas sehari-hari dan olahraga ringan.</p>
            <p class="fw-bold text-warning">Harga: Rp 1.200.000</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Produk 2 -->
    <div class="col-md-3 col-sm-6 mb-4">
      <div class="card h-100 bg-dark text-light border-warning">
        <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Produk 2">
        <div class="card-body">
          <h5 class="card-title">Adidas Ultraboost</h5>
          <p class="card-text text-warning fw-bold">Rp 1.500.000</p>
        </div>
        <div class="card-footer bg-transparent border-0">
          <button class="btn btn-warning w-100" data-bs-toggle="modal" data-bs-target="#modalProduk2">Deskripsi</button>
        </div>
      </div>
    </div>

    <!-- Modal Produk 2 -->
    <div class="modal fade" id="modalProduk2" tabindex="-1">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-dark text-light">
          <div class="modal-header border-0">
            <h5 class="modal-title text-warning">Adidas Ultraboost</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <img src="https://via.placeholder.com/600x400" class="img-fluid mb-3 rounded">
            <p>Adidas Ultraboost dengan teknologi boost terbaru, nyaman untuk berlari maupun aktivitas sehari-hari.</p>
            <p class="fw-bold text-warning">Harga: Rp 1.500.000</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Produk 3 -->
    <div class="col-md-3 col-sm-6 mb-4">
      <div class="card h-100 bg-dark text-light border-warning">
        <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Produk 3">
        <div class="card-body">
          <h5 class="card-title">Puma Rider</h5>
          <p class="card-text text-warning fw-bold">Rp 900.000</p>
        </div>
        <div class="card-footer bg-transparent border-0">
          <button class="btn btn-warning w-100" data-bs-toggle="modal" data-bs-target="#modalProduk3">Deskripsi</button>
        </div>
      </div>
    </div>

    <!-- Modal Produk 3 -->
    <div class="modal fade" id="modalProduk3" tabindex="-1">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-dark text-light">
          <div class="modal-header border-0">
            <h5 class="modal-title text-warning">Puma Rider</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <img src="https://via.placeholder.com/600x400" class="img-fluid mb-3 rounded">
            <p>Puma Rider dengan desain retro yang stylish, ringan dan nyaman digunakan seharian.</p>
            <p class="fw-bold text-warning">Harga: Rp 900.000</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Produk 4 -->
    <div class="col-md-3 col-sm-6 mb-4">
      <div class="card h-100 bg-dark text-light border-warning">
        <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Produk 4">
        <div class="card-body">
          <h5 class="card-title">New Balance 574</h5>
          <p class="card-text text-warning fw-bold">Rp 1.300.000</p>
        </div>
        <div class="card-footer bg-transparent border-0">
          <button class="btn btn-warning w-100" data-bs-toggle="modal" data-bs-target="#modalProduk4">Deskripsi</button>
        </div>
      </div>
    </div>

    <!-- Modal Produk 4 -->
    <div class="modal fade" id="modalProduk4" tabindex="-1">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-dark text-light">
          <div class="modal-header border-0">
            <h5 class="modal-title text-warning">New Balance 574</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <img src="https://via.placeholder.com/600x400" class="img-fluid mb-3 rounded">
            <p>New Balance 574, sepatu klasik dengan kenyamanan premium dan daya tahan tinggi.</p>
            <p class="fw-bold text-warning">Harga: Rp 1.300.000</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Produk 5 -->
    <div class="col-md-3 col-sm-6 mb-4">
      <div class="card h-100 bg-dark text-light border-warning">
        <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Produk 5">
        <div class="card-body">
          <h5 class="card-title">Asics Gel-Kayano</h5>
          <p class="card-text text-warning fw-bold">Rp 1.700.000</p>
        </div>
        <div class="card-footer bg-transparent border-0">
          <button class="btn btn-warning w-100" data-bs-toggle="modal" data-bs-target="#modalProduk5">Deskripsi</button>
        </div>
      </div>
    </div>

    <!-- Modal Produk 5 -->
    <div class="modal fade" id="modalProduk5" tabindex="-1">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-dark text-light">
          <div class="modal-header border-0">
            <h5 class="modal-title text-warning">Asics Gel-Kayano</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <img src="https://via.placeholder.com/600x400" class="img-fluid mb-3 rounded">
            <p>Asics Gel-Kayano dengan teknologi stabilitas tinggi untuk lari jarak jauh yang nyaman.</p>
            <p class="fw-bold text-warning">Harga: Rp 1.700.000</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Produk 6 -->
    <div class="col-md-3 col-sm-6 mb-4">
      <div class="card h-100 bg-dark text-light border-warning">
        <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Produk 6">
        <div class="card-body">
          <h5 class="card-title">Converse Chuck 70</h5>
          <p class="card-text text-warning fw-bold">Rp 850.000</p>
        </div>
        <div class="card-footer bg-transparent border-0">
          <button class="btn btn-warning w-100" data-bs-toggle="modal" data-bs-target="#modalProduk6">Deskripsi</button>
        </div>
      </div>
    </div>

    <!-- Modal Produk 6 -->
    <div class="modal fade" id="modalProduk6" tabindex="-1">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-dark text-light">
          <div class="modal-header border-0">
            <h5 class="modal-title text-warning">Converse Chuck 70</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <img src="https://via.placeholder.com/600x400" class="img-fluid mb-3 rounded">
            <p>Converse Chuck 70 edisi klasik, kanvas premium dengan sol yang lebih empuk.</p>
            <p class="fw-bold text-warning">Harga: Rp 850.000</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Produk 7 -->
    <div class="col-md-3 col-sm-6 mb-4">
      <div class="card h-100 bg-dark text-light border-warning">
        <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Produk 7">
        <div class="card-body">
          <h5 class="card-title">Vans Old Skool</h5>
          <p class="card-text text-warning fw-bold">Rp 700.000</p>
        </div>
        <div class="card-footer bg-transparent border-0">
          <button class="btn btn-warning w-100" data-bs-toggle="modal" data-bs-target="#modalProduk7">Deskripsi</button>
        </div>
      </div>
    </div>

    <!-- Modal Produk 7 -->
    <div class="modal fade" id="modalProduk7" tabindex="-1">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-dark text-light">
          <div class="modal-header border-0">
            <h5 class="modal-title text-warning">Vans Old Skool</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <img src="https://via.placeholder.com/600x400" class="img-fluid mb-3 rounded">
            <p>Vans Old Skool dengan stripe ikonik, cocok untuk skate maupun tampilan kasual harian.</p>
            <p class="fw-bold text-warning">Harga: Rp 700.000</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Produk 8 -->
    <div class="col-md-3 col-sm-6 mb-4">
      <div class="card h-100 bg-dark text-light border-warning">
        <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Produk 8">
        <div class="card-body">
          <h5 class="card-title">Reebok Classic</h5>
          <p class="card-text text-warning fw-bold">Rp 950.000</p>
        </div>
        <div class="card-footer bg-transparent border-0">
          <button class="btn btn-warning w-100" data-bs-toggle="modal" data-bs-target="#modalProduk8">Deskripsi</button>
        </div>
      </div>
    </div>

    <!-- Modal Produk 8 -->
    <div class="modal fade" id="modalProduk8" tabindex="-1">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-dark text-light">
          <div class="modal-header border-0">
            <h5 class="modal-title text-warning">Reebok Classic</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <img src="https://via.placeholder.com/600x400" class="img-fluid mb-3 rounded">
            <p>Reebok Classic edisi timeless, desain minimalis dengan kenyamanan optimal.</p>
            <p class="fw-bold text-warning">Harga: Rp 950.000</p>
          </div>
        </div>
      </div>
    </div>

  </div>


</div>
<style>
  .search-box {
    width: 616px;
    max-width: 601px;
    margin: 0 0px !important;
    position: relative;
  }
</style>
<?= $this->endSection(); ?>