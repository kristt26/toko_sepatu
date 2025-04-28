<?= $this->extend('layout/info') ?>
<?= $this->section('content') ?>

<div class="container py-5" ng-controller="detailController" ng-cloak>
  <div class="row">
    <!-- Gambar Produk -->
    <div class="col-md-6">
      <img src="/assets/gambar/{{datas.variant[0].gambar}}" alt="{{datas.nama_produk}}" class="img-fluid rounded">
    </div>

    <!-- Detail Produk -->
    <div class="col-md-6">
      <h1 class="mb-3">{{datas.nama_produk}}</h1>
      <h4 class="text-danger mb-3">Rp {{datas.harga | number}}</h4>
      <p class="mb-4">{{datas.keterangan}}</p>

      <!-- Stok Tersedia -->
      <p class="text-success mb-4">Stok Tersedia: {{selectedSize && selectedColor && (totalStock == null || totalStock <=0) ? 'Habis' : totalStock}}</p>

      <!-- Pilihan Variant -->
      <div class="mb-3">
        <label class="form-label">Pilih Ukuran:</label>
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
        <label class="form-label">Pilih Warna:</label>
        <div class="d-flex gap-2 flex-wrap">
          <button type="button" class="btn btn-outline-secondary" 
                  ng-class="{'active': selectedColor === variant.warna}" 
                  ng-repeat="variant in datas.variant | unique:'warna'" 
                  ng-click="selectColor(variant.warna, variant.ukuran)">
            {{variant.warna}}
          </button>
        </div>
      </div>

      <!-- Input Kuantitas -->
      <div class="mb-3">
        <label class="form-label">Jumlah:</label>
        <input type="number" class="form-control w-25" ng-model="quantity" min="1" placeholder="1">
      </div>

      <!-- Tombol Aksi -->
      <div class="d-flex gap-3">
        <button class="btn btn-primary" ng-click="addToCart()">
          <i class="bi bi-cart-plus-fill me-1"></i> Tambah ke Keranjang
        </button>
        <button class="btn btn-success" ng-click="checkoutNow()">
          <i class="bi bi-credit-card-fill me-1"></i> Beli Sekarang
        </button>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>