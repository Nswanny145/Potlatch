<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemBid extends Model {
    protected $table = 'bid';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $allowedFields = ['item_id', 'user_id', 'amount'];
}

?>