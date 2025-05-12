<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Order extends BaseController
{
    protected $order;
    protected $detail;
    protected $pembayaran;
    public function __construct() {
        $this->order = new \App\Models\OrderModel();
        $this->detail = new \App\Models\ItemModel();
        $this->pembayaran = new \App\Models\PembayaranModel();
    }

    public function index(): string
    {
        return view('admin/order');
    }

    public function store() 
    {
        $order = $this->order->select("order.*, customer.nama,```` customer.phone, service_area.nama_area")
        ->join('customer', 'customer.id_customer = order.id_customer')
        ->join('service_area', 'service_area.id_area = order.id_area')
        ->where('order.id_customer IS NOT NULL')
        ->findAll();
        foreach ($order as $key => $value) {
            $value->detail = $this->detail->select("order_item.*, variant.ukuran, variant.warna, variant.gambar, produk.nama_produk")
            ->join('variant', 'variant.id_variant = order_item.id_variant', 'left')
            ->join('produk', 'produk.id_produk = variant.id_produk', 'left')
            ->where('id_order', $value->id_order)->findAll();
            $value->pembayaran = $this->pembayaran->where('id_order', $value->id_order)->first();
        }
        return $this->response->setJSON($order);
    }

    function add() : ResponseInterface
    {
        $param = $this->request->getJSON();
        try {
            $this->area->insert($param);
            $param->id_area = $this->area->insertID();
            return $this->response->setJSON($param);
        } catch (\Throwable $th) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $th->getMessage()
            ]);
        }
    }

    function edit() : ResponseInterface
    {
        $param = $this->request->getJSON();
        try {
            $this->order->update($param->id_order, ['status'=>$param->status]);
            $this->pembayaran->update($param->pembayaran->id_pembayaran, ['status_bayar'=>$param->pembayaran->status_bayar]);
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Data berhasil diubah'
            ]);
        } catch (\Throwable $th) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $th->getMessage()
            ]);
        }
    }

    function delete($id = null) : ResponseInterface
    {
        try {
            $this->area->delete($id);
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
}
