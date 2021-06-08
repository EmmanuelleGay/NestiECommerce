<?php

namespace App\Entities;

use App\Models\ImageModel;
use App\Models\ArticlePriceModel;


class Article extends BaseEntity
{

    /**
     * getPrice
     *
     * @param  mixed $idArticle
     * @return Object
     */
    public function getPrice($idArticle) : Object
    {
        $ArticlePriceModel = new ArticlePriceModel();
        return $ArticlePriceModel->where("idArticle", $idArticle)->first();
    }
    
    /**
     * getImage
     *
     * @param  mixed $idImage
     * @return Object
     */
    public function getImage($idImage) : Object {
        $imageModel = new ImageModel();
        return $imageModel->where("idImage", $idImage)->first();
    }


}
