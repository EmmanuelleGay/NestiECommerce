<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = "nes_ad_product"; 
    protected $returnType = 'App\Entities\Product';

}
