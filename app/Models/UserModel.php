<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['firstname', 'lastname', 'phone', 'age', 'weight', 'height', 'weight_goal'];

    public function getUser($lastname = false)
    {
        if ($lastname === false) {
            return $this->findAll();
        }

        return $this->where(['lastname' => $lastname])->first();
    }
}