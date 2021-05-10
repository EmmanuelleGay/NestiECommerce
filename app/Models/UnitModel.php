<?php

namespace App\Models;

use CodeIgniter\Model;

class UnitModel extends Model
{
    protected $table = "nes_ad_unit"; 
    protected $returnType = 'App\Entities\OrderLine';

}
