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
                            <input type="text" class="form-control" id="area" ng-model="model.nama_area" placeholder="Masukkan Nama Area" required>
                        </div>
                        <div class="form-group">
                            <label for="area">Harga Kirim</label>
                            <input type="text" class="form-control" id="area" ng-model="model.harga_kirim" placeholder="Masukkan Harga Pengiriman" required mask-currency="'Rp. '" config="{group:'.',decimalSize:'0',indentation:' ',decimal:''}">
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
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Service Area</th>
                                    <th>Harga Pengiriman</th>
                                    <th width="20%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in datas track by $index">
                                    <td>{{$index+1}}</td>
                                    <td>{{item.nama_area}}</td>
                                    <td>{{item.harga_kirim | currency: 'Rp. '}}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" ng-click="edit(item)">Edit</button>
                                        <button type="button" class="btn btn-danger" ng-click="delete(item)">Delete</button>
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