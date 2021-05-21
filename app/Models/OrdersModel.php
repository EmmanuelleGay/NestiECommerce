<?php

namespace App\Models;

use CodeIgniter\Model;

class OrdersModel extends Model
{
    protected $table = "nes_ad_orders"; 
    protected $returnType = 'App\Entities\Orders';
    protected $primaryKey = 'idOrders';
    protected $allowedFields = ["flag", "idUsers"];

    
}
