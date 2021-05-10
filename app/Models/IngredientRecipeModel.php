<?php

namespace App\Models;

use CodeIgniter\Model;

class IngredientRecipeModel extends Model
{
    protected $table = "nes_ad_ingredientrecipe"; 
    protected $returnType = 'App\Entities\IngredientRecipe';

}
