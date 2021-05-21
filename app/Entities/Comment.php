<?php
namespace App\Entities;


class Comment extends BaseEntity
{

    public function setUser($user){
        $this->idUsers = $user->idUsers;
    }

    public function setRecipe($recipe){
        $this->idRecipe = $recipe->idRecipe ;
    }
}