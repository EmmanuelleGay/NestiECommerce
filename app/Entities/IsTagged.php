<?php

namespace App\Entities;

use App\Models\RecipeModel;
use App\Models\TagModel;


class IsTagged extends BaseEntity
{

    
    
    /**
     * getRecipes
     *
     * @param  mixed $idRecipe
     * @return array
     */
    public function getRecipes($idRecipe) : array
    {
        $recipeModel = new RecipeModel();
        return  $recipeModel->where("idRecipe", $idRecipe)->findAll();

    }
       
    /**
     * getTags
     *
     * @param  mixed $idTag
     * @return array
     */
    public function getTags($idTag) : array{
        $model = new TagModel();
        return  $model->find($idTag);
    }


}
