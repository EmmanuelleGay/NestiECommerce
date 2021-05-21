<?php
namespace App\Entities;


class Users extends BaseEntity
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