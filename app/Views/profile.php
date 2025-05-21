<?= $this->extend('layout/info') ?>
<?= $this->section('content') ?>
<div class="container my-5" ng-controller="profileController" ng-cloak>
  <div class="row g-4">
    <div class="col-md-5">
      <h3 class="section-title">Profil Saya</h3>
      <div class="profile-card p-4">
        <div class="text-center mb-4">
          <i class="bi bi-person-circle" style="font-size: 5rem; color: #f4c10f;"></i>
          <h4 class="mt-2">{{datas.profile.nama}}</h4>
          <p class="text-secondary">{{datas.profile.email}}</p>
        </div>
        <form>
          <div class="mb-3">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" ng-model="model.nama" />
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" ng-model="model.email" />
          </div>
          <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea class="form-control" rows="3" ng-model="model.alamat"></textarea>
          </div>
          <div class="d-grid gap-2">
            <button type="submit" class="btn btn-warning">
              <i class="bi bi-save me-1"></i>Simpan Perubahan
            </button>
            <button type="button" class="btn btn-outline-light">
              <i class="bi bi-box-arrow-right me-1"></i>Keluar Akun
            </button>
          </div>
        </form>
      </div>
    </div>
    <div class="col-md-7">
      <h3 class="section-title">Riwayat Pesanan</h3>
      <div class="table-responsive">
        <table class="table table-bordered align-middle table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Tanggal</th>
              <th>Total</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <tr ng-repeat="item in datas.order" ng-click="detailPesanan(item)">
              <td>{{item.kode_order}}</td>
              <td>{{(item.tanggal_order | toDate) | date: 'd MMMM y'}}</td>
              <td>{{(item.total | toDouble) + (item.harga_kirim | toDouble)}}</td>
              <td><span class="badge" ng-class="{'bg-secondary': item.status=='Pending', 'bg-primary': item.status=='Paid', 'bg-warning': item.status=='Proses', 'bg-info': item.status=='Terkirim', 'bg-danger': item.status=='Batal'}">{{item.status}}</span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<style>
  .profile-card {
    background-color: #1e1e1e;
    border: none;
    border-radius: 15px;
    padding: 30px;
    color: #eee;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
  }

  .btn-warning {
    background-color: #f4c10f;
    color: #000;
    font-weight: bold;
  }

  .btn-warning:hover {
    background-color: #d4a90d;
    color: #000;
  }

  .form-control {
    background-color: #2c2c2c;
    border: none;
    color: #eee;
  }

  .form-control:focus {
    background-color: #2c2c2c;
    color: #eee;
    border-color: #f4c10f;
    box-shadow: none;
  }

  .table {
    color: #eee;
    --bs-table-hover-bg: rgb(219 34 34 / 35%);
  }

  .table th {
    background-color: #000;
    color: #f4c10f;
  }

  .table td {
    background-color: #1e1e1e;
    color: #eee;
  }

  .section-title {
    font-weight: bold;
    margin-bottom: 20px;
    border-left: 5px solid #f4c10f;
    padding-left: 10px;
    color: #f4c10f;
  }

  .badge {
    font-size: 0.9rem;
  }


  /* Responsive */
  @media (max-width: 767px) {
    .profile-card {
      margin-bottom: 30px;
    }
  }
</style>
<?= $this->endSection() ?>