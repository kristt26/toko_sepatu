<?= $this->extend('layout/admin') ?>
<?= $this->section('content') ?>
<div class="div" ng-controller="penjualanController">
    <div class="row">
        <div class="col-md-12" ng-show="tampil=='daftar'">

            <!-- 📦 Daftar Produk -->
            <div class="kasir-card">
                <div class="section-title">Daftar Produk</div>
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
                        </tr>
                    </thead>
                    <tbody>

                        <tr ng-repeat="item in dataKeranjang track by $index">
                            <td>{{item.nama_produk + " Size " + item.ukuran + " Color " + item.warna}}</td>
                            <td>{{item.harga | currency}}</td>
                            <td><input type="number" class="form-control" ng-model="item.qty" ng-change="setJumlah(item)"></td>
                            <td>{{item.harga * item.qty | currency}}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="text-right total-area mt-3">
                    <div>Total: <strong>{{totalBayar | currency}}</strong></div>
                    <button class="btn btn-success mt-2" ng-click="setTampilan('bayar')" ng-disabled="totalBayar==0">Bayar Sekarang</button>
                </div>
            </div>
        </div>
        <div class="col-md-12" ng-show="tampil=='bayar'">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Pembayaran</h5>
                </div>
                <div class="card-body">
                    <form id="formPembayaran" ng-submit="save()">
                        <div class="form-group">
                            <label>Total Belanja</label>
                            <input type="text" id="total" class="form-control" ng-model="totalBayar" mask-currency="'Rp. '" config="{group:'.',decimalSize:'0',indentation:' '}" readonly>

                        </div>

                        <div class="form-group">
                            <label>Uang Pembeli</label>
                            <input type="text" id="total" class="form-control" ng-model="uang" mask-currency="'Rp. '" config="{group:'.',decimalSize:'0',indentation:' ',decimal:''}" ng-change="setKembalian(uang)" placeholder="Masukkan Uang Pembeli" required>
                        </div>

                        <div class="form-group">
                            <label>Kembalian</label>
                            <input type="text" id="kembalian" ng-model="kembalian" mask-currency="'Rp. '" config="{group:'.',decimalSize:'0',indentation:' ',decimal:''}" class="form-control" readonly>
                        </div>

                        <button type="submit" class="btn btn-success btn-block" ng-disabled="uang<totalBayar || !uang">Selesaikan Pembayaran</button>
                        <button type="button" class="btn btn-secondary btn-block" ng-click="batal()">Batal</button>
                    </form>
                </div>
                <div id="struk">
                    <h5>Struk Pembayaran</h5>
                    <p>Tanggal: <span id="tanggal"></span></p>
                    <p>Total Belanja: <span id="struk-total"></span></p>
                    <p>Uang Pembeli: <span id="struk-uang"></span></p>
                    <p>Kembalian: <span id="struk-kembalian"></span></p>
                    <hr>
                    <p class="text-center">Terima kasih telah berbelanja!</p>
                </div>

                <div class="text-center">
                    <button class="btn btn-primary btn-cetak" onclick="window.print()">Cetak Struk</button>
                </div>
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

    /* .card {
        max-width: 500px;
        margin: 40px auto;
    } */

    #struk {
        display: none;
        max-width: 500px;
        margin: 20px auto;
        background-color: #fff;
        padding: 20px;
        border: 1px solid #ddd;
    }

    #struk h5 {
        text-align: center;
        margin-bottom: 20px;
    }

    .btn-cetak {
        display: inline-block;
        margin-top: 10px;
    }

    @media print {
        body * {
            visibility: hidden;
        }

        #struk,
        #struk * {
            visibility: visible;
            display: block;
        }

        #struk {
            position: absolute;
            left: 0;
            top: 0;
        }
    }
</style>
<?= $this->endSection() ?>