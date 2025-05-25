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
        <div class="card card-product h-100">
          <a href="/detail/{{item.id_produk}}">
            <img src="/assets/gambar/{{item.gambar}}" alt="{{item.nama_produk}}" class="card-img-top">
          </a>
          <div class="card-body">
            <a href="/detail/{{item.id_produk}}">
              <h5 class="card-title">{{item.nama_produk}}</h5>
            </a>
            <p class="card-text mb-1"><strong>Rp {{item.harga | number}}</strong></p>
            <p class="card-text text-secondary mb-0">
              <small><strong>Kategori:</strong> {{item.nama_kategori}}</small>
            </p>
            <p class="card-text text-secondary">
              <small><strong>Gender:</strong> {{item.gender}}</small>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?= $this->endSection() ?>
</div>