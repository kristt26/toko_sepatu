<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\OrderModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Laporan extends BaseController
{
    public function pembelian(): string
    {
        return view('admin/laporan/pembelian');
    }
    public function penjualan(): string
    {
        return view('admin/laporan/penjualan');
    }

    public function data()
    {
        $post = $this->request->getJSON(true);

        // $tipePeriode = $post['tipePeriode'] ?? 'range'; // default harian
        // $dari = '';
        // $sampai = '';

        // // Tangani periode berdasarkan tipe
        // switch ($tipePeriode) {
        //     case 'bulanan':
        //         $bulanTahun = $post['bulan_tahun'] ?? ''; // contoh: 2024-05
        //         if (preg_match('/^\d{4}-\d{2}$/', $bulanTahun)) {
        //             [$tahun, $bulan] = explode('-', $bulanTahun);
        //             $dari = "$tahun-$bulan-01";
        //             $sampai = date('Y-m-t', strtotime($dari)); // otomatis dapat akhir bulan
        //         }
        //         break;

        //     case 'tahunan':
        //         $tahun = $post['tahun'] ?? '';
        //         if (preg_match('/^\d{4}$/', $tahun)) {
        //             $dari = "$tahun-01-01";
        //             $sampai = "$tahun-12-31";
        //         }
        //         break;

        //     case 'range':
        //     default:
        //     break;
        // }

        $dari = $post['dari_tanggal'] ?? '';
        $sampai = $post['sampai_tanggal'] ?? '';
        $status = $post['status'] ?? '';
        $metode = $post['metode_bayar'] ?? '';

        $db = \Config\Database::connect();
        $builder = $db->table('order o');
        $builder->select('o.id_order, o.kode_order AS invoice, o.tanggal_order AS tanggal, c.nama AS customer, p.metode_bayar, o.status, o.total');
        $builder->join('customer c', 'c.id_customer = o.id_customer');
        $builder->join('pembayaran p', 'p.id_order = o.id_order', 'left');

        if ($dari && $sampai && strtotime($dari) && strtotime($sampai)) {
            $builder->where("DATE(o.tanggal_order) >=", $dari);
            $builder->where("DATE(o.tanggal_order) <=", $sampai);
        }

        if ($status) {
            $builder->where("o.status", $status);
        }

        if ($metode) {
            $builder->where("p.metode_bayar", $metode);
        }

        $builder->orderBy('o.tanggal_order', 'DESC');

        $data = $builder->get()->getResult();

        return $this->response->setJSON($data);
    }
    public function excel()
    {
        $dari = $this->request->getGet('dari_tanggal');
        $sampai = $this->request->getGet('sampai_tanggal');
        $status = $this->request->getGet('status');
        $metode = $this->request->getGet('metode_bayar');

        $db = \Config\Database::connect();
        $builder = $db->table('order o');
        $builder->select('o.kode_order AS invoice, o.tanggal_order AS tanggal, c.nama AS customer, p.metode_bayar, o.status, o.total');
        $builder->join('customer c', 'c.id_customer = o.id_customer');
        $builder->join('pembayaran p', 'p.id_order = o.id_order', 'left');

        if ($dari && $sampai) {
            $builder->where("DATE(o.tanggal_order) >=", $dari);
            $builder->where("DATE(o.tanggal_order) <=", $sampai);
        }

        if ($status) {
            $builder->where("o.status", $status);
        }

        if ($metode) {
            $builder->where("p.metode_bayar", $metode);
        }

        $builder->orderBy('o.tanggal_order', 'DESC');
        $laporan = $builder->get()->getResultArray();

        // Mulai generate Excel
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Judul
        $sheet->mergeCells('A1:G1');
        $sheet->setCellValue('A1', 'LAPORAN PENJUALAN');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->mergeCells('A2:G2');
        $sheet->setCellValue('A2', "Periode: " . date('d-m-Y', strtotime($dari)) . " s.d. " . date('d-m-Y', strtotime($sampai)));
        $sheet->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        // Header kolom (baris ke-3)
        $sheet->setCellValue('A3', 'No');
        $sheet->setCellValue('B3', 'Tanggal');
        $sheet->setCellValue('C3', 'Invoice');
        $sheet->setCellValue('D3', 'Customer');
        $sheet->setCellValue('E3', 'Metode Bayar');
        $sheet->setCellValue('F3', 'Status');
        $sheet->setCellValue('G3', 'Total');

        $sheet->getStyle('A3:G3')->getFont()->setBold(true);
        $sheet->getStyle('A3:G3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Isi data mulai baris ke-4
        $row = 4;
        foreach ($laporan as $index => $item) {
            $sheet->setCellValue('A' . $row, $index + 1);
            $sheet->setCellValue('B' . $row, date('d-m-Y', strtotime($item['tanggal'])));
            $sheet->setCellValue('C' . $row, $item['invoice']);
            $sheet->setCellValue('D' . $row, $item['customer']);
            $sheet->setCellValue('E' . $row, ucfirst($item['metode_bayar']));
            $sheet->setCellValue('F' . $row, ucfirst($item['status']));
            $sheet->setCellValue('G' . $row, $item['total']);
            $row++;
        }

        // Format kolom total sebagai currency (Rp)
        $currencyFormat = '"Rp. " #,##0';
        $sheet->getStyle('G4:G' . ($row - 1))
            ->getNumberFormat()
            ->setFormatCode($currencyFormat);

        // Auto size kolom
        foreach (range('A', 'G') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Border untuk seluruh tabel
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ];
        $sheet->getStyle('A3:G' . ($row - 1))->applyFromArray($styleArray);

        // Header HTTP response untuk download file
        $filename = 'laporan_penjualan_' . date('Ymd_His') . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }


    public function print()
    {
        $orderModel = new OrderModel();
        $dari = $this->request->getGet('dari_tanggal');
        $sampai = $this->request->getGet('sampai_tanggal');
        $status = $this->request->getGet('status');
        $metode = $this->request->getGet('metode_bayar');

        $data = $orderModel->getLaporan($dari, $sampai, $status, $metode);

        echo view('admin/laporan/cetak', [
            'laporan' => $data,
            'dari' => $dari,
            'sampai' => $sampai
        ]);
    }

    public function pembelian_data()
    {
        $post = $this->request->getJSON(true);
        $dari = $post['dari_tanggal'] ?? '';
        $sampai = $post['sampai_tanggal'] ?? '';

        $db = \Config\Database::connect();
        $builder = $db->table('pembelian p');
        $builder->select('
            p.id_pembelian,
            p.tanggal_pembelian,
            p.qty,
            p.harga_beli,
            v.ukuran,
            v.warna,
            pr.nama_produk
        ');
        $builder->join('variant v', 'v.id_variant = p.id_variant');
        $builder->join('produk pr', 'pr.id_produk = v.id_produk');

        if ($dari && $sampai) {
            $builder->where("DATE(p.tanggal_pembelian) >=", $dari);
            $builder->where("DATE(p.tanggal_pembelian) <=", $sampai);
        }

        $builder->orderBy('p.tanggal_pembelian', 'DESC');

        $data = $builder->get()->getResultArray();

        // Tambahkan total per item pembelian = qty * harga_beli
        foreach ($data as &$item) {
            $item['total'] = $item['qty'] * $item['harga_beli'];
            $item['tanggal'] = date('d-m-Y', strtotime($item['tanggal_pembelian']));
        }

        return $this->response->setJSON($data);
    }

    public function pembelian_excel()
    {
        $dari = $this->request->getGet('dari_tanggal');
        $sampai = $this->request->getGet('sampai_tanggal');

        $db = \Config\Database::connect();
        $builder = $db->table('pembelian p');
        $builder->select('
        p.id_pembelian,
        p.tanggal_pembelian,
        p.qty,
        p.harga_beli,
        v.ukuran,
        v.warna,
        pr.nama_produk
    ');
        $builder->join('variant v', 'v.id_variant = p.id_variant');
        $builder->join('produk pr', 'pr.id_produk = v.id_produk');

        if ($dari && $sampai) {
            $builder->where("DATE(p.tanggal_pembelian) >=", $dari);
            $builder->where("DATE(p.tanggal_pembelian) <=", $sampai);
        }

        $builder->orderBy('p.tanggal_pembelian', 'DESC');

        $laporan = $builder->get()->getResultArray();

        // Buat file Excel
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->mergeCells('A1:G1');
        $sheet->setCellValue('A1', 'LAPORAN PEMBELIAN');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $headers = ['No', 'Tanggal', 'Nama Produk', 'Warna', 'Ukuran', 'Qty', 'Harga Beli', 'Total'];
        $cols = range('A', 'H');
        foreach ($headers as $i => $header) {
            $sheet->setCellValue($cols[$i] . '2', $header);
            $sheet->getStyle($cols[$i] . '2')->getFont()->setBold(true);
        }

        $rowNum = 3;
        foreach ($laporan as $index => $item) {
            $total = $item['qty'] * $item['harga_beli'];

            $sheet->setCellValue('A' . $rowNum, $index + 1);
            $sheet->setCellValue('B' . $rowNum, date('d-m-Y', strtotime($item['tanggal_pembelian'])));
            $sheet->setCellValue('C' . $rowNum, $item['nama_produk']);
            $sheet->setCellValue('D' . $rowNum, $item['warna']);
            $sheet->setCellValue('E' . $rowNum, $item['ukuran']);
            $sheet->setCellValue('F' . $rowNum, $item['qty']);
            $sheet->setCellValue('G' . $rowNum, $item['harga_beli']);
            $sheet->setCellValue('H' . $rowNum, $total);
            $rowNum++;
        }

        // Format currency dan autosize kolom
        $sheet->getStyle('G3:H' . ($rowNum - 1))
            ->getNumberFormat()
            ->setFormatCode('#,##0.00');

        foreach ($cols as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $filename = 'laporan_pembelian_' . date('Ymd_His') . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=\"$filename\"");
        header('Cache-Control: max-age=0');

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    public function pembelian_print()
    {
        $dari = $this->request->getGet('dari_tanggal');
        $sampai = $this->request->getGet('sampai_tanggal');

        $db = \Config\Database::connect();
        $builder = $db->table('pembelian p');
        $builder->select('
            p.id_pembelian,
            p.tanggal_pembelian,
            p.qty,
            p.harga_beli,
            v.ukuran,
            v.warna,
            pr.nama_produk
        ');
        $builder->join('variant v', 'v.id_variant = p.id_variant');
        $builder->join('produk pr', 'pr.id_produk = v.id_produk');

        if ($dari && $sampai) {
            $builder->where("DATE(p.tanggal_pembelian) >=", $dari);
            $builder->where("DATE(p.tanggal_pembelian) <=", $sampai);
        }

        $builder->orderBy('p.tanggal_pembelian', 'DESC');
        $laporan = $builder->get()->getResultArray();

        // Buat tampilan HTML sederhana untuk print
        echo '<!DOCTYPE html>
            <html>
            <head>
                <title>Laporan Pembelian</title>
                <style>
                    body { font-family: Arial, sans-serif; }
                    h2 { text-align: center; }
                    table { border-collapse: collapse; width: 100%; margin-top: 20px; }
                    table, th, td { border: 1px solid #000; }
                    th, td { padding: 8px; text-align: center; }
                    th { background-color: #f2f2f2; }
                    tfoot td { font-weight: bold; }
                </style>
            </head>
            <body onload="window.print();">
                <h2>Laporan Pembelian</h2>
                <p style="text-align:center;">Tanggal: ' . ($dari ? date('d-m-Y', strtotime($dari)) : '-') . ' s/d ' . ($sampai ? date('d-m-Y', strtotime($sampai)) : '-') . '</p>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nama Produk</th>
                            <th>Warna</th>
                            <th>Ukuran</th>
                            <th>Qty</th>
                            <th>Harga Beli</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>';

                    $grandTotal = 0;
                    foreach ($laporan as $i => $row) {
                        $total = $row['qty'] * $row['harga_beli'];
                        $grandTotal += $total;

                        echo '<tr>
                        <td>' . ($i + 1) . '</td>
                        <td>' . date('d-m-Y', strtotime($row['tanggal_pembelian'])) . '</td>
                        <td>' . htmlspecialchars($row['nama_produk']) . '</td>
                        <td>' . htmlspecialchars($row['warna']) . '</td>
                        <td>' . htmlspecialchars($row['ukuran']) . '</td>
                        <td>' . $row['qty'] . '</td>
                        <td>' . number_format($row['harga_beli'], 2, ',', '.') . '</td>
                        <td>' . number_format($total, 2, ',', '.') . '</td>
                    </tr>';
                    }

                    echo '</tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7">Grand Total</td>
                            <td>' . number_format($grandTotal, 2, ',', '.') . '</td>
                        </tr>
                    </tfoot>
                </table>
            </body>
            </html>';
                }
}
