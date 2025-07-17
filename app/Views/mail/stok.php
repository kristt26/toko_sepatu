<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Produk Tersedia Kembali</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f2f3f8;
            font-family: 'Segoe UI', 'Roboto', 'Helvetica Neue', Arial, sans-serif;
            color: #444;
        }

        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .header {
            background-color: #1e90ff;
            color: white;
            text-align: center;
            padding: 25px 20px;
        }

        .header h2 {
            margin: 0;
            font-size: 24px;
        }

        .content {
            padding: 25px 30px;
            font-size: 16px;
            line-height: 1.6;
        }

        .content p {
            margin-bottom: 15px;
        }

        .product-info {
            margin: 20px 0;
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 6px;
        }

        .product-info ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .product-info li {
            margin-bottom: 10px;
        }

        .product-info strong {
            display: inline-block;
            width: 160px;
            color: #222;
        }

        .product-image {
            text-align: center;
            margin: 25px 0;
        }

        .product-image img {
            max-width: 100%;
            border-radius: 8px;
            box-shadow: 0 1px 6px rgba(0, 0, 0, 0.1);
        }

        .cta-button {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 28px;
            background-color: #1e90ff;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
        }

        .cta-button:hover {
            background-color: #006ad1;
        }

        .footer {
            text-align: center;
            font-size: 13px;
            color: #888;
            padding: 20px;
            border-top: 1px solid #eee;
            background-color: #fafafa;
        }
    </style>
</head>

<body>

    <div class="email-container">
        <div class="header">
            <h2>Produk Kini Tersedia Kembali!</h2>
        </div>

        <div class="content">
            <p>Halo Pelanggan Setia,</p>
            <p>Kami dengan senang hati menginformasikan bahwa produk berikut telah tersedia kembali di katalog kami:</p>

            <div class="product-info">
                <ul>
                    <li><strong>Nama Produk:</strong> <?= esc($nama_produk) ?></li>
                    <li><strong>Jumlah Stok Tersedia:</strong> <?= esc($stok) ?> pasang</li>
                </ul>
            </div>

            <div class="product-image">
                <img src="<?= esc($gambar) ?>" alt="Gambar Produk <?= esc($nama_produk) ?>">
            </div>

            <p>Segera dapatkan sebelum kehabisan lagi. Klik tombol di bawah untuk melihat detail produk:</p>

            <div style="text-align: center;">
                <a href="<?= base_url('/detail/' . $id_produk) ?>" class="cta-button">Lihat Produk</a>
            </div>
        </div>

        <div class="footer">
            &copy; <?= date('Y') ?> Sneaker Jayapura. Semua hak dilindungi.<br>
            Email ini dikirim secara otomatis, mohon tidak membalas.
        </div>
    </div>

</body>

</html>