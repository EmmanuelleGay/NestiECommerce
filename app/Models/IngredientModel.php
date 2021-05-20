<?php

namespace App\Models;

use CodeIgniter\Model;

class IngredientModel extends Model
{
    protected $table = "nes_ad_ingredient"; 
    protected $returnType = 'App\Entities\Ingredient';
    protected $primaryKey = 'idIngredient';
}
