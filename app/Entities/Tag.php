<?php
namespace App\Entities;

use App\Models\IsTaggedModel;

class Tag extends BaseEntity
{
    
    
    /**
     * getIsTagged
     *
     * @param  mixed $idTag
     * @return array
     */
    public function getIsTagged($idTag) : array
    {
        $model = new IsTaggedModel();
        return  $model->where("idTag", $idTag)->findAll();
    }


}