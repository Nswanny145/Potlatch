<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model {
    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $allowedFields = ['first_name', 'last_name', 'email', 'password'];

    public function createUser() {

    }

    public function checkCredentials($email, $password) {

    }
}

?>