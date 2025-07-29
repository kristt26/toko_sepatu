<?= $this->extend('layout/admin') ?>
<?= $this->section('content') ?>
<div class="div" ng-controller="kasirController" ng-cloak>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <button type="button" class="btn btn-primary float-right mb-3" data-toggle="modal" data-target="#modals-default" ng-click="add()">Tambah Kasir</button>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Akses</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in datas">
                                    <td>{{$index+1}}</td>
                                    <td>{{item.username}}</td>
                                    <td>{{item.role}}</td>
                                </tr>
                            </tbody>
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
                    <div class="form-row">
                        <div class="form-group col">
                            <label class="form-label">Role</label>
                            <select class="form-control" ng-model="model.role" required>
                                <option value="">Pilih Role</option>
                                <option value="admin">Admin</option>
                                <option value="kasir">Kasir</option>
                            </select>
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