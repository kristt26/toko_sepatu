<?= $this->extend('layout/admin') ?>
<?= $this->section('content') ?>
<div class="div" ng-controller="orderController" ng-cloak>
    <div class="row">
        <div class="col-md">
            <div class="card text-center mb-3">
                <div class="card-header bg-primary border-0">
                    <ul class="nav nav-tabs md-tabs-light card-header-tabs nav-responsive-md">
                        <li class="nav-item">
                            <a href="javascript:void()" class="nav-link active" data-toggle="tab" data-target="#navs-lm-pending">Pending</a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void()" class="nav-link" data-toggle="tab" data-target="#navs-lm-paid">Paid</a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void()" class="nav-link" data-toggle="tab" data-target="#navs-lm-proses">Proses</a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void()" class="nav-link" data-toggle="tab" data-target="#navs-lm-tolak">Tolak</a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="navs-lm-pending">
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
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="item in dataPending">
                                                <td>{{ item.kode_order }}</td>
                                                <td>{{ item.tanggal_order | date:'dd/MM/yyyy' }}</td>
                                                <td>{{ item.nama }}</td>
                                                <td>{{ item.alamat_pengirim }}</td>
                                                <td>{{ item.total | currency:'Rp. ' }}</td>
                                                <td><span class="badge badge-warning">Pending</span></td>
                                                <td>
                                                    <button ng-if="item.pembayaran.bukti_bayar" type="button" class="btn btn-info btn-sm w-auto" ng-click="previewProof(item)" title="Lihat Bukti Transfer">
                                                        <i class="fas fa-image"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="navs-lm-paid">
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
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="item in dataPaid">
                                                <td>{{ item.kode_order }}</td>
                                                <td>{{ item.tanggal_order | date:'dd/MM/yyyy' }}</td>
                                                <td>{{ item.nama }}</td>
                                                <td>{{ item.alamat_pengirim }}</td>
                                                <td>{{ item.total | currency:'Rp. ' }}</td>
                                                <td><span class="badge badge-primary">Paid</span></td>
                                                <td>
                                                    <button type="button" class="btn btn-info btn-sm w-auto" ng-click="validasiPembayaran('proses', 'Paid', item)" title="Checklist pengiriman">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="navs-lm-proses">
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
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="item in dataProses">
                                                <td>{{ item.kode_order }}</td>
                                                <td>{{ item.tanggal_order | date:'dd/MM/yyyy' }}</td>
                                                <td>{{ item.nama }}</td>
                                                <td>{{ item.alamat_pengirim }}</td>
                                                <td>{{ item.total | currency:'Rp. ' }}</td>
                                                <td><span class="badge badge-primary">Paid</span></td>
                                                <td>
                                                    <button type="button" class="btn btn-info btn-sm w-auto" ng-click="validasiPembayaran('selesai', 'Proses', item)" title="Checklist pengiriman">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="navs-lm-tolak">
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
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="item in dataBatal">
                                                <td>{{ item.kode_order }}</td>
                                                <td>{{ item.tanggal_order | date:'dd/MM/yyyy' }}</td>
                                                <td>{{ item.nama }}</td>
                                                <td>{{ item.alamat_pengirim }}</td>
                                                <td>{{ item.total | currency:'Rp. ' }}</td>
                                                <td><span class="badge badge-primary">Paid</span></td>
                                                <td>
                                                    <button type="button" class="btn btn-info btn-sm w-auto" ng-click="previewProof(item)" title="Lihat Bukti Transfer">
                                                        <i class="fas fa-reload"></i>
                                                    </button>
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
        </div>
        <div class="col-md-12">

        </div>
    </div>
    <div class="modal fade" id="proofModal" tabindex="-1" aria-labelledby="proofModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 rounded-3 shadow-lg">
                <!-- Header -->
                <div class="modal-header bg-info text-white rounded-top d-flex justify-content-between align-items-center">
                    <h5 class="modal-title mb-0" id="proofModalLabel">📄 Bukti Transfer</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- Body -->
                <div class="modal-body text-center">
                    <!-- Bukti Transfer -->
                    <img id="proofImage" ng-src="/assets/gambar/{{model.pembayaran.bukti_bayar}}"
                        alt="Bukti Transfer" class="img-fluid rounded shadow mb-4 border"
                        style="max-height: 400px; object-fit: contain; border-radius: 10px; cursor: zoom-in;"
                        onclick="openImageModal(this)">

                    <!-- Tombol Validasi -->
                    <div class="d-flex justify-content-center gap-4">
                        <button class="btn btn-success px-4 py-2 rounded-pill d-flex align-items-center"
                            ng-click="validasiPembayaran('valid', 'Pending')">
                            <i class="fas fa-check-circle me-2"></i> Validasi
                        </button>
                        <button class="btn btn-danger px-4 py-2 rounded-pill d-flex align-items-center"
                            ng-click="validasiPembayaran('tolak', 'Pending')">
                            <i class="fas fa-times-circle me-2"></i> Tolak
                        </button>
                    </div>

                    <!-- Tombol Batal -->
                    <div class="d-flex justify-content-center mt-3">
                        <button class="btn btn-secondary px-4 py-2 rounded-pill" data-dismiss="modal">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-3 shadow-lg">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="imageModalLabel">Gambar Bukti Transfer</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <img id="largeImage" src="" alt="Bukti Transfer" class="img-fluid" style="max-height: 90vh; object-fit: contain;">
                </div>
            </div>
        </div>
    </div>



</div>
<style>
    .dataTables_length {
        float: left !important;
        margin-right: 20px;
    }

    /* Rapikan posisi Search (biar tetap kanan) */
    .dataTables_filter {
        float: right !important;
    }

    .dataTables_filter input {
        width: 250px !important;
        /* Bisa ubah 250px sesuai kebutuhan */
        display: inline-block;
        margin-left: 0.5rem;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        padding: 0.25rem 0.5rem;
    }

    .modal.fade .modal-dialog {
        transition: transform 0.3s ease-out;
        transform: translateY(-50px);
    }

    .modal.show .modal-dialog {
        transform: translateY(0);
    }

    .modal-header {
        border-bottom: 2px solid #ddd;
    }

    /* Button Hover Effect */
    .modal-footer button:hover {
        transform: scale(1.05);
        transition: all 0.2s ease-in-out;
    }

    /* Gambar pada Modal */
    #proofImage {
        transition: transform 0.3s ease;
    }

    /* Ketika gambar diperbesar */
    #proofImage:hover {
        transform: scale(1.05);
    }

    /* Lightbox Modal Styling */
    #imageModal .modal-content {
        background: rgba(0, 0, 0, 0.8);
    }

    #largeImage {
        max-height: 80vh;
        max-width: 100%;
        object-fit: contain;
        border-radius: 10px;
    }

    .dataTables_info {
        float: left !important;
        padding-top: 0.85em;
        margin-left: 10px;
    }

    /* Lebarkan kotak search */
    .dataTables_filter input {
        width: 250px;
        margin-left: 0.5em;
    }

    /* Rapatkan tombol pagination */
    .dataTables_paginate {
        float: right !important;
        margin-right: 10px;
    }
</style>
<script>
    // Fungsi untuk zoom gambar dengan Ctrl + Scroll Mouse
    function openImageModal(image) {
        // Ambil URL gambar yang diklik
        var imgSrc = image.src;

        // Tampilkan modal dengan gambar yang lebih besar
        document.getElementById('largeImage').src = imgSrc;

        // Tampilkan modal
        $('#imageModal').modal('show');
    }
</script>
<?= $this->endSection() ?>