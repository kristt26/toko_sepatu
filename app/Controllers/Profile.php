<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;

class Profile extends BaseController
{
    protected $customer;
    protected $keranjang;
    public function __construct()
    {
        $this->customer = new \App\Models\CustomerModel();
        $this->keranjang = new \App\Models\KeranjangModel();
    }
    public function index(): string
    {
        return view('profile');
    }

    public function store(): ResponseInterface
    {
        $data['profile'] = $this->customer->where('id_customer', session()->get('id_customer'))->first();
        $data['keranjang'] = $this->keranjang->where('id_customer', session()->get('id_customer'))->findAll();
        return $this->response->setJSON($data);
    }
    
}
