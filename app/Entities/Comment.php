<?php
namespace App\Entities;

use CodeIgniter\Entity;


class Comment extends Entity
{

    public function setUser($user){
        $this->idUsers = $user->idUsers;
    }

    public function setRecipe($recipe){
        $this->idRecipe = $recipe->idRecipe ;
    }
}