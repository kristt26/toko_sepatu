<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

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
}
