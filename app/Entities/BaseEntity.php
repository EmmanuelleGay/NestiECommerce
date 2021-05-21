<?php

namespace App\Entities;

use CodeIgniter\Entity;

class BaseEntity extends Entity
{


    public function setUser($user){
        $this->idUsers = $user->idUsers;
    }

}
