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
                                <h4 class="mb-2"> <?= $produk?> </h4>
                                <p class="text-muted mb-0">Jenis Sepatu</p>
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
                                <h4 class="mb-2"><?= $stok->stok?></h4>
                                <p class="text-muted mb-0">Stock</p>
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
                                <h4 class="mb-2"> <?= $item->qty?> <small></small></h4>
                                <p class="text-muted mb-0">Terjual</p>
                            </div>
                            <div class="lnr lnr-cart display-4 text-danger"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="">
                                <h4 class="mb-2"><?= "Rp. " . number_format($penjualan->total, 0, ',', '.') ?></h4>
                                <p class="text-muted mb-0">Profit</p>
                            </div>
                            <div class="lnr lnr-arrow-up display-4 text-warning"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>