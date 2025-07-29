<?= $this->extend('layout/admin') ?>
<?= $this->section('content') ?>
<div class="div" ng-controller="penggunaController" ng-cloak>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Telepon</th>
                                    <th>Alamat</th>
                                    <th>Username</th>
                                    <th>Akses</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in datas">
                                    <td>{{$index+1}}</td>
                                    <td>{{item.nama}}</td>
                                    <td>{{item.email}}</td>
                                    <td>{{item.telepon}}</td>
                                    <td>{{item.alamat}}</td>
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
</div>
<?= $this->endSection() ?>