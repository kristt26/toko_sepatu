<?= $this->extend('layout/info') ?>
<?= $this->section('content') ?>

<div class="container py-5" ng-controller="detailController" ng-cloak>
  <div class="row">
    <div class="col-md-6">
      <img src="/assets/gambar/{{datas.variant[0].gambar}}" alt="{{datas.nama_produk}}" class="img-fluid rounded mb-3">

      <!-- Tabs hanya tampil di mobile -->
      <ul class="nav nav-tabs d-md-none mb-3" id="productTab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="desc-tab" data-bs-toggle="tab" data-bs-target="#desc" type="button" role="tab" aria-controls="desc" aria-selected="true">
            Deskripsi
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="order-tab" data-bs-toggle="tab" data-bs-target="#order" type="button" role="tab" aria-controls="order" aria-selected="false">
            Pesan
          </button>
        </li>
      </ul>

      <div class="tab-content d-md-none" id="productTabContent">
        <div class="tab-pane fade show active" id="desc" role="tabpanel" aria-labelledby="desc-tab" ng-bind-html="datas.keterangan"></div>

        <div class="tab-pane fade" id="order" role="tabpanel" aria-labelledby="order-tab">
          <p class="text-success mb-3">
            Stok Tersedia: {{selectedSize && selectedColor && (totalStock == null || totalStock <= 0) ? 'Habis' : totalStock}}
          </p>
          <div class="mb-3 mt-3">
            <label class="form-label fw-semibold">Pilih Ukuran:</label>
            <div class="d-flex gap-2 flex-wrap">
              <button type="button" class="btn btn-outline-primary"
                ng-class="{'active': selectedSize === variant.ukuran}"
                ng-repeat="variant in datas.variant | unique:'ukuran'"
                ng-click="selectSize(variant.ukuran, variant.warna)">
                {{variant.ukuran}}
              </button>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold">Pilih Warna:</label>
            <div class="d-flex gap-2 flex-wrap">
              <button type="button" class="btn btn-outline-secondary"
                ng-class="{'active': selectedColor === variant.warna}"
                ng-repeat="variant in datas.variant | unique:'warna'"
                ng-click="selectColor(variant.warna, variant.ukuran)">
                {{variant.warna}}
              </button>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold">Jumlah:</label>
            <input type="number" class="form-control w-50" ng-model="quantity" min="1" placeholder="1" />
          </div>

          <div class="d-flex gap-3">
            <button class="btn btn-primary flex-fill" ng-click="addToCart()">
              <i class="bi bi-cart-plus-fill me-1"></i> Tambah ke Keranjang
            </button>
            <button class="btn btn-success flex-fill" ng-click="checkoutNow()">
              <i class="bi bi-credit-card-fill me-1"></i> Beli Sekarang
            </button>
          </div>
        </div>
      </div>

      <!-- Di desktop tampil biasa -->
      <p class="mt-3 d-none d-md-block" ng-bind-html="datas.keterangan"></p>
    </div>

    <div class="col-md-6 d-none d-md-flex flex-column" style="min-height: 100%;">
      <h1 class="mb-3">{{datas.nama_produk}}</h1>
      <h4 class="text-danger mb-3">Rp {{datas.harga | number}}</h4>
      <p class="text-success mb-4">Stok Tersedia: {{selectedSize && selectedColor && (totalStock == null || totalStock <= 0) ? 'Habis' : totalStock}}</p>

      <div class="mb-3">
        <label class="form-label fw-semibold">Pilih Ukuran:</label>
        <div class="d-flex gap-2 flex-wrap">
          <button type="button" class="btn btn-outline-primary"
            ng-class="{'active': selectedSize === variant.ukuran}"
            ng-repeat="variant in datas.variant | unique:'ukuran'"
            ng-click="selectSize(variant.ukuran, variant.warna)">
            {{variant.ukuran}}
          </button>
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label fw-semibold">Pilih Warna:</label>
        <div class="d-flex gap-2 flex-wrap">
          <button type="button" class="btn btn-outline-secondary"
            ng-class="{'active': selectedColor === variant.warna}"
            ng-repeat="variant in datas.variant | unique:'warna'"
            ng-click="selectColor(variant.warna, variant.ukuran)">
            {{variant.warna}}
          </button>
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label fw-semibold">Jumlah:</label>
        <input type="number" class="form-control w-25" ng-model="quantity" min="1" placeholder="1" />
      </div>

      <div class="d-flex gap-3 mt-auto">
        <button class="btn btn-primary flex-fill" ng-click="addToCart()">
          <i class="bi bi-cart-plus-fill me-1"></i> Tambah ke Keranjang
        </button>
        <button class="btn btn-success flex-fill" ng-click="checkoutNow()">
          <i class="bi bi-credit-card-fill me-1"></i> Beli Sekarang
        </button>
      </div>
    </div>
  </div>
</div>


<style>
  /* Pastikan tombol size dan color aktif tampil jelas */
  .btn-outline-primary.active,
  .btn-outline-secondary.active {
    color: #fff !important;
    background-color: #0d6efd !important;
    /* Bootstrap primary color */
    border-color: #0d6efd !important;
  }

  /* Responsive ukuran input jumlah */
  @media (max-width: 576px) {
    .w-sm-25 {
      width: 100% !important;
    }
  }
</style>

<?= $this->endSection() ?>