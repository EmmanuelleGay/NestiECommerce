<?php

namespace App\Entities;

use CodeIgniter\Entity;

class BaseEntity extends Entity
{

    
    /**
     * setUser
     *
     * @param  mixed $user
     */
    public function setUser($user){
        $this->idUsers = $user->idUsers;
    }

}
