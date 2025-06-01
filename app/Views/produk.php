<?= $this->extend('layout/info') ?>
<?= $this->section('content') ?>
<div class="container mt-5" ng-controller="produkController">
  <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
    <h2 class="fw-bold text-warning mb-0">PRODUK TERLARIS</h2>
    <div class="search-box w-100 w-md-auto">
      <input type="text" class="form-control rounded-pill py-2 px-4" ng-model="cari" placeholder="Cari sepatu..." />
      <i class="bi bi-search"></i>
    </div>
  </div>

  <div class="row g-4">
    <div class="col-12 col-sm-6 col-md-4 col-lg-3" ng-repeat="item in datas | limitTo: 8 | filter: cari">
      <div class="card h-100 bg-dark text-light border-warning">
        <img src="/assets/gambar/{{item.gambar}}" class="card-img-top" style="object-fit: cover; height: 200px;" alt="{{item.nama_produk}}">
        <div class="card-body">
          <h5 class="card-title">{{item.nama_produk}}</h5>
          <p class="card-text text-warning fw-bold">Rp {{item.harga | number}}</p>
          <p class="card-text mb-0" style="color: #ccc;">
            <small><strong>Kategori:</strong> {{item.nama_kategori}}</small>
          </p>
          <p class="card-text" style="color: #ccc;">
            <small><strong>Gender:</strong> {{item.gender}}</small>
          </p>
        </div>
        <div class="card-footer bg-transparent border-0 d-flex flex-column flex-md-row gap-2">
          <button class="btn btn-warning w-100" ng-click="descripsi(item)">
            Deskripsi
          </button>
          <a href="/detail/{{item.id_produk}}" class="btn btn-outline-light w-100" ng-click="tambahKeKeranjang(item)">
            <i class="bi bi-cart-plus"></i> Keranjang
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Produk -->
  <div class="modal fade" id="modalProduk1" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content bg-dark text-light">
        <div class="modal-header border-0">
          <h5 class="modal-title text-warning">{{model.nama_produk}}</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <img src="/assets/gambar/{{model.gambar}}" class="img-fluid mb-3 rounded">
          <p>{{model.keterangan}}</p>
          <p class="fw-bold text-warning">Harga: Rp {{model.harga | number}}</p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Style Responsive -->
<style>
  .search-box {
    max-width: 600px;
    width: 100%;
    position: relative;
  }

  .search-box .bi-search {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: #ccc;
  }

  @media (max-width: 576px) {
    .card-footer {
      flex-direction: column !important;
    }
  }
</style>
<?= $this->endSection(); ?>