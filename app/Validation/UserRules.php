<?php
namespace App\Validation;
use App\Models\UserModel;

class UserRules
{
    public function validateUser(string $str, string $fiels, array $data){
        $model = model(UserModel::class);
        
        $user = $model->where('email', $data['email'])->first();
                      
        if(!$user){
            return false;
        }        
        //verif que le pwd est = pwd de la bdd
        return password_verify($data['password'], $user['password']);
    }
}