<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;

class Profile extends BaseController
{
    protected $customer;
    protected $keranjang;
    protected $order;
    public function __construct()
    {
        $this->customer = new \App\Models\CustomerModel();
        $this->keranjang = new \App\Models\KeranjangModel();
        $this->order = new \App\Models\OrderModel();
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
        return $this->response->setJSON($data);
    }
    
}
