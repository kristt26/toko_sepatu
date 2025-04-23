<?= $this->extend('layout/info') ?>
<?= $this->section('content') ?>
<div class="container">
    <div class="highlight-title">
      CARI SEPATU KEREN? <br />SNEAKERS JAYAPURA SOLUSINYA
    </div>

    <!-- Pencarian -->
    <div class="search-box">
      <input type="text" class="form-control rounded-pill py-2 px-4" placeholder="Cari sepatu favoritmu..." />
      <i class="bi bi-search"></i>
    </div>
  </div>

  <!-- Produk -->
  <div class="container pb-5">
    <div class="row g-4">
      <!-- Produk 1 -->
      <div class="col-md-3">
        <div class="card card-product">
          <img src="https://source.unsplash.com/400x300/?sneakers,black" alt="Sepatu 1">
          <div class="card-body">
            <h5 class="card-title">Air Max One</h5>
            <p class="card-text">Rp 1.250.000</p>
            <div class="d-flex justify-content-center gap-3">
              <button class="btn-cart cart" title="Masukkan Keranjang">
                <i class="bi bi-cart-plus-fill"></i>
              </button>
              <button class="btn-cart checkout" title="Checkout Langsung">
                <i class="bi bi-credit-card-fill"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- Produk 2 -->
      <div class="col-md-3">
        <div class="card card-product">
          <img src="https://source.unsplash.com/400x300/?sneakers,white" alt="Sepatu 2">
          <div class="card-body">
            <h5 class="card-title">Sneakers Alpha</h5>
            <p class="card-text">Rp 980.000</p>
            <div class="d-flex justify-content-center gap-3">
              <button class="btn-cart cart" title="Masukkan Keranjang">
                <i class="bi bi-cart-plus-fill"></i>
              </button>
              <button class="btn-cart checkout" title="Checkout Langsung">
                <i class="bi bi-credit-card-fill"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- Produk 3 -->
      <div class="col-md-3">
        <div class="card card-product">
          <img src="https://source.unsplash.com/400x300/?shoes,grey" alt="Sepatu 3">
          <div class="card-body">
            <h5 class="card-title">Urban Street</h5>
            <p class="card-text">Rp 1.100.000</p>
            <div class="d-flex justify-content-center gap-3">
              <button class="btn-cart cart" title="Masukkan Keranjang">
                <i class="bi bi-cart-plus-fill"></i>
              </button>
              <button class="btn-cart checkout" title="Checkout Langsung">
                <i class="bi bi-credit-card-fill"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- Produk 4 -->
      <div class="col-md-3">
        <div class="card card-product">
          <img src="https://source.unsplash.com/400x300/?sneakers,classic" alt="Sepatu 4">
          <div class="card-body">
            <h5 class="card-title">Classic Runner</h5>
            <p class="card-text">Rp 1.050.000</p>
            <div class="d-flex justify-content-center gap-3">
              <button class="btn-cart cart" title="Masukkan Keranjang">
                <i class="bi bi-cart-plus-fill"></i>
              </button>
              <button class="btn-cart checkout" title="Checkout Langsung">
                <i class="bi bi-credit-card-fill"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?= $this->endSection() ?>