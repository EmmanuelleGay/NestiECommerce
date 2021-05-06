<?php

namespace App\Models;

use CodeIgniter\Model;

class IsTaggedModel extends Model
{
    protected $table = "nes_ad_istagged"; // nom de la table
    protected $returnType = 'App\Entities\IsTagged'; // Type de retour

}
