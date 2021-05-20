<?php
namespace App\Entities;

use CodeIgniter\Entity;
class Users extends Entity
{

    public function isPassword(String $plainTextPassword)
    {
        return password_verify($plainTextPassword, $this->passwordHash);
    }

    public function setPasswordHashFromPlaintext($plaintextPassword)
    {
        $this->passwordHash = password_hash($plaintextPassword, PASSWORD_DEFAULT);
    }

}