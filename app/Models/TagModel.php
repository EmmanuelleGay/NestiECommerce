<?php

namespace App\Models;

use CodeIgniter\Model;

class TagModel extends Model
{
    protected $table = "nes_ad_tag"; 
    protected $allowedFields = ['name']; 
    protected $returnType = 'App\Entities\Tag';
    protected $useTimestamps = true; 

}
