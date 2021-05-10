<?php

namespace App\Entities;

use App\Models\ImageModel;
use App\Models\ArticlePriceModel;
use CodeIgniter\Entity;

class Article extends Entity
{

    // public function getImage($idImage){
    //     $modelImage = new ImageModel();
    //     $image = $modelImage->find($idImage);

    //     return $image;
    // }

    //     $builder = $this->db->table('view_api_recipe_steps');
    //     $builder->where("idRecipe", $idRecipe);
    //     return $builder->get()->getResult();


    public function getPrice($idArticle)
    {
        // $price = "";
        // $builder = $this->db->table('nes_ad_articleprice');
        // $builder->where("idArticle", $idArticle);
        // return $builder->get()->getResult();
        $ArticlePriceModel = new ArticlePriceModel();
        return $ArticlePriceModel->where("idArticle", $idArticle)->first();
    }

    public function getImage($idImage){
        $imageModel = new ImageModel();
        return $imageModel->where("idImage", $idImage)->first();
    }
}
