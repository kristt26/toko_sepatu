<?= $this->extend('layout/info') ?>
<?= $this->section('content') ?>

<div ng-controller="detailPesananController" ng-cloak>
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="fw-bold">📦 Informasi Pesanan</h1>
            <p class="text-muted">Terima kasih telah berbelanja di toko kami! Berikut adalah detail pesanan Anda.</p>
        </div>
    
        <!-- <div class="mb-5">
            <div class="progress" style="height: 20px;">
                <div class="progress-bar bg-success" role="progressbar" style="width: {{order.status === 'Dibayar' ? '50%' : (order.status === 'Dikirim' ? '100%' : '20%')}};">
                    {{order.status}}
                </div>
            </div>
        </div> -->
    
        <div class="row">
            <!-- Informasi Pelanggan -->
            <div class="col-md-6">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-gradient bg-primary text-white rounded-top">
                        <h5 class="mb-0">👤 Informasi Pelanggan</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Nama:</strong> {{datas.profile.nama}}</p>
                        <p><strong>Alamat:</strong> {{datas.profile.alamat}}</p>
                        <p><strong>Area:</strong> {{datas.order.area}}</p>
                        <p><strong>Telepon:</strong> {{datas.profile.phone}}</p>
                        <p><strong>Pembayaran:</strong>
                            <span class="badge rounded-pill" ng-class="{'bg-success': datas.order.pembayaran.metode_bayar === 'COD', 'bg-info': datas.order.pembayaran.metode_bayar === 'Transfer'}">
                                {{datas.order.pembayaran.metode_bayar === 'COD' ? 'COD' : 'Transfer Bank'}}
                            </span>
                        </p>
                        <p><strong>Status:</strong>
                            <span class="badge bg-secondary">{{datas.order.status}}</span>
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
                        <p><strong>Biaya Kirim:</strong> Rp {{datas.order.ongkir | number}}</p>
                        <p><strong>Total Bayar:</strong> <span class="text-danger fw-bold">Rp {{datas.order.total | number}}</span></p>
    
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
                            <tr ng-repeat="item in datas.order.detailPesanan">
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
        .text-muted {
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