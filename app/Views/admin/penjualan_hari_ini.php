<?= $this->extend('layout/admin') ?>
<?= $this->section('content') ?>
<div class="div" ng-controller="penjualanHariIniController" ng-cloak>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table datatable="ng" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No Order</th>
                                    <th>Tanggal</th>
                                    <th>Nama Pemesan</th>
                                    <th>Alamat Pengiriman</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in datas">
                                    <td>{{ item.kode_order }}</td>
                                    <td>{{ item.tanggal_order | date:'dd/MM/yyyy' }}</td>
                                    <td>{{ item.nama }}</td>
                                    <td>{{ item.alamat_pengirim }}</td>
                                    <td>{{ item.total | currency:'Rp. ' }}</td>
                                    <td><span class="badge badge-primary">Paid</span></td>
                                  
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4">Total Penjualan Hari ini</td>
                                    <td>Rp. {{totalPenjualan | number}}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modals-default">
        <div class="modal-dialog modal-lg">
            <form class="modal-content" ng-submit="save(model)">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kasir</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" placeholder="Username" ng-model="model.username" required>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" placeholder="Password" ng-model="model.password" required>
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
<?= $this->endSection() ?>