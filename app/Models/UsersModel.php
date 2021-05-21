<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = "nes_ad_users";
    protected $returnType = 'App\Entities\Users'; 
    protected $allowedFields = ["lastName", "firstName", "email", "passwordHash", "flag", "login", "address1", "address2", "zipCode", "idCity"];
    protected $primaryKey = 'idUsers';

    public function findUser($login)
    {
       return $this->where("login", $login)->first();
    }

}
