<?php

namespace App\Models;

use CodeIgniter\Model;

class GradesModel extends Model
{
    protected $table = "nes_ad_grades"; 
    protected $returnType = 'App\Entities\Grades';
    protected $allowedFields = ['rating', 'idRecipe', 'idUsers'];


    
    /**
     * findRecipe
     *
     * @param  mixed $idRecipe
     * @return Object
     */
    public function findRecipe($idRecipe) : Object
    {
       return $this->where("idRecipe", $idRecipe)->first();
    }

}
