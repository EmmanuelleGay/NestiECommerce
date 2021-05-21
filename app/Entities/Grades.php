<?php
namespace App\Entities;


class Grades extends BaseEntity
{

    public function setRecipe($recipe){
        $this->idRecipe = $recipe->idRecipe ;
    }
}