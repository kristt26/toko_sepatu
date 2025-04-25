<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemModel extends Model
{
    protected $table            = 'order_item';
    protected $primaryKey       = 'id_item';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_variant','qty', 'harga', 'id_order'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;
}
