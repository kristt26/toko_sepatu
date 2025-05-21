<?= $this->extend('layout/info') ?>
<?= $this->section('content') ?>
<div ng-controller="dashboardController">
  <div class="container">
    <div class="highlight-title">
      CARI SEPATU KEREN? <br />SNEAKERS JAYAPURA SOLUSINYA
    </div>
    <div class="search-box">
      <input type="text" class="form-control rounded-pill py-2 px-4" ng-model="cari" placeholder="Cari sepatu favoritmu..." />
      <i class="bi bi-search"></i>
    </div>
  </div>
  <div class="container pb-5">
    <div class="row g-4">
      <div class="col-md-3" ng-repeat="item in datas | limitTo: 4 | filter: cari">
        <div class="card card-product">
          <a href="/detail/{{item.id_produk}}">
            <img src="/assets/gambar/{{item.gambar}}" alt="Sepatu 1">
          </a>
          <div class="card-body">
            <a href="/detail/{{item.id_produk}}">
              <h5 class="card-title">{{item.nama_produk}}</h5>
            </a>
            <p class="card-text">Rp {{item.harga | number}}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?= $this->endSection() ?>
</div>