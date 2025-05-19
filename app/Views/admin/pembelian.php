<?= $this->extend('layout/admin') ?>
<?= $this->section('content') ?>
<div class="div" ng-controller="pembelianController" ng-init="init()">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Data Pembelian</h4>
                    <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modals-default" ng-click="add()">Tambah Pembelian</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Tanggal Pembelian</th>
                                    <th>Produk</th>
                                    <th>Ukuran</th>
                                    <th>Warna</th>
                                    <th>Jumlah</th>
                                    <th>Harga Beli</th>
                                    <th width="20%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in datas.pembelian track by $index">
                                    <td>{{item.tanggal_pembelian | date: 'EEEE, d MMMM y'}}</td>
                                    <td>{{item.nama_produk}}</td>
                                    <td>{{item.ukuran}}</td>
                                    <td>{{item.warna}}</td>
                                    <td>{{item.qty}}</td>
                                    <td>{{item.harga_beli | currency: 'Rp. '}}</td>
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
    <div class="card-body">
        <div class="modal fade" id="modals-default">
            <div class="modal-dialog">
                <form class="modal-content" ng-submit="save(model)">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Pembelian</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col">
                                <label class="form-label">Tanggal Pembelian</label>
                                <input type="date" class="form-control" placeholder="Tanggal" ng-model="model.tanggal_beli" required>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label class="form-label">Produk</label>
                                <select class="form-control" ng-model="produk" ng-options="item as item.nama_produk for item in datas.produks" required ng-change="model.nama_produk=produk.nama_produk">
                                    <option value="">Pilih Produk</option>
                                </select>
                                <div class="clearfix"></div>
                            </div>
                            <div class="form-group col">
                                <label class="form-label">Variant</label>
                                <select class="form-control" ng-model="variant" ng-options="item as ('Ukuran: '+item.ukuran+' | Warna: '+item.warna) for item in produk.variant" ng-change="model.id_variant=variant.id_variant; model.ukuran=variant.ukuran; model.warna = variant.warna" required>
                                    <option value="">Pilih Variant</option>
                                </select>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label class="form-label">Jumlah Item</label>
                                <input type="text" class="form-control" placeholder="qty" ng-model="model.qty"  required>
                                <div class="clearfix"></div>
                            </div>
                            <div class="form-group col">
                                <label class="form-label">Harga Beli / Satuan</label>
                                <input type="text" class="form-control" placeholder="Harga Beli" ng-model="model.harga_beli" mask-currency="'Rp. '" config="{group:'.',decimalSize:'0',indentation:' '}" required>
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