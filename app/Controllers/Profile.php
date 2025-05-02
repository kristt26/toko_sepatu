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
        $data['order'] = $this->order->where('id_customer', session()->get('id_customer'))->findAll();
        return $this->response->setJSON($data);
    }
    
}
