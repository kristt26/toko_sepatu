<?= $this->extend('layout/info') ?>
<?= $this->section('content') ?>

<div ng-controller="checkoutController" ng-cloak>
  <div class="container py-5">
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
            <h5 class="text-end">Biaya Pengiriman: <strong>{{shippingCost | currency:'Rp. '}}</strong></h5>
            <h5 class="text-end">Total: <strong>{{calculateTotal() + shippingCost | currency:'Rp. '}}</strong></h5>
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
                  <option value="transfer">Transfer Bank</option>
                  <option value="cod">Bayar di Tempat (COD)</option>
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
      <h1 class="fw-bold">Informasi Pesanan</h1>
      <p class="text-muted">Terima kasih telah berbelanja di toko kami! Berikut adalah detail pesanan Anda.</p>
    </div>

    <div class="row">
      <!-- Informasi Pelanggan -->
      <div class="col-md-6">
        <div class="card shadow-sm mb-4">
          <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Informasi Pelanggan</h5>
          </div>
          <div class="card-body">
            <p><strong>Nama Lengkap:</strong> {{order.name}}</p>
            <p><strong>Alamat Pengiriman:</strong> {{order.address}}</p>
            <p><strong>Area Pengiriman:</strong> {{order.area}}</p>
            <p><strong>Nomor Telepon:</strong> {{order.phone}}</p>
            <p><strong>Metode Pembayaran:</strong>
              <span class="badge" ng-class="{'bg-success': order.paymentMethod === 'cod', 'bg-info': order.paymentMethod === 'transfer'}">
                {{order.paymentMethod === 'cod' ? 'Bayar di Tempat (COD)' : 'Transfer Bank'}}
              </span>
            </p>
          </div>
        </div>
      </div>

      <!-- Ringkasan Pesanan -->
      <div class="col-md-6">
        <div class="card shadow-sm mb-4">
          <div class="card-header bg-warning text-white">
            <h5 class="mb-0">Ringkasan Pesanan</h5>
          </div>
          <div class="card-body">
            <p><strong>Biaya Pengiriman:</strong> Rp {{order.shippingCost | number}}</p>
            <p><strong>Total Pembayaran:</strong> <span class="text-danger fw-bold">Rp {{order.total | number}}</span></p>
          </div>
        </div>
      </div>
    </div>

    <!-- Detail Produk -->
    <div class="card shadow-sm mb-4">
      <div class="card-header bg-secondary text-white">
        <h5 class="mb-0">Detail Produk</h5>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead class="table-light">
              <tr>
                <th>Gambar</th>
                <th>Nama Produk</th>
                <th>Ukuran</th>
                <th>Warna</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Subtotal</th>
              </tr>
            </thead>
            <tbody>
              <tr ng-repeat="item in order.items">
                <td class="text-center">
                  <img src="/assets/gambar/{{item.gambar}}" alt="{{item.nama_produk}}" class="img-thumbnail" style="width: 80px; height: 80px;">
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
    <div class="card shadow-sm" ng-if="order.paymentMethod === 'transfer'">
      <div class="card-header bg-info text-white">
        <h5 class="mb-0">Unggah Bukti Transfer</h5>
      </div>
      <div class="card-body">
        <form ng-submit="uploadProof()">
          <div class="mb-3">
            <label for="proof" class="form-label">Unggah Bukti Pembayaran</label>
            <input type="file" id="proof" class="form-control" file-model="order.paymentProof" required>
          </div>
          <button type="submit" class="btn btn-info w-100">Kirim Bukti Pembayaran</button>
        </form>
      </div>
    </div>

    <!-- Tombol Kembali -->
    <div class="text-center mt-4">
      <a href="/" class="btn btn-primary btn-lg">
        <i class="bi bi-arrow-left-circle me-2"></i>Kembali ke Beranda
      </a>
    </div>
  </div>
</div>

<?= $this->endSection() ?>