<?php

namespace App\Models;

use CodeIgniter\Model;

class IsTaggedModel extends Model
{
    protected $table = "nes_ad_istagged"; 
    protected $returnType = 'App\Entities\IsTagged'; 

}
