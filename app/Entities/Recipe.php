<?php
namespace App\Entities;

use CodeIgniter\Entity;

use App\Models\TagModel;
use App\Models\ImageModel;

class Recipe extends Entity
{

    public function getTag($idRecipe){
        $tagModel = new TagModel();
        
        return $tagModel->where("idRecipe", $idRecipe)->first();
    }


    public function getImage($idImage){
        $imageModel = new ImageModel();
        return $imageModel->where("idImage", $idImage)->first();
    }
}