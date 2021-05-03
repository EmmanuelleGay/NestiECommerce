<?php
namespace App\Entities;

use CodeIgniter\Entity;
class Users extends Entity
{



    public function isPassword(String $plainTextPassword)
    {
        return password_verify($plainTextPassword, $this->passwordHash);
    }

}