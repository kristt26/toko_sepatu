<?php

namespace App\Models;

use CodeIgniter\Model;

class VariantModel extends Model
{
    protected $table            = 'variant';
    protected $primaryKey       = 'id_variant';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_produk','ukuran', 'warna', 'gambar', 'stok'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;
}
