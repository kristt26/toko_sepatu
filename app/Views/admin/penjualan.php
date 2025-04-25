<?= $this->extend('layout/admin') ?>
<?= $this->section('content') ?>
<div class="div" ng-controller="penjualanController">
    <div class="row">
        <div class="col-md-12">

            <!-- 🔍 Pencarian Produk -->
            <div class="kasir-card">
                <div class="section-title">Pencarian Produk</div>
                <div class="form-row">
                    <!-- Pencarian Nama / Kode Produk -->
                    <div class="col-md-4 mb-2">
                        <div class="form-control-search">
                            <input type="text" class="form-control" ng-model="cari" ng-change="check(cari, ukuran)" placeholder="Cari nama atau kode sepatu...">
                            <i class="fas fa-search"></i>
                        </div>
                    </div>

                    <!-- Pencarian Ukuran -->
                    <div class="col-md-2 mb-2">
                        <input type="number" class="form-control" ng-model="ukuran" ng-change="check(cari, ukuran)" placeholder="Cari ukuran (misal: 42)">
                    </div>
                </div>
            </div>

            <!-- 📦 Daftar Produk -->
            <div class="kasir-card">
                <div class="section-title">Daftar Produk</div>
                <table class="table table-hover table-sm">
                    <thead>
                        <tr>
                            <th>Nama Sepatu</th>
                            <th>Ukuran</th>
                            <th>Warna</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr ng-repeat="item in dataFilter track by $index">
                            <td>{{item.nama_produk}}</td>
                            <td>{{item.ukuran}}</td>
                            <td>{{item.warna}}</td>
                            <td>{{item.harga | currency}}</td>
                            <td>{{item.stok}}</td>
                            <td><button class="btn btn-outline-success" ng-click="keranjang(item)">Tambah</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- 🛒 Keranjang Belanja -->
            <div class="kasir-card">
                <div class="section-title">Keranjang Belanja</div>
                <table class="table table-bordered table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Qty</th>
                            <th>Subtotal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <tr ng-repeat="item in dataKeranjang track by $index">
                            <td>{{item.nama_produk}}</td>
                            <td>{{item.harga | currency}}</td>
                            <td><input type="number" class="form-control" ng-model="item.qty"></td>
                            <td>{{item.harga * item.qty | currency}}</td>
                            <td><button class="btn btn-outline-danger" ng-click="removeItem(item)">Hapus</button></td>
                        </tr>
                    </tbody>
                </table>
                <div class="text-right total-area mt-3">
                    <div>Total: <strong>Rp 620.000</strong></div>
                    <button class="btn btn-success mt-2">Bayar Sekarang</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="modal fade" id="modals-default">
            <div class="modal-dialog">
                <form class="modal-content" ng-submit="save(model)">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Pembelian</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Produk</label>
                            <input type="text" id="namaProduk" class="form-control" readonly value="Sepatu Nike Air Max">
                        </div>
                        <div class="form-group">
                            <label>Harga Satuan</label>
                            <input type="text" id="hargaProduk" class="form-control" readonly value="Rp 720.000">
                        </div>

                        <!-- Input Jumlah -->
                        <div class="form-group">
                            <label>Jumlah (Qty)</label>
                            <input type="number" id="jumlahProduk" class="form-control" min="1" value="1">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<style>
    .kasir-card {
        background: #fff;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        margin-bottom: 30px;
    }

    .section-title {
        font-size: 1.3rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 20px;
        border-bottom: 2px solid #007bff;
        display: inline-block;
        padding-bottom: 5px;
    }

    .form-control-search {
        position: relative;
    }

    .form-control-search input {
        padding-right: 40px;
    }

    .form-control-search .fa-search {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #aaa;
    }

    .table thead {
        background-color: #e9ecef;
    }

    .btn-outline-success {
        transition: 0.2s;
    }

    .btn-outline-success:hover {
        background-color: #28a745;
        color: #fff;
    }

    .total-area {
        font-size: 1.2rem;
    }
</style>
<?= $this->endSection() ?>