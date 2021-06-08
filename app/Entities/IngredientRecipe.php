<?php
namespace App\Entities;


use App\Models\UnitModel;
use App\Models\ProductModel;

class IngredientRecipe extends BaseEntity
{
    
    
    /**
     * getUnit
     *
     * @param  mixed $idUnit
     * @return Object
     */
    public function getUnit($idUnit) : Object {
        $model = new UnitModel();
        return $model->where("idUnit" ,$idUnit )->first();
    }

    
    /**
     * getProduct
     *
     * @param  mixed $idIngredient
     * @return Object
     */
    public function getProduct($idIngredient) : Object{
    $model = new ProductModel();
    return $model->where("idProduct", $idIngredient)->first();
    }
}