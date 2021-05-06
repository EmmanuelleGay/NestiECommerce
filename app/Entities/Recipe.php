<?php
namespace App\Entities;

use CodeIgniter\Entity;

use App\Models\TagModel;

class Recipe extends Entity
{

    public function getTag($idRecipe){
        $tagModel = new TagModel();
        
        return $tagModel->where("idRecipe", $idRecipe)->first();
    }

    public function getRecipeByTag(){
        
    }
}