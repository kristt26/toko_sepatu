<?= $this->extend('layout/info') ?>
<?= $this->section('content') ?>
<div class="container py-5" ng-controller="detailPesananController" ng-cloak>
  <!-- Tab Navigation (hanya untuk mobile) -->
  <ul class="nav nav-tabs d-md-none mb-4" id="orderTabs" role="tablist">
    <li class="nav-item">
      <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#infoTab" type="button" role="tab">Informasi</button>
    </li>
    <li class="nav-item">
      <button class="nav-link" id="produk-tab" data-bs-toggle="tab" data-bs-target="#produkTab" type="button" role="tab">Produk</button>
    </li>
    <li class="nav-item" ng-if="datas.order.pembayaran.metode_bayar === 'Transfer' && datas.order.status !== 'Batal' && datas.order.status !== 'Paid'">
      <button class="nav-link" id="upload-tab" data-bs-toggle="tab" data-bs-target="#uploadTab" type="button" role="tab">Upload Bukti</button>
    </li>
  </ul>

  <!-- Tab Content (mobile) & Full Display (desktop) -->
  <div class="tab-content" id="orderTabContent">
    <!-- Tab 1: Informasi Pelanggan + Ringkasan -->
    <div class="tab-pane fade show active d-md-block" id="infoTab" role="tabpanel">
      <div class="text-center mb-5">
        <h1 class="fw-bold text-warning">📦 Informasi Pesanan</h1>
        <p class="text-muted">Terima kasih telah berbelanja di <strong class="text-white">Snikers Jayapura</strong>! Berikut detail pesanan Anda.</p>
      </div>
      <div class="d-flex justify-content-between align-items-center bg-dark text-white p-3 rounded mb-4 shadow-sm">
        <div>
          <p class="mb-1"><strong>No. Pesanan:</strong> {{datas.order.kode_order}}</p>
          <p class="mb-0"><strong>Tanggal:</strong> {{datas.order.tanggal_order | date:'dd-MM-yyyy'}}</p>
        </div>
        <div>
          <span class="badge rounded-pill"
            ng-class="{
              'bg-secondary': datas.order.status === 'Pending',
              'bg-warning': datas.order.status === 'Paid',
              'bg-info': datas.order.status === 'Proses',
              'bg-success': datas.order.status === 'Terkirim',
              'bg-danger': datas.order.status === 'Batal'
            }">{{datas.order.status}}</span>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-gradient bg-primary text-white">
              <h5 class="mb-0">👤 Informasi Pelanggan</h5>
            </div>
            <div class="card-body">
              <p><strong>Nama:</strong> {{datas.customer.nama}}</p>
              <p><strong>Alamat:</strong> {{datas.customer.alamat}}</p>
              <p><strong>Area:</strong> {{datas.order.nama_area}}</p>
              <p><strong>Telepon:</strong> {{datas.customer.phone}}</p>
              <p><strong>Pembayaran:</strong>
                <span class="badge" ng-class="{'bg-success': datas.order.pembayaran.metode_bayar === 'COD', 'bg-info': datas.order.pembayaran.metode_bayar === 'Transfer'}">
                  {{datas.order.pembayaran.metode_bayar == 'COD' ? 'COD' : 'Transfer Bank'}}
                </span>
              </p>
              <p><strong>Status:</strong> <span class="badge bg-secondary">{{datas.order.status}}</span></p>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-gradient bg-warning text-dark">
              <h5 class="mb-0">💳 Ringkasan Pesanan</h5>
            </div>
            <div class="card-body">
              <p><strong>Biaya Kirim:</strong> Rp {{datas.order.harga_kirim | number}}</p>
              <p><strong>Total Bayar:</strong>
                <span class="text-info fw-bold">Rp {{convert(datas.order.total) + convert(datas.order.harga_kirim) | number}}</span>
                <button class="btn btn-sm btn-outline-secondary ms-2" ng-click="copyRek(convert(datas.order.total) + convert(datas.order.harga_kirim))">Copy</button>
              </p>
              <div class="mt-4 p-3 border rounded bg-light">
                <h6>Transfer ke:</h6>
                <p>🏦 <strong>{{datas.toko.bank}}</strong></p>
                <p>No. Rekening:
                  <strong id="rekNumber">{{datas.toko.rekening}}</strong>
                  <button class="btn btn-sm btn-outline-secondary ms-2" ng-click="copyRek(datas.toko.rekening)">Copy</button>
                </p>
                <p>a.n. <strong>{{datas.toko.nama_rekening}}</strong></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Tab 2: Produk -->
    <div class="tab-pane fade d-md-block" id="produkTab" role="tabpanel">
      <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-gradient bg-secondary text-white">
          <h5 class="mb-0">🛒 Detail Produk</h5>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table align-middle table-hover">
              <thead class="table-light">
                <tr>
                  <th>Gambar</th>
                  <th>Produk</th>
                  <th>Ukuran</th>
                  <th>Warna</th>
                  <th>Qty</th>
                  <th>Harga</th>
                  <th>Subtotal</th>
                  <th ng-if="datas.order.status=='Selesai'">Review</th>
                </tr>
              </thead>
              <tbody>
                <tr ng-repeat="item in datas.order.detail">
                  <td class="text-center">
                    <img src="/assets/gambar/{{item.gambar}}" alt="{{item.nama_produk}}" class="img-thumbnail rounded" style="width: 80px; height: 80px;">
                  </td>
                  <td>{{item.nama_produk}}</td>
                  <td>{{item.ukuran}}</td>
                  <td>{{item.warna}}</td>
                  <td>{{item.qty}}</td>
                  <td>Rp {{item.harga | number}}</td>
                  <td>Rp {{item.qty * item.harga | number}}</td>
                  <td>
                    <button ng-if="!item.review" ng-click="showReview(item)" class="btn btn-info btn-sm"><i class="fas fa-comment"></i></button>
                    <h6 ng-if="item.review">Sudah Review</h6>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Tab 3: Upload Bukti -->
    <div class="tab-pane fade d-md-block"
      ng-if="datas.order.pembayaran.metode_bayar === 'Transfer' && datas.order.status !== 'Batal' && datas.order.status !== 'Paid'"
      id="uploadTab" role="tabpanel">
      <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-gradient bg-info text-white d-flex justify-content-between align-items-center">
          <h5 class="mb-0">📤 Unggah Bukti Transfer</h5>
          <button type="submit" form="formProof" class="btn btn-light btn-sm text-info fw-semibold">
            Kirim Bukti
          </button>
        </div>
        <div class="card-body">
          <form id="formProof" ng-submit="uploadProof()">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">Bukti Pembayaran</label>
                <input type="file" class="form-control" accept="image/*" ng-model="model.berkas" base-sixty-four-input>
                <img ng-show="model.id && !model.berkas" class="img-fluid mt-2" style="border: 5px solid #555" ng-src="<?= base_url() ?>/gambar/{{model.gambar}}" width="30%">
                <img ng-show="model.berkas" class="img-fluid mt-2" style="border: 5px solid #555" data-ng-src="data:{{model.berkas.filetype}};base64,{{model.berkas.base64}}" width="30%">
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Tanggal Transfer</label>
                <input type="datetime-local" class="form-control" ng-model="model.tanggal_bayar" required>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Tombol kembali -->
  <div class="text-center mt-4">
    <a href="/" class="btn btn-outline-warning btn-lg rounded-pill">
      <i class="bi bi-arrow-left-circle me-2"></i>Beranda
    </a>
  </div>


  <div class="modal fade" id="review" tabindex="-1" aria-labelledby="reviewLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-dark" id="reviewLabel">Review Produk {{itemReview.nama_produk}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form ng-submit="submitReview()">
          <div class="modal-body">
            <div class="text-dark">
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
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">CLose</button>
            <button type="submit" class="btn btn-primary btn-sm">Simpan Komentar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>




<!-- Custom Style -->
<style>
  .text-muted {
    color: rgba(255, 255, 255, 0.6) !important;
  }

  @media (min-width: 768px) {
    .tab-content>.tab-pane {
      display: block !important;
      opacity: 1 !important;
    }
  }

  .table th {
    background-color: #000;
    color: #f4c10f;
  }

  .table td {
    background-color: #1e1e1e;
    color: #eee;
  }

  .badge {
    font-size: 0.9rem;
  }
</style>

<!-- Copy Rekening -->
<script>
  function copyRek(value) {
    const temp = document.createElement("textarea");
    temp.value = value;
    document.body.appendChild(temp);
    temp.select();
    document.execCommand("copy");
    document.body.removeChild(temp);
    alert("Disalin ke clipboard!");
  }
</script>
<?= $this->endSection() ?>