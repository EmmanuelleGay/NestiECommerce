<?php

namespace App\Models;

use CodeIgniter\Model;

class TokenModel extends Model
{
    protected $table = "nes_ad_token";
    protected $returnType = 'App\Entities\Token';
    protected $primaryKey = 'idToken';



    public function findToken($token)
    {
       return $this->where("token", $token)->first();
    }

}