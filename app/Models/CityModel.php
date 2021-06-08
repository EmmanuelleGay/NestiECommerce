<?php

namespace App\Models;

use CodeIgniter\Model;

class CityModel extends Model
{
    protected $table = "nes_ad_city"; 
    protected $returnType = 'App\Entities\City';
    protected $primaryKey = "idCity";
    protected $allowedFields = ["name"];
    
    
    /**
     * findCity
     *
     * @param  mixed $name
     * @return Object
     */
    public function findCity($name) : Object
    {
       return $this->where("name", $name)->first();
    }


}
