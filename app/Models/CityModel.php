<?php

namespace App\Models;

use CodeIgniter\Model;

class CityModel extends Model
{
    protected $table = "nes_ad_city"; 
    protected $returnType = 'App\Entities\City';
    protected $primaryKey = "idCity";
    protected $allowedFields = ["name"];

    public function findCity($name)
    {
       return $this->where("name", $name)->first();
    }


}
