<?php
namespace App\Entities;


class Grades extends BaseEntity
{
    
    /**
     * setRecipe
     *
     * @param  mixed $recipe
     * @return void
     */
    public function setRecipe($recipe){
        $this->idRecipe = $recipe->idRecipe ;
    }
}