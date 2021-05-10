<?php

namespace App\Entities;

use App\Models\RecipeModel;
use App\Models\TagModel;
use CodeIgniter\Entity;

class IsTagged extends Entity
{


    public function getRecipes($idRecipe)
    {
        $recipeModel = new RecipeModel();
        return  $recipeModel->where("idRecipe", $idRecipe)->findAll();

    }

    public function getTags($idTag)
    {
        $model = new TagModel();
        return  $model->find($idTag);
    }


}
