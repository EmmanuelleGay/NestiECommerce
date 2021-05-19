<?php

namespace App\Models;

use CodeIgniter\Model;

class ParagraphModel extends Model
{
    protected $table = "nes_ad_paragraph"; 
    protected $returnType = 'App\Entities\Paragraph';

}
