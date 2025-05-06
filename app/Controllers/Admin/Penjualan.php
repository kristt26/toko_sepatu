<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Penjualan extends BaseController
{
    protected $variant;
    protected $produk;
    protected $conn;
    protected $lib;
    protected $penjualan;
    protected $item;
    public function __construct() {
        $this->variant = new \App\Models\VariantModel();
        $this->produk = new \App\Models\ProdukModel();
        $this->conn = \Config\Database::connect();
        $this->lib = new \App\Libraries\Decode();
        $this->penjualan = new \App\Models\OrderModel();
        $this->item = new \App\Models\ItemModel();
    }

    public function index(): string
    {
        return view('admin/penjualan');
    }

    public function store() 
    {
        $data = $this->variant->select('variant.*, produk.nama_produk, produk.harga')
            ->join('produk', 'produk.id_produk = variant.id_produk')
            ->where('variant.stok > 0')
            ->orderBy('id_variant', 'DESC')->findAll();
        return $this->response->setJSON($data);
    }

    function add() : ResponseInterface
    {
        $param = $this->request->getJSON();
        try {
            $this->conn->transException(true)->transStart(); 
            $total = array_reduce($param, function ($carry, $item) {
                return $carry + ($item->harga*$item->qty);
            }, 0);
            $order = [
                'kode_order' => "#".$this->lib->random_strings(6),
                'total' => $total,
                'tanggal_order' => date('Y-m-d H:i:s'),
                'status' => 'Paid',
            ];
            $this->penjualan->insert($order);
            $id_order = $this->penjualan->insertID();
            foreach ($param as $key => $value) {
                $item = [
                    'id_order' => $id_order,
                    'id_variant' => $value->id_variant,
                    'qty' => $value->qty,
                    'harga' => $value->harga,
                ];
                $this->item->insert($item);
                $this->variant->update($value->id_variant, [
                    'stok' => $value->stok - $value->qty
                ]);
            }
            $this->conn->transComplete();
            return $this->response->setJSON($param);
        } catch (\Throwable $th) {
            return $this->response->setJSON([
                'status' => 'Gagal simpan data',
                'message' => $th->getMessage()
            ])->setStatusCode(500);
        }
    }

    function delete($id = null) : ResponseInterface
    {
        try {
            $this->conn->transException(true)->transStart();
            $item = $this->penjualan->find($id);
            $variant = $this->variant->find($item->id_variant);
            $this->variant->update($item->id_variant, [
                'stok' => $variant->stok - $item->qty
            ]);
            $this->penjualan->delete($id);
            $this->conn->transComplete();
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Data berhasil dihapus'
            ]);
        } catch (\Throwable $th) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $th->getMessage()
            ])->setStatusCode(500);
        }
    }

    function struk (){
        return view('struk');
    }

}
