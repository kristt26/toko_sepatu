<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;

class DetailPesanan extends BaseController
{
    protected $customer;
    protected $detailPesanan;
    protected $order;
    protected $pembayaran;
    protected $area;
    public function __construct()
    {
        $this->customer = new \App\Models\CustomerModel();
        $this->detailPesanan = new \App\Models\ItemModel();
        $this->order = new \App\Models\OrderModel();
        $this->pembayaran = new \App\Models\PembayaranModel();
        $this->area = new \App\Models\AreaModel();
    }
    public function index(): string
    {
        return view('detail_pesanan');
    }

    public function store($id_order = null): ResponseInterface
    {
        try {
            $data['profile'] = $this->customer->where('id_customer', session()->get('id_customer'))->first();
            $data['order'] = $this->order->where('id_order', $id_order)->first();
            $data['order']->detailPesanan = $this->detailPesanan->select("order_item.*, variant.ukuran, variant.warna, variant.stok, variant.gambar, produk.nama_produk, produk.keterangan")
                ->join('variant', 'variant.id_variant = order_item.id_variant')
                ->join('produk', 'produk.id_produk = variant.id_produk')
                ->where('order_item.id_order', $data['order']->id_order)->findAll();
            $data['order']->pembayaran = $this->pembayaran->where('id_order', $data['order']->id_order)->first();
            $data['order']->area = $this->area->where('id_area', $data['order']->id_area)->first()->nama_area;
            $data['order']->ongkir = $this->area->where('id_area', $data['order']->id_area)->first()->harga_kirim;
            $data['order']->total = $data['order']->total + $data['order']->ongkir;
           
            return $this->response->setJSON($data);
        } catch (\Throwable $th) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $th->getMessage()
            ]);
        }
    }
}
