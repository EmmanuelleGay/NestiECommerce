<?php

namespace App\Models;

use CodeIgniter\Model;

class ArticlePriceModel extends Model
{
    protected $table = "nes_ad_articleprice"; 
    protected $returnType = 'App\Entities\ArticlePrice';

}
