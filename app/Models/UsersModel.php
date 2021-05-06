<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = "nes_ad_users";
    //protected $allowedFields = ['passwordHash'];
    protected $returnType = 'App\Entities\Users'; // Type de retour
    // protected $useTimestamps = true; // Utilisation du timestamps : colonne created_at, updated_at


    public function findUser($login)
    {
       return $this->where("login", $login)->first();

        // $builder = $this->db->table("nes_ad_users");
        // $builder->where("login", $login);
        // return $builder->get();
    }


    // public function findStepsForApi($idRecipe)
    // {
    //     $builder = $this->db->table('view_api_recipe_steps');
    //     $builder->where("idRecipe", $idRecipe);
    //     return $builder->get()->getResult();
    // }


}
