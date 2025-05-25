<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;

class Home extends BaseController
{
    protected $produk;
    protected $variant;
    protected $keranjang;
    protected $area;
    protected $order;
    protected $item;
    protected $pembayaran;
    protected $customer;
    protected $toko;
    protected $lib;
    public function __construct()
    {
        $this->produk = new \App\Models\ProdukModel();
        $this->variant = new \App\Models\VariantModel();
        $this->keranjang = new \App\Models\KeranjangModel();
        $this->area = new \App\Models\AreaModel();
        $this->order = new \App\Models\OrderModel();
        $this->item = new \App\Models\ItemModel();
        $this->pembayaran = new \App\Models\PembayaranModel();
        $this->customer = new \App\Models\CustomerModel();
        $this->toko = new \App\Models\TokoModel();
        $this->lib =  new \App\Libraries\Decode();
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
        $produk = $this->produk
            ->select('produk.*, kategori.nama_kategori, kategori.gender, 
              MAX(variant.ukuran) AS ukuran, 
              MAX(variant.warna) AS warna, 
              MAX(variant.stok) AS stok, 
              MAX(variant.gambar) AS gambar, 
              SUM(order_item.qty) AS total_terjual')
            ->join('kategori', 'kategori.id_kategori=produk.id_kategori', 'left')
            ->join('variant', 'variant.id_produk = produk.id_produk', 'left')
            ->join('order_item', 'variant.id_variant = order_item.id_variant', 'left')
            ->groupBy('produk.id_produk')
            ->orderBy('total_terjual', 'DESC')
            ->limit(16)
            ->findAll();
        return $this->response->setJSON($produk);
    }

    function getCard(): ResponseInterface
    {
        $id_customer = session()->get('id_customer');
        $data['cart'] = $this->keranjang->select('keranjang.*, variant.ukuran, variant.warna, variant.gambar, produk.nama_produk, produk.harga')
            ->join('variant', 'variant.id_variant = keranjang.id_variant')
            ->join('produk', 'produk.id_produk = variant.id_produk')
            ->where('keranjang.id_customer', $id_customer)
            ->findAll();
        $data['area'] = $this->area->findAll();
        return $this->response->setJSON($data);
    }

    function prosesCheckout()
    {
        $param = $this->request->getJSON();
        $conn = \Config\Database::connect();
        $lib = new \App\Libraries\Decode();
        try {
            $conn->transException(true)->transStart();
            $order = [
                'id_customer' => session()->get('id_customer'),
                'id_area' => $param->customer->area,
                'total' => $param->customer->totalItem,
                'kode_order' => "#" . $lib->random_strings(7),
                'alamat_pengirim' => $param->customer->alamat_pengiriman,
                'tanggal_order' => date('Y-m-d H:i:s'),
                'status' => $param->customer->paymentMethod == "Transfer" ? "Pending" : "Proses",
            ];
            $this->order->insert($order);
            $id_order = $this->order->insertID();
            foreach ($param->item as $key => $value) {
                $item = [
                    'id_order' => $id_order,
                    'id_variant' => $value->id_variant,
                    'qty' => $value->qty,
                    'harga' => $value->harga,
                ];
                $this->item->insert($item);
            }
            $pembayaran = [
                'id_order' => $id_order,
                'metode_bayar' => $param->customer->paymentMethod,
                'status' => "Pending"
            ];
            $this->pembayaran->insert($pembayaran);
            $this->keranjang->where('id_customer', session()->get('id_customer'))->delete();
            $conn->transComplete();
            return $this->response->setJSON(['id_order' => $id_order])->setStatusCode(200, 'Berhasil melakukan checkout');
        } catch (\Throwable $th) {
            $conn->transRollback();
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Gagal melakukan checkout',
            ])->setStatusCode(500, 'Internal Server Error');
        }
    }

    function detail_pesanan()
    {
        return view('detail_pesanan');
    }

    function detailPesanan($id = null): ResponseInterface
    {
        $order = $this->order->select('order.*, service_area.nama_area, service_area.harga_kirim')
            ->join('service_area', 'service_area.id_area = order.id_area')
            ->where('id_order', $id)
            ->first();
        $order->detail = $this->item->select("order_item.*, variant.ukuran, variant.warna, variant.gambar, produk.nama_produk")
            ->join('variant', 'variant.id_variant = order_item.id_variant', 'left')
            ->join('produk', 'produk.id_produk = variant.id_produk', 'left')
            ->where('id_order', $order->id_order)->findAll();
        $order->pembayaran = $this->pembayaran->where('id_order', $order->id_order)->first();
        $customer = $this->customer->find($order->id_customer);
        $toko = $this->toko->first();
        return $this->response->setJSON(['order' => $order, 'customer' => $customer, 'toko' => $toko])->setStatusCode(200, 'Berhasil mendapatkan detail pesanan');
    }

    function upload(): ResponseInterface
    {
        $data = $this->request->getJSON();
        $item = [
            'tanggal_bayar' => $data->tanggal_bayar,
            'bukti_bayar' => $this->lib->decodebase64($data->berkas->base64)
        ];
        $this->pembayaran->update($data->id_pembayaran, $item);
        return $this->response->setJSON(true)->setStatusCode(200, 'Berhasil upload');
    }

    function produk(): string
    {
        return view('produk');
    }

    function readProduk(): ResponseInterface
    {
        $produk = $this->produk
            ->select('produk.*, kategori.nama_kategori, kategori.gender, 
              MAX(variant.ukuran) AS ukuran, 
              MAX(variant.warna) AS warna, 
              MAX(variant.stok) AS stok, 
              MAX(variant.gambar) AS gambar')
            ->join('kategori', 'kategori.id_kategori=produk.id_kategori', 'left')
            ->join('variant', 'variant.id_produk = produk.id_produk', 'left')
            ->join('order_item', 'variant.id_variant = order_item.id_variant', 'left')
            ->groupBy('produk.id_produk')
            ->findAll();
        return $this->response->setJSON($produk);
    }

    function tentang(): string
    {
        return view('tentang');
    }
}
