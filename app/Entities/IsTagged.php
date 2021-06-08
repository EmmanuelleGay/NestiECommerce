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
     * @return Object
     */
    public function getRecipes($idRecipe) : Object
    {
        $recipeModel = new RecipeModel();
        return  $recipeModel->where("idRecipe", $idRecipe)->findAll();

    }
       
    /**
     * getTags
     *
     * @param  mixed $idTag
     * @return Object
     */
    public function getTags($idTag) : Object
    {
        $model = new TagModel();
        return  $model->find($idTag);
    }


}
