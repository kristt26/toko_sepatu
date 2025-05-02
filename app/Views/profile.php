<?= $this->extend('layout/info') ?>
<?= $this->section('content') ?>

<div class="container my-5" ng-controller="profileController" ng-cloak>
  <div class="row g-4">
    <div class="col-md-5">
      <h3 class="section-title">Profil Saya</h3>
      <div class="profile-card p-4">
        <div class="text-center mb-4">
          <i class="bi bi-person-circle" style="font-size: 5rem; color: #f4c10f;"></i>
          <h4 class="mt-2">Nama Customer</h4>
          <p class="text-secondary">customer@email.com</p>
        </div>

        <form>
          <div class="mb-3">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" value="Nama Customer" />
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" value="customer@email.com" />
          </div>
          <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea class="form-control" rows="3">Jayapura, Papua</textarea>
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

    <!-- Orders Section -->
    <div class="col-md-7">
      <h3 class="section-title">Riwayat Pesanan</h3>
      <div class="table-responsive">
        <table class="table table-bordered align-middle table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Tanggal</th>
              <th>Produk</th>
              <th>Total</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <tr  ng-click="detailPesanan(item)">
              <td>1</td>
              <td>29 Apr 2025</td>
              <td>Air Max 90</td>
              <td>Rp 1.500.000</td>
              <td><span class="badge bg-success">Selesai</span></td>
            </tr>
            <tr>
              <td>2</td>
              <td>20 Apr 2025</td>
              <td>Jordan 1 Retro</td>
              <td>Rp 2.300.000</td>
              <td><span class="badge bg-warning text-dark">Diproses</span></td>
            </tr>
            <tr>
              <td>3</td>
              <td>15 Apr 2025</td>
              <td>Converse All Star</td>
              <td>Rp 800.000</td>
              <td><span class="badge bg-danger">Dibatalkan</span></td>
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
    --bs-table-hover-bg:rgb(219 34 34 / 35%);
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