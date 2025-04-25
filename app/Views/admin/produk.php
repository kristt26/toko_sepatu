<?= $this->extend('layout/admin') ?>
<?= $this->section('content') ?>
<div class="div" ng-controller="produkController" ng-init="init()">
    <div class="row" ng-show="tampil =='produk'">
        <div class="col-lg-12">
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
    <div class="row" ng-show="tampil =='variant'">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Data Variant {{itemProduk.nama_produk}}</h4>
                    <div class="d-flex justify-content-between align-items-center">
                        <button type="button" class="btn btn-primary float-right mr-2" data-toggle="modal" data-target="#modalVariant">Tambah Variant</button>
                        <button type="button" class="btn btn-secondary float-right" ng-click="kembali()">Kembali</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Ukuran</th>
                                    <th>Warna</th>
                                    <th>Stok</th>
                                    <th width="20%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in variant track by $index">
                                    <td>{{item.ukuran}}</td>
                                    <td>{{item.warna}}</td>
                                    <td>{{item.stok}}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" ng-click="editVariant(item)">Edit</button>
                                        <button type="button" class="btn btn-danger" ng-click="deleteVariant(item)">Delete</button>
                                    </td>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="modal fade" id="modals-default">
            <div class="modal-dialog modal-lg">
                <form class="modal-content" ng-submit="save(model)">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Produk</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col">
                                <label class="form-label">Nama Produk</label>
                                <input type="text" class="form-control" placeholder="Nama Produk" ng-model="model.nama_produk" required>
                                <div class="clearfix"></div>
                            </div>
                            <div class="form-group col mb-0">
                                <label class="form-label">Harga Produk</label>
                                <input type="text" class="form-control" placeholder="Harga Produk" ng-model="model.harga" mask-currency="'Rp. '" config="{group:'.',decimalSize:'0',indentation:' '}" required>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label class="form-label">Keterangan</label>
                                <input type="text" class="form-control" placeholder="Keterangan" ng-model="model.keterangan" required>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal fade" id="modalVariant">
            <div class="modal-dialog">
                <form class="modal-content" ng-submit="saveVariant(model)">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Variant</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col">
                                <label class="form-label">Ukuran</label>
                                <input type="text" class="form-control" placeholder="Ukuran" ng-model="model.ukuran" required>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label class="form-label">Warna</label>
                                <input type="text" class="form-control" placeholder="Warna Sepatu" ng-model="model.warna" required>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label class="form-label">Gambar</label>
                                <input type="file" class="form-control" id="customFile" accept="image/*" ng-model="model.berkas" base-sixty-four-input>
                                <img ng-show="model.id && !model.berkas" class="img-fluid" style="border: 5px solid #555" ng-src="<?= base_url() ?>/gambar/{{model.gambar}}" width="30%">
                                <img ng-show="model.berkas" class="img-fluid" style="border: 5px solid #555" data-ng-src="data:{{model.berkas.filetype}};base64,{{model.berkas.base64}}" width="30%">
                                <div class="clearfix"></div>
                            </div>
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
<?= $this->endSection() ?>