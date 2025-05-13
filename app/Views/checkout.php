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