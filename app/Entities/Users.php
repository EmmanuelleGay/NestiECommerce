<?php
namespace App\Entities;

use App\Models\CityModel;

class Users extends BaseEntity
{
    
    /**
     * isPassword
     *
     * @param  mixed $plainTextPassword
     * @return void
     */
    public function isPassword(String $plainTextPassword)
    {
        return password_verify($plainTextPassword, $this->passwordHash);
    }
    
    /**
     * setPasswordHashFromPlaintext
     *
     * @param  mixed $plaintextPassword
     * @return void
     */
    public function setPasswordHashFromPlaintext($plaintextPassword)
    {
        $this->passwordHash = password_hash($plaintextPassword, PASSWORD_DEFAULT);
    }

    
    /**
     * getCity
     *
     * @return void
     */
    public function getCity(){
        $cityModel = new CityModel();
        return $cityModel->where("idCity", $this->idCity)->first();
    }
}