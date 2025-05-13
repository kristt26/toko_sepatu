<?= $this->extend('layout/info') ?>
<?= $this->section('content') ?>
<div class="container mt-5" ng-controller="produkController">
  <!-- Header: Produk Terlaris + Pencarian -->
  <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
    <h2 class="fw-bold text-warning mb-3 mb-md-0">PRODUK TERLARIS</h2>
    <div class="search-box">
      <input type="text" class="form-control rounded-pill py-2 px-4" ng-model="cari" placeholder="Cari sepatu..." />
      <i class="bi bi-search"></i>
    </div>
  </div>
  <div class="row">

    <!-- Produk 1 -->
    <div class="col-md-3 col-sm-6 mb-4" ng-repeat="item in datas | limitTo: 8 | filter: cari">
      <div class="card h-100 bg-dark text-light border-warning">
        <img src="/assets/gambar/{{item.gambar}}" class="card-img-top" style="object-fit: cover; height: 200px;" alt="Produk 1">
        <div class="card-body">
          <h5 class="card-title">{{item.nama_produk}}</h5>
          <p class="card-text text-warning fw-bold">Rp {{item.harga | number}}</p>
        </div>
        <div class="card-footer bg-transparent border-0 d-flex gap-2" style="margin-top: -8px !important;">
          <button class="btn btn-warning w-50" ng-click="descripsi(item)">
            Deskripsi
          </button>
          <a href="/detail/{{item.id_produk}}" class="btn btn-outline-light w-50" ng-click="tambahKeKeranjang(item)">
            <i class="bi bi-cart-plus"></i> Keranjang
          </a>
        </div>
      </div>
    </div>

    <!-- Modal Produk 1 -->
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