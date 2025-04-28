<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;

class Home extends BaseController
{
    protected $produk;
    protected $variant;
    protected $keranjang;
    protected $area;
    public function __construct()
    {
        $this->produk = new \App\Models\ProdukModel();
        $this->variant = new \App\Models\VariantModel();
        $this->keranjang = new \App\Models\KeranjangModel();
        $this->area = new \App\Models\AreaModel();
    }
    public function index(): string
    {
        return view('beranda');
    }
    public function detail(): string
    {
        return view('item');
    }

    public function checkout(): string
    {
        return view('checkout');
    }
    public function cart(): string
    {
        return view('cart');
    }

    function addCard(): ResponseInterface
    {
        $param = $this->request->getJSON();
        $data = [
            'id_customer' => session()->get('id_customer'),
            'id_variant' => $param->id_variant,
            'qty' => $param->qty,
        ];
        try {
            $check = $this->keranjang->where('id_variant', $param->id_variant)->where('id_customer', session()->get('id_customer'))->first();
            if ($check) {
                $this->keranjang->update($check->id_keranjang, [
                    'qty' => $check->qty + $param->qty,
                ]);
                return $this->response->setJSON([
                    'status' => true,
                    'message' => 'Berhasil menambahkan produk ke keranjang',
                ]);
            } else {
                $this->keranjang->insert($data);
                return $this->response->setJSON([
                    'status' => true,
                    'message' => 'Berhasil menambahkan produk ke keranjang',
                ]);
            }
        } catch (\Throwable $th) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Gagal menambahkan produk ke keranjang',
            ])->setStatusCode(500, 'Internal Server Error');
        }
    }
    public function read_detail($id = null): ResponseInterface
    {
        $produk = $this->produk->find($id);
        if ($produk) {
            $produk->variant = $this->variant->where('id_produk', $id)->findAll();
            return $this->response->setJSON($produk);
        } else {
            return $this->response->setStatusCode(404, 'Produk tidak ditemukan');
        }
    }

    function read(): ResponseInterface
    {
        $produk = $this->produk->findAll();
        $variant = $this->variant->findAll();
        foreach ($produk as $key1 => $value1) {
            $value1->variant = [];
            foreach ($variant as $key2 => $value2) {
                if ($value1->id_produk == $value2->id_produk) {
                    $value1->variant[] = $value2;
                }
            }
        }
        return $this->response->setJSON($produk);
    }

    function getCard() : ResponseInterface {
        $id_customer = session()->get('id_customer');
        $data['cart'] = $this->keranjang->select('keranjang.*, variant.ukuran, variant.warna, variant.gambar, produk.nama_produk, produk.harga')
            ->join('variant', 'variant.id_variant = keranjang.id_variant')
            ->join('produk', 'produk.id_produk = variant.id_produk')
            ->where('keranjang.id_customer', $id_customer)
            ->findAll();
        $data['area'] = $this->area->findAll();
        return $this->response->setJSON($data);
        
    }
}
