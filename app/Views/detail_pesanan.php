<?= $this->extend('layout/info') ?>
<?= $this->section('content') ?>
<div ng-controller="detailPesananController">
    <div class="container py-5">

        <!-- Judul -->
        <div class="text-center mb-5">
            <h1 class="fw-bold text-warning">📦 Informasi Pesanan</h1>
            <p class="text-muted">Terima kasih telah berbelanja di <strong class="text-white">Snikers Jayapura</strong>! Berikut detail pesanan Anda.</p>
        </div>


        <!-- Informasi Order -->
        <!-- Informasi Order Ringkas -->
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
              }">
                    {{datas.order.status}}
                </span>
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
                        <p><strong>Nama:</strong> {{datas.customer.nama}}</p>
                        <p><strong>Alamat:</strong> {{datas.customer.alamat}}</p>
                        <p><strong>Area:</strong> {{datas.order.nama_area}}</p>
                        <p><strong>Telepon:</strong> {{datas.customer.phone}}</p>
                        <p><strong>Pembayaran:</strong>
                            <span class="badge rounded-pill" ng-class="{'bg-success': datas.order.pembayaran.metode_bayar === 'COD', 'bg-info': datas.order.pembayaran.metode_bayar === 'Transfer'}">
                                {{datas.order.pembayaran.metode_bayar === 'cod' ? 'COD' : 'Transfer Bank'}}
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
                    <div class="card-header bg-gradient bg-warning text-dark rounded-top">
                        <h5 class="mb-0">💳 Ringkasan Pesanan</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Biaya Kirim:</strong> Rp {{datas.order.harga_kirim | number}}</p>
                        <p>
                            <strong>Total Bayar:</strong> <span class="text-info fw-bold">Rp {{convert(datas.order.total) + convert(datas.order.harga_kirim) | number}}</span>
                            <button type="button" class="btn btn-sm btn-outline-secondary ms-2" ng-click="copyRek(convert(datas.order.total) + convert(datas.order.harga_kirim))">Copy</button>
                        </p>

                        <!-- Info Rekening -->
                        <div class="mt-4 p-3 border rounded bg-light">
                            <h6 class="mb-3">Transfer ke:</h6>
                            <p class="mb-1">🏦 <strong>{{datas.toko.bank}}</strong></p>
                            <p class="mb-1">No. Rek:
                                <strong id="rekNumber">{{datas.toko.rekening}}</strong>
                                <button type="button" class="btn btn-sm btn-outline-secondary ms-2" ng-click="copyRek(datas.toko.rekening)">Copy</button>
                            </p>
                            <p class="mb-0">a.n. <strong>{{datas.toko.nama_rekening}}</strong></p>
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
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Upload Bukti Transfer -->
        <div class="card border-0 shadow-sm mb-4" ng-if="datas.order.pembayaran.metode_bayar == 'Transfer' && (datas.order.status !='Batal' && datas.order.status !='Paid')">
            <div class="card-header bg-gradient bg-info text-white rounded-top d-flex justify-content-between align-items-center">
                <h5 class="mb-0">📤 Unggah Bukti Transfer</h5>
                <button type="submit" form="formProof" class="btn btn-light btn-sm text-info fw-semibold">
                    Kirim Bukti
                </button>
            </div>
            <div class="card-body">
                <form id="formProof" ng-submit="uploadProof()">
                    <div class="row">
                        <!-- Input Bukti Pembayaran -->
                        <div class="col-md-6 mb-3">
                            <label for="proof" class="form-label">Bukti Pembayaran</label>
                            <input type="file" class="form-control" id="customFile" accept="image/*" ng-model="model.berkas" base-sixty-four-input>
                            <img ng-show="model.id && !model.berkas" class="img-fluid" style="border: 5px solid #555" ng-src="<?= base_url() ?>/gambar/{{model.gambar}}" width="30%">
                            <img ng-show="model.berkas" class="img-fluid" style="border: 5px solid #555" data-ng-src="data:{{model.berkas.filetype}};base64,{{model.berkas.base64}}" width="30%">
                            <div class="clearfix"></div>
                        </div>

                        <!-- Input Tanggal Transfer -->
                        <div class="col-md-6 mb-3">
                            <label for="transferDate" class="form-label">Tanggal Transfer</label>
                            <input type="datetime-local" id="transferDate" class="form-control" ng-model="model.tanggal_bayar" required>
                        </div>
                    </div>
                </form>
            </div>
        </div>



        <!-- Tombol Kembali -->
        <div class="text-center mt-4">
            <a href="/" class="btn btn-outline-warning btn-lg rounded-pill">
                <i class="bi bi-arrow-left-circle me-2"></i>Beranda
            </a>
        </div>
    </div>

    <style>
        .text-muted {
            color: rgba(255, 255, 255, 0.6) !important;
        }

        .progress-bar {
            font-weight: bold;
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