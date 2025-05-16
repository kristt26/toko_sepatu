<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table            = 'order';
    protected $primaryKey       = 'id_order';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_customer', 'id_area', 'kode_order', 'tanggal_order', 'status', 'total', 'alamat_pengirim'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    public function getLaporan($dari, $sampai, $status = '', $metode = '')
    {
        $builder = $this->db->table('order o');

        // Select kolom-kolom yang diperlukan
        $builder->select('o.id_order, o.tanggal_order, o.kode_order as invoice, c.nama as customer, p.metode_bayar, o.status, o.total');
        $builder->join('customer c', 'c.id_customer = o.id_customer', 'left');
        $builder->join('pembayaran p', 'p.id_order = o.id_order', 'left');

        // Filter tanggal
        $builder->where('o.tanggal_order >=', $dari);
        $builder->where('o.tanggal_order <=', $sampai);

        // Filter status jika ada
        if ($status !== '') {
            $builder->where('o.status', $status);
        }

        // Filter metode bayar jika ada
        if ($metode !== '') {
            $builder->where('o.pembayaran_id', $metode);
        }

        $builder->orderBy('o.tanggal_order', 'ASC');

        return $builder->get()->getResultArray();
    }
}
