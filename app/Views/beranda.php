<?= $this->extend('layout/info') ?>
<?= $this->section('content') ?>
<div ng-controller="dashboardController">
  <div class="container">
    <div class="highlight-title">
      CARI SEPATU KEREN? <br />SNEAKERS JAYAPURA SOLUSINYA
    </div>

    <!-- Pencarian -->
    <div class="search-box">
      <input type="text" class="form-control rounded-pill py-2 px-4" ng-model="cari" placeholder="Cari sepatu favoritmu..." />
      <i class="bi bi-search"></i>
    </div>
  </div>

  <!-- Produk -->
  <div class="container pb-5">
    <div class="row g-4">
      <!-- Produk 1 -->
      <div class="col-md-3" ng-repeat="item in datas | limitTo: 4 | filter: cari">
        <div class="card card-product">
          <a href="/detail/{{item.id_produk}}">
            <img src="/assets/gambar/{{item.variant[0].gambar}}" alt="Sepatu 1">
          </a>
          <div class="card-body">
            <a href="/detail/{{item.id_produk}}">
              <h5 class="card-title">{{item.nama_produk}}</h5>
            </a>
            <p class="card-text">Rp 1.250.000</p>
            <!-- <div class="d-flex justify-content-center gap-3">
              <button class="btn-cart cart" title="Masukkan Keranjang">
                <i class="bi bi-cart-plus-fill"></i>
              </button>
              <button class="btn-cart checkout" title="Checkout Langsung">
                <i class="bi bi-credit-card-fill"></i>
              </button>
            </div> -->
          </div>
        </div>
      </div>
      <!-- Produk 2 -->

    </div>
  </div>
  <?= $this->endSection() ?>
</div>