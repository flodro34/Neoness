<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    //propriétés du model 
    protected $table = 'users';
    protected $allowedFields = ['firstname', 'lastname','email', 'password', 'phone', 'age', 'weight', 'height', 'weight_goal', 'bmi', 'slug', 'updated_at'];
    protected $beforeInsert = array("beforeInsert");
    protected $beforeUpdate = array("beforeUpdate");

    public function getUser($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }

    // hashage avant l'insersion en bdd
    public function beforeInsert(array $data){
        $data = $this->passwordHash($data);
        return $data;
    }
    //hashage lors d'une modif du pwd
    public function beforeUpdate(array $data){
        $data = $this->passwordHash($data);
        return $data;
    }

    //fct de hashage du pwd:
    public function passwordHash(array $data){
        if(isset( $data['data']['password'])){
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_BCRYPT);
        }
        return $data;
    }
}