<?= $this->extend('layout/info') ?>
<?= $this->section('content') ?>

<div class="container py-5" ng-controller="detailController" ng-cloak>
  <div class="row">
    <!-- Kolom Gambar dan Deskripsi (Mobile) -->
    <div class="col-md-6">
      <img src="/assets/gambar/{{datas.variant[0].gambar}}" alt="{{datas.nama_produk}}" class="img-fluid rounded mb-3">

      <!-- Tabs di mobile -->
      <ul class="nav nav-tabs d-md-none mb-3" id="productTab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="desc-tab" data-bs-toggle="tab" data-bs-target="#desc" type="button" role="tab">Deskripsi</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="order-tab" data-bs-toggle="tab" data-bs-target="#order" type="button" role="tab">Pesan</button>
        </li>
      </ul>

      <div class="tab-content d-md-none" id="productTabContent">
        <div class="tab-pane fade show active" id="desc" role="tabpanel" ng-bind-html="datas.keterangan"></div>
        <div class="tab-pane fade" id="order" role="tabpanel">
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

      <p class="mt-3 d-none d-md-block" ng-bind-html="datas.keterangan"></p>
    </div>

    <!-- Kolom Detail (Desktop) -->
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

  <!-- ULASAN PRODUK -->
  <hr class="mt-5 mb-4">
  <h4>Ulasan Pengguna</h4>

  <!-- Form Ulasan -->
  <form ng-submit="submitReview()" class="mb-4">
    <div class="mb-3">
      <label class="form-label">Rating:</label>
      <div class="rating-input">
        <i class="fa-star" ng-class="{'fas': newReview.rating >= 1, 'far': newReview.rating < 1}" ng-click="newReview.rating = 1"></i>
        <i class="fa-star" ng-class="{'fas': newReview.rating >= 2, 'far': newReview.rating < 2}" ng-click="newReview.rating = 2"></i>
        <i class="fa-star" ng-class="{'fas': newReview.rating >= 3, 'far': newReview.rating < 3}" ng-click="newReview.rating = 3"></i>
        <i class="fa-star" ng-class="{'fas': newReview.rating >= 4, 'far': newReview.rating < 4}" ng-click="newReview.rating = 4"></i>
        <i class="fa-star" ng-class="{'fas': newReview.rating >= 5, 'far': newReview.rating < 5}" ng-click="newReview.rating = 5"></i>
      </div>
    </div>



    <div class="mb-2">
      <label class="form-label">Komentar:</label>
      <textarea class="form-control" ng-model="newReview.komentar" rows="3" required></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Kirim Ulasan</button>
  </form>

  <!-- Tampilkan Review & Balasan -->
  <!-- Tampilkan Review & Balasan -->
  <!-- Tampilkan Review & Balasan -->
  <div class="mb-5" ng-repeat="review in reviews">
    <div class="border rounded p-3 mb-2">
      <div class="mb-1 d-flex justify-content-between align-items-center">
        <strong>{{review.user}}</strong>
        <small class="text-white">{{review.created_at | waktuLalu}}</small>
      </div>

      <span class="rating-display text-warning mb-1 d-block">
        <i ng-repeat="i in [1,2,3,4,5]" class="fa-star" ng-class="{'fas': i <= review.rating, 'far': i > review.rating}"></i>
      </span>

      <p class="mb-1">{{review.komentar}}</p>

      <!-- Tombol balas -->
      <button class="btn btn-link p-0 small text-decoration-none" ng-click="toggleReplyForm(review.id)">Balas</button>

      <!-- Form Balas -->
      <form ng-if="replyFormVisible[review.id]" ng-submit="submitReply(review.id)" class="mt-2 ms-4">
        <textarea class="form-control mb-2" ng-model="replyKomentar[review.id]" rows="2" placeholder="Tulis balasan..."></textarea>
        <button type="submit" class="btn btn-sm btn-secondary">Kirim Balasan</button>
      </form>

      <!-- Balasan Review -->
      <div ng-repeat="reply in review.replies" class="ms-4 mt-2 border-start ps-3">
        <div class="d-flex justify-content-between align-items-center">
          <strong>{{reply.user}}</strong>
          <small class="text-white">{{reply.created_at | waktuLalu}}</small>
        </div>
        <p class="mb-1">{{reply.komentar}}</p>
      </div>
    </div>
  </div>



</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/locale/id.min.js"></script>
<style>
  .btn-outline-primary.active,
  .btn-outline-secondary.active {
    color: #fff !important;
    background-color: #0d6efd !important;
    border-color: #0d6efd !important;
  }

  @media (max-width: 576px) {
    .w-sm-25 {
      width: 100% !important;
    }
  }
</style>

<?= $this->endSection() ?>