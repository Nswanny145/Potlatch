<?php

namespace App\Models;

use CodeIgniter\Model;

class RosterInvite extends Model {
    protected $table = 'invite';
    protected $primaryKey = 'id';
    protected $returnType = 'array';

    protected $allowedFields = ['id', 'roster_id', 'email'];
}

?>