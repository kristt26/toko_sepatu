<?= $this->extend('layout/admin') ?>
<?= $this->section('content') ?>

<div class="div" ng-controller="laporanPenjualanController" ng-cloak>
    <div class="card">
        <div class="card-body">
            <div class="mb-4">
                <button type="button" class="btn btn-success btn-sm mr-2" ng-click="downloadExcel()">
                    <i class="bi bi-file-earmark-excel-fill"></i> Excel
                </button>
                <button type="button" class="btn btn-secondary btn-sm" ng-click="cetak()">
                    <i class="bi bi-printer-fill"></i> Cetak
                </button>
            </div>
            <form ng-submit="filterLaporan()">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label>Pilih Tipe Periode</label>
                        <select ng-model="filter.tipePeriode" ng-init="filter.tipePeriode='range'" class="form-control" ng-change="resetTanggal()">
                            <option value="range">Rentang Tanggal</option>
                            <option value="bulan">Bulan</option>
                            <option value="tahun">Tahun</option>
                        </select>
                    </div>

                    <div class="form-group col-md-3" ng-if="filter.tipePeriode == 'range'">
                        <label>Rentang Tanggal</label>
                        <input type="text" id="tanggalRange" class="form-control" ng-model="filter.tanggal_range" autocomplete="off" required>
                    </div>

                    <div class="form-group col-md-3" ng-if="filter.tipePeriode == 'bulan'">
                        <label>Pilih Bulan</label>
                        <input type="month" class="form-control" ng-model="filter.bulan_tahun" required>
                    </div>

                    <div class="form-group col-md-3" ng-if="filter.tipePeriode == 'tahun'">
                        <label>Pilih Tahun</label>
                        <input type="number" class="form-control" ng-model="filter.tahun" min="2000" max="2100" required>
                    </div>

                    <div class="form-group col-md-2">
                        <label>Status</label>
                        <select class="form-control" ng-model="filter.status">
                            <option value="">Semua</option>
                            <option value="Pending">Pending</option>
                            <option value="Paid">Paid</option>
                            <option value="Proses">Proses</option>
                            <option value="Selesai">Selesai</option>
                            <option value="Batal">Batal</option>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label>Metode Bayar</label>
                        <select class="form-control" ng-model="filter.metode_bayar">
                            <option value="">Semua</option>
                            <option value="Tunai">Tunai</option>
                            <option value="Transfer">Transfer</option>
                            <option value="COD">COD</option>
                        </select>
                    </div>

                    <div class="form-group col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary btn-block">Tampilkan</button>
                    </div>
                </div>
            </form>

            <div class="table-responsive mt-3">
                <table class="table table-bordered table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Invoice</th>
                            <th>Customer</th>
                            <th>Metode Bayar</th>
                            <th>Status</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="item in laporan track by $index">
                            <td>{{$index + 1}}</td>
                            <td>{{item.tanggal}}</td>
                            <td>{{item.invoice}}</td>
                            <td>{{item.customer}}</td>
                            <td>{{item.metode_bayar && (item.status != 'Pending' || item.status != 'Batal') ? item.metode_bayar : 'Cash on Counter'}}</td>
                            <td>{{item.status}}</td>
                            <td>{{item.total | currency:'Rp. '}}</td>
                        </tr>
                        <tr ng-if="laporan.length === 0">
                            <td colspan="7" class="text-center">Tidak ada data</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap Datepicker -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


<?= $this->endSection() ?>