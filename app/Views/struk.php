<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Struk Belanja</title>
  <style>
    body {
      width: 58mm;
      font-family: 'Courier New', monospace;
      font-size: 12px;
      margin: 0;
      padding: 0;
    }
    .struk {
      padding: 10px;
    }
    .center {
      text-align: center;
    }
    .bold {
      font-weight: bold;
    }
    .line {
      border-top: 1px dashed #000;
      margin: 5px 0;
    }
    table {
      width: 100%;
    }
    td {
      vertical-align: top;
    }
    .right {
      text-align: right;
    }

    .logo img {
      max-width: 40mm;
      height: auto;
      margin-bottom: 5px;
    }

    @media print {
      @page {
        size: 58mm auto; /* lebar 58mm, tinggi otomatis */
        margin: 0.5rem;
      }
      body {
        margin: 0;
        width: 58mm;
      }
      .struk {
        padding: 0;
      }
    }
  </style>
</head>
<body onload="window.print()">
  <div class="struk">
    <!-- Logo -->
    <div class="center logo">
      <img src="logo.png" alt="Logo Toko">
    </div>

    <div class="center bold">TOKO ONLINEKU</div>
    <div class="center">Jl. Contoh Alamat No.123</div>
    <div class="center">Telp: 0812-3456-7890</div>

    <div class="line"></div>

    <p>No. Pesanan: <strong>#123456</strong><br>
    Tanggal: 30-04-2025</p>

    <div class="line"></div>

    <!-- Daftar Produk -->
    <table>
      <tbody>
        <tr>
          <td>Kaos Polos M</td>
          <td class="right">1 x 75.000</td>
        </tr>
        <tr>
          <td></td>
          <td class="right">= 75.000</td>
        </tr>

        <tr>
          <td>Celana Jeans</td>
          <td class="right">2 x 120.000</td>
        </tr>
        <tr>
          <td></td>
          <td class="right">= 240.000</td>
        </tr>
      </tbody>
    </table>

    <div class="line"></div>

    <!-- Ringkasan -->
    <table>
      <tr>
        <td>Subtotal</td>
        <td class="right">315.000</td>
      </tr>
      <tr>
        <td>Ongkir</td>
        <td class="right">20.000</td>
      </tr>
      <tr class="bold">
        <td>Total</td>
        <td class="right">335.000</td>
      </tr>
    </table>

    <div class="line"></div>

    <!-- Pembayaran -->
    <p>Metode Bayar: Transfer</p>

    <div class="line"></div>

    <p class="center">*** TERIMA KASIH ***</p>
  </div>
</body>
</html>
