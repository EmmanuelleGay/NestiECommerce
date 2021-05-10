<?php
namespace App\Entities;

use App\Models\IsTaggedModel;
use CodeIgniter\Entity;
class Tag extends Entity
{

    public function getIsTagged($idTag)
    {
        $model = new IsTaggedModel();
        return  $model->where("idTag", $idTag)->findAll();
    }


}