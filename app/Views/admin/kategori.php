<?= $this->extend('layout/admin') ?>
<?= $this->section('content') ?>
<div class="div" ng-controller="kategoriController" ng-cloak>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Input Data</h4>
                </div>
                <form id="formArea" ng-submit="save()">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="kategori">Nama Kategori</label>
                            <input type="text" class="form-control" id="kategori" ng-model="model.nama_kategori" placeholder="Masukkan Nama Kategori" required>
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="genderPria" name="gender" ng-model="model.gender" value="Pria" required>
                                <label class="form-check-label" for="genderPria">Pria</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="genderWanita" name="gender" ng-model="model.gender" value="Wanita">
                                <label class="form-check-label" for="genderWanita">Wanita</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="genderUnisex" name="gender" ng-model="model.gender" value="Unisex">
                                <label class="form-check-label" for="genderUnisex">Unisex</label>
                            </div>
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
                        <table datatable="ng" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kategori</th>
                                    <th>Gender</th>
                                    <th width="20%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in datas track by $index">
                                    <td>{{$index+1}}</td>
                                    <td>{{item.nama_kategori}}</td>
                                    <td>{{item.gender}}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" ng-click="edit(item)">Edit</button>
                                        <button type="button" class="btn btn-danger" ng-click="delete(item)">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>