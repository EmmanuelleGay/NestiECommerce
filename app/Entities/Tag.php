<?php
namespace App\Entities;

use App\Models\IsTaggedModel;

class Tag extends BaseEntity
{
    
    
    /**
     * getIsTagged
     *
     * @param  mixed $idTag
     * @return Object
     */
    public function getIsTagged($idTag) : Object
    {
        $model = new IsTaggedModel();
        return  $model->where("idTag", $idTag)->findAll();
    }


}