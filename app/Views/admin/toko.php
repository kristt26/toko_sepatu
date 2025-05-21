<?= $this->extend('layout/admin') ?>
<?= $this->section('content') ?>
<div class="div" ng-controller="tokoController" ng-cloak>
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <form name="formToko" ng-submit="simpan()">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Nama Toko</label>
                                <input type="text" class="form-control" placeholder="Masukkan Nama Toko"
                                    ng-model="model.nama" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Telepon</label>
                                <input type="text" class="form-control" placeholder="08xxxx" ng-model="model.telepon" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label class="form-label fw-semibold">Alamat</label>
                                <textarea class="form-control" rows="3" placeholder="Masukkan Alamat Toko"
                                    ng-model="model.alamat" required></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Nama Bank</label>
                                <select id="namaBank" class="form-control" ng-model="model.bank" ng-options="item for item in banks">
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Rekening</label>
                                <input type="text" class="form-control" placeholder="Rekening" ng-model="model.rekening" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Nama Pemilik Rekening</label>
                                <input type="text" class="form-control" placeholder="Nama Pemilik Rekening" ng-model="model.nama_rekening" required>
                            </div>
                        </div>
                        <div class="text-end mt-3">
                            <button ng-show="!model.id_toko" type="submit" class="btn btn-primary" ng-disabled="loading">
                                <span ng-show="loading" class="spinner-border spinner-border-sm me-2"></span>
                                <i class="feather icon-save" ng-hide="loading"></i> Simpan Profil
                            </button>
                            <button ng-show="model.id_toko" type="submit" class="btn btn-warning" ng-disabled="loading">
                                <span ng-show="loading" class="spinner-border spinner-border-sm me-2"></span>
                                <i class="feather icon-save" ng-hide="loading"></i> Update Profil
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center">
                        <label class="form-label fw-semibold mb-3">Logo Toko</label>
                        <div class="text-center">
                            <img ng-show="model.id_toko && !model.berkas" class="rounded-circle shadow-sm"
                                ng-src="<?= base_url() ?>/assets/gambar/{{model.logo}}"
                                style="width: 150px; height: 150px; object-fit: cover; border: 3px solid #0d6efd;">
                            <img ng-show="model.berkas" class="rounded-circle shadow-sm"
                                data-ng-src="data:{{model.berkas.filetype}};base64,{{model.berkas.base64}}"
                                style="width: 150px; height: 150px; object-fit: cover; border: 3px solid #0d6efd;">
                        </div>
                        <input type="file" class="form-control mb-3" accept="image/*"
                            ng-model="model.berkas" base-sixty-four-input>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>