<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;

class Profile extends BaseController
{
    protected $customer;
    protected $keranjang;
    protected $order;
    protected $item;
    protected $review;
    public function __construct()
    {
        $this->customer = new \App\Models\CustomerModel();
        $this->keranjang = new \App\Models\KeranjangModel();
        $this->order = new \App\Models\OrderModel();
        $this->item = new \App\Models\ItemModel();
        $this->review = new \App\Models\ReviewModel();
    }
    public function index(): string
    {
        return view('profile');
    }

    public function store(): ResponseInterface
    {
        $data['profile'] = $this->customer->where('id_customer', session()->get('id_customer'))->first();
        $data['order'] = $this->order->select('order.*, service_area.harga_kirim')
            ->join('service_area', 'service_area.id_area = order.id_area', 'left')
            ->where('id_customer', session()->get('id_customer'))->findAll();
            foreach ($data['order'] as $key => $order) {
                $order->detail = $this->item->select("order_item.*, variant.ukuran, variant.warna, variant.gambar, produk.id_produk, produk.nama_produk")
                    ->join('variant', 'variant.id_variant = order_item.id_variant', 'left')
                    ->join('produk', 'produk.id_produk = variant.id_produk', 'left')
                    ->where('id_order', $order->id_order)->findAll();
                foreach ($order->detail as $key => $value) {
                    $value->review = $this->review->where('id_item', $value->id_item)->first();
                }
            }
        return $this->response->setJSON($data);
    }
}
