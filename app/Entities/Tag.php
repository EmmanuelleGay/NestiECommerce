<?php
namespace App\Entities;

use App\Models\IsTaggedModel;

class Tag extends BaseEntity
{

    public function getIsTagged($idTag)
    {
        $model = new IsTaggedModel();
        return  $model->where("idTag", $idTag)->findAll();
    }


}