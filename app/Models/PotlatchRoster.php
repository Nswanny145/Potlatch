<?php

namespace App\Models;

use CodeIgniter\Model;

class PotlatchRoster extends Model {
    protected $table = 'roster';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $allowedFields = ['potlatch_id', 'user_id', 'coins'];
}

?>