<?php

namespace App\Models;

use CodeIgniter\Model;

class ApiLogModel extends Model
{
    protected $table = "nes_ad_apilog";
    protected $returnType = 'App\Entities\ApiLog';
    protected $primaryKey = 'idApiLog';
    protected $allowedFields = ['idToken', 'userAgent'];
}