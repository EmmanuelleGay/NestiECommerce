<?php

namespace App\Models;

use CodeIgniter\Model;

class GradesModel extends Model
{
    protected $table = "nes_ad_grades"; 
    protected $returnType = 'App\Entities\Grades';

}