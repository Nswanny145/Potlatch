<?php

namespace App\Models;

use CodeIgniter\Model;

class Potlatch extends Model {
    protected $table = 'potlatch';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $allowedFields = ['user_id', 'title', 'description'];

}

?>