<?php

namespace App\Models;

use CodeIgniter\Model;

class TokenModel extends Model
{
    protected $table = "nes_ad_token";
    protected $returnType = 'App\Entities\Token';
    protected $primaryKey = 'idToken';


    
    /**
     * findToken for API
     *
     * @param  mixed $token
     * @return Object
     */
    public function findToken($token) : Object
    {
       return $this->where("token", $token)->first();
    }

}