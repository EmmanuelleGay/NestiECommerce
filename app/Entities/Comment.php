<?php
namespace App\Entities;


class Comment extends BaseEntity
{
    
    /**
     * setUser
     *
     * @param  mixed $user
     * @return void
     */
    public function setUser($user){
        $this->idUsers = $user->idUsers;
    }
    
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