<?= $this->extend('layout/info') ?>
<?= $this->section('content') ?>

<div ng-controller="checkoutController" ng-cloak>
  <div class="container py-5" ng-show="tampil== 'checkout'">
    <h1 class="mb-4 text-center">Checkout</h1>
    <div class="row">
      <!-- Detail Produk -->
      <div class="col-md-8">
        <div class="card mb-4">
          <div class="card-header bg-warning text-white">
            <h5>Detail Produk</h5>
          </div>
          <div class="card-body">
            <div class="d-flex align-items-center mb-3" ng-repeat="item in datas">
              <img src="/assets/gambar/{{item.gambar}}" alt="{{item.nama_produk}}" class="img-thumbnail me-3" style="width: 100px; height: 100px;">
              <div>
                <h5 class="mb-1">{{item.nama_produk}}</h5>
                <p class="mb-1">Ukuran: {{item.ukuran}} | Warna: {{item.warna}}</p>
                <p class="mb-0">Jumlah: {{item.qty}} | Harga: {{item.harga | currency:'Rp. '}}</p>
              </div>
              <div class="ms-auto d-flex align-items-center">
                <p class="text-danger me-3 mb-0">{{item.qty * item.harga | currency:'Rp. '}}</p>
                <input type="checkbox" class="form-check-input" ng-model="item.selected" ng-change="updateTotal()">
              </div>
            </div>
            <hr>
            <h5 class="text-end">Biaya Pengiriman: <strong>{{model.shippingCost | currency:'Rp. '}}</strong></h5>
            <h5 class="text-end">Total: <strong>{{calculateTotal() + model.shippingCost | currency:'Rp. '}}</strong></h5>
          </div>
        </div>
      </div>

      <!-- Form Pembayaran -->
      <div class="col-md-4">
        <div class="card">
          <div class="card-header bg-success text-white">
            <h5>Informasi Pembayaran</h5>
          </div>
          <div class="card-body">
            <form ng-submit="processCheckout()">
              <div class="mb-3">
                <label for="name" class="form-label">Nama Lengkap</label>
                <input type="text" id="name" class="form-control" ng-model="model.nama" required>
              </div>
              <div class="mb-3">
                <label for="phone" class="form-label">Nomor Telepon</label>
                <input type="text" id="phone" class="form-control" ng-model="model.phone" required>
              </div>
              <div class="mb-3">
                <label for="address" class="form-label">Alamat Pengiriman</label>
                <textarea id="address" class="form-control" ng-model="model.alamat_pengiriman" rows="3" required></textarea>
              </div>
              <div class="mb-3">
                <label for="area" class="form-label">Area Pengiriman</label>
                <select id="area" class="form-select" ng-model="model.area" ng-change="updateShippingCost()" required>
                  <option value="" disabled selected>Pilih Area</option>
                  <option ng-repeat="area in areas" value="{{area.id_area}}">{{area.nama_area}} - {{area.harga_kirim | currency:'Rp. '}}</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="payment" class="form-label">Metode Pembayaran</label>
                <select id="payment" class="form-select" ng-model="model.paymentMethod" required>
                  <option value="Transfer">Transfer Bank</option>
                  <option value="COD">Bayar di Tempat (COD)</option>
                </select>
              </div>
              <button type="submit" class="btn btn-success w-100">Proses Checkout</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container py-5">
    <div class="text-center mb-5">
      <h1 class="fw-bold">📦 Informasi Pesanan</h1>
      <p class="text-muted">Terima kasih telah berbelanja di toko kami! Berikut adalah detail pesanan Anda.</p>
    </div>

    <!-- Progress Status -->
    <div class="mb-5">
      <div class="progress" style="height: 20px;">
        <div class="progress-bar bg-success" role="progressbar" style="width: {{order.status === 'Dibayar' ? '50%' : (order.status === 'Dikirim' ? '100%' : '20%')}};">
          {{order.status}}
        </div>
      </div>
    </div>

    <div class="row">
      <!-- Informasi Pelanggan -->
      <div class="col-md-6">
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-header bg-gradient bg-primary text-white rounded-top">
            <h5 class="mb-0">👤 Informasi Pelanggan</h5>
          </div>
          <div class="card-body">
            <p><strong>Nama:</strong> {{order.name}}</p>
            <p><strong>Alamat:</strong> {{order.address}}</p>
            <p><strong>Area:</strong> {{order.area}}</p>
            <p><strong>Telepon:</strong> {{order.phone}}</p>
            <p><strong>Pembayaran:</strong>
              <span class="badge rounded-pill" ng-class="{'bg-success': order.paymentMethod === 'cod', 'bg-info': order.paymentMethod === 'transfer'}">
                {{order.paymentMethod === 'cod' ? 'COD' : 'Transfer Bank'}}
              </span>
            </p>
            <p><strong>Status:</strong>
              <span class="badge bg-secondary">{{order.status}}</span>
            </p>
          </div>
        </div>
      </div>

      <!-- Ringkasan Pesanan -->
      <div class="col-md-6">
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-header bg-gradient bg-warning text-white rounded-top">
            <h5 class="mb-0">💳 Ringkasan Pesanan</h5>
          </div>
          <div class="card-body">
            <p><strong>Biaya Kirim:</strong> Rp {{order.shippingCost | number}}</p>
            <p><strong>Total Bayar:</strong> <span class="text-danger fw-bold">Rp {{order.total | number}}</span></p>

            <!-- Info Rekening -->
            <div class="mt-4 p-3 border rounded bg-light">
              <h6 class="mb-3">Transfer ke:</h6>
              <p class="mb-1">🏦 <strong>Bank BRI</strong></p>
              <p class="mb-1">No. Rek:
                <strong id="rekNumber">1234 5678 9012 3456</strong>
                <button type="button" class="btn btn-sm btn-outline-secondary ms-2" onclick="copyRek()">Copy</button>
              </p>
              <p class="mb-0">a.n. <strong>Nama Pemilik Rekening</strong></p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Detail Produk -->
    <div class="card border-0 shadow-sm mb-4">
      <div class="card-header bg-gradient bg-secondary text-white rounded-top">
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
              </tr>
            </thead>
            <tbody>
              <tr ng-repeat="item in order.items">
                <td class="text-center">
                  <img src="/assets/gambar/{{item.gambar}}" alt="{{item.nama_produk}}" class="img-thumbnail rounded" style="width: 80px; height: 80px;">
                </td>
                <td>{{item.nama_produk}}</td>
                <td>{{item.ukuran}}</td>
                <td>{{item.warna}}</td>
                <td>{{item.qty}}</td>
                <td>Rp {{item.harga | number}}</td>
                <td>Rp {{item.qty * item.harga | number}}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Upload Bukti Transfer -->
    <div class="card border-0 shadow-sm mb-4">
      <div class="card-header bg-gradient bg-info text-white rounded-top">
        <h5 class="mb-0">📤 Unggah Bukti Transfer</h5>
      </div>
      <div class="card-body">
        <form ng-submit="uploadProof()">
          <div class="mb-3">
            <label for="proof" class="form-label">Bukti Pembayaran</label>
            <input type="file" id="proof" class="form-control" file-model="order.paymentProof" required>
          </div>
          <button type="submit" class="btn btn-info w-100">Kirim Bukti</button>
        </form>
      </div>
    </div>

    <!-- Tombol Kembali -->
    <div class="text-center mt-4">
      <a href="/" class="btn btn-primary btn-lg rounded-pill">
        <i class="bi bi-arrow-left-circle me-2"></i>Beranda
      </a>
    </div>
  </div>

  <style>
    .text-muted{
      color: rgb(255 146 65 / 75%) !important;
    }
  </style>

  <script>
    function copyRek() {
      const text = document.getElementById('rekNumber').innerText;
      navigator.clipboard.writeText(text);
      alert('No Rekening disalin!');
    }
  </script>
</div>

<?= $this->endSection() ?>