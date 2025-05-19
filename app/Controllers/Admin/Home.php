<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CustomerModel;
use App\Models\ItemModel;
use App\Models\OrderModel;
use App\Models\ProdukModel;
use App\Models\TokoModel;
use App\Models\VariantModel;
use CodeIgniter\HTTP\ResponseInterface;

class Home extends BaseController
{
    protected $produk;
    protected $order;
    protected $item;
    protected $variant;
    protected $toko;

    public function __construct()
    {
        $this->produk = new ProdukModel();
        $this->order = new OrderModel();
        $this->item = new ItemModel();
        $this->variant = new VariantModel();
        $this->toko = new TokoModel();
    }
    public function index(): string
    {
        $data['produk'] = $this->produk->countAllResults();
        $data['item'] = $this->item->selectSum('qty', 'qty')->first()->qty ?? 0;
        $data['penjualan'] = $this->order
            ->selectSum('total', 'total')
            ->whereNotIn('status', ['Pending', 'Batal'])
            ->first()->total ?? 0;
        $data['stok'] = $this->variant->selectSum('stok', 'stok')->first()->stok ?? 0;
        return view('admin/beranda', $data);
    }

    function toko() : ResponseInterface {
        $data = $this->toko->first();
        return $this->response->setJSON($data);
    }
}
