<?php

namespace App\Models;

use CodeIgniter\Model;

class ImageModel extends Model
{
    protected $table = "nes_ad_image";
    protected $returnType = 'App\Entities\Image'; 
    protected $primaryKey = 'idImage';

}