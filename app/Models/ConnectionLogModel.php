<?php

namespace App\Models;

use CodeIgniter\Model;

class ConnectionLogModel extends Model
{
    protected $table = "nes_ad_connectionlog"; 
    protected $returnType = 'App\Entities\Connectionlog';

}
