<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CustomerModel;
use App\Models\ItemModel;
use App\Models\OrderModel;
use App\Models\ProdukModel;
use App\Models\VariantModel;

class Home extends BaseController
{
    protected $produk;
    protected $order;
    protected $item;
    protected $variant;

    public function __construct()
    {
        $this->produk = new ProdukModel();
        $this->order = new OrderModel();
        $this->item = new ItemModel();
        $this->variant = new VariantModel();
    }
    public function index(): string
    {
        $data['produk'] = $this->produk->countAllResults();
        $data['item'] = $this->item->selectSum('qty', 'qty')->first();
        $data['penjualan'] = $this->order
            ->selectSum('total', 'total')
            ->whereNotIn('status', ['Pending', 'Batal'])
            ->first();
        $data['stok'] = $this->variant->selectSum('stok', 'stok')->first();
        return view('admin/beranda', $data);
    }
}
