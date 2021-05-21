<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderLineModel extends Model
{
    protected $table = "nes_ad_orderline"; 
    protected $returnType = 'App\Entities\OrderLine';
    protected $allowedFields = ["idOrders" , "idArticle" , "quantity"];

}
