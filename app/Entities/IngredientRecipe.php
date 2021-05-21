<?php
namespace App\Entities;


use App\Models\UnitModel;
use App\Models\ProductModel;

class IngredientRecipe extends BaseEntity
{

    public function getUnit($idUnit){
        $model = new UnitModel();
        return $model->where("idUnit" ,$idUnit )->first();
    }


    public function getProduct($idIngredient){
    $model = new ProductModel();
    return $model->where("idProduct", $idIngredient)->first();
    }
}