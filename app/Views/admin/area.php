<?= $this->extend('layout/admin') ?>
<?= $this->section('content') ?>
<div class="div" ng-controller="areaController" ng-cloak>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Input Data</h4>
                </div>
                <form id="formArea" ng-submit="save()">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="area">Nama Area</label>
                            <input type="text" class="form-control" id="area" ng-model="item.nama_area" placeholder="Masukkan Nama Area" required>
                        </div>
                        <div class="form-group">
                            <label for="area">Harga Kirim</label>
                            <input type="text" class="form-control" id="area" ng-model="item.nama_area" placeholder="Masukkan Nama Area" required>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" ng-click="reset()">Reset</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Data Produk</h4>
                    <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modals-default" ng-click="add()">Tambah Produk</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Total Stok</th>
                                    <th>Ketearngan</th>
                                    <th width="20%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in datas track by $index">
                                    <td>{{item.nama_produk}}</td>
                                    <td>{{item.harga | currency: 'Rp. '}}</td>
                                    <td>{{item.total_stok}}</td>
                                    <td>{{item.keterangan}}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" ng-click="edit(item)">Edit</button>
                                        <button type="button" class="btn btn-danger" ng-click="delete(item)">Delete</button>
                                        <button type="button" class="btn btn-info" ng-click="setTampilan(item, 'variant')">Variant</button>
                                    </td>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>