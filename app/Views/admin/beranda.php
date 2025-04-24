<?= $this->extend('layout/admin') ?>
<?= $this->section('content') ?>
<div class="div" ng-controller="dashboardController">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-3">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="">
                                <h2 class="mb-2"> 256 </h2>
                                <p class="text-muted mb-0"><span class="badge badge-primary">Revenue</span> Today</p>
                            </div>
                            <div class="lnr lnr-leaf display-4 text-primary"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="">
                                <h2 class="mb-2">8451</h2>
                                <p class="text-muted mb-0"><span class="badge badge-success">20%</span> Stock</p>
                            </div>
                            <div class="lnr lnr-chart-bars display-4 text-success"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="">
                                <h2 class="mb-2"> 31% <small></small></h2>
                                <p class="text-muted mb-0">New <span class="badge badge-danger">20%</span> Customer</p>
                            </div>
                            <div class="lnr lnr-rocket display-4 text-danger"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="">
                                <h2 class="mb-2">158</h2>
                                <p class="text-muted mb-0"><span class="badge badge-warning">$143.45</span> Profit</p>
                            </div>
                            <div class="lnr lnr-cart display-4 text-warning"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>