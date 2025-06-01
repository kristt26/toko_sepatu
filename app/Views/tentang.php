<?= $this->extend('layout/info') ?>
<?= $this->section('content') ?>

<section class="container my-5">
  <div class="row justify-content-center">
    <div class="col-lg-8 text-center">
      <h2 class="mb-4 text-warning fw-bold">Tentang Kami</h2>
      <p class="lead text-light">
        <strong>Sneakers Jayapura</strong> adalah toko sepatu lokal yang berdedikasi menghadirkan koleksi
        <strong>sneakers terbaik, original, dan terkini</strong> untuk masyarakat Jayapura dan sekitarnya.
        Kami percaya bahwa sepatu bukan hanya pelengkap penampilan, tapi juga bagian dari gaya hidup yang mencerminkan kepercayaan diri dan ekspresi diri.
      </p>

      <p class="text-light">
        Berdiri sejak tahun <strong>XXXX</strong>, kami telah melayani ribuan pelanggan dengan berbagai pilihan sepatu dari brand ternama,
        baik lokal maupun internasional. Dari gaya kasual hingga streetwear, kami siap memenuhi kebutuhan fashion kakimu.
      </p>

      <h4 class="text-warning mt-5">Misi Kami</h4>
      <ul class="list-unstyled text-light">
        <li>✅ Menyediakan sneakers berkualitas tinggi dengan harga yang kompetitif.</li>
        <li>✅ Menjadi destinasi utama pecinta sneakers di wilayah Papua.</li>
        <li>✅ Memberikan pelayanan ramah dan profesional, baik online maupun offline.</li>
      </ul>

      <p class="mt-4 text-light">
        <strong>📍 Lokasi:</strong> Kami berbasis di <strong>Jayapura</strong>, namun juga menerima pemesanan dari berbagai kota melalui layanan online kami.
      </p>
    </div>
  </div>
  <style>
    body {
      background-color: #121212;
      color: #eee;
    }

    .text-warning {
      color: #f4c10f !important;
    }

    ul li::marker {
      color: #f4c10f;
    }
  </style>

</section>


<?= $this->endSection() ?>