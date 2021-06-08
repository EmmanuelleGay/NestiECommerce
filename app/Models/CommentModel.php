<?php

namespace App\Models;

use CodeIgniter\Model;

class CommentModel extends Model
{
    protected $table = "nes_ad_comment"; 
    protected $returnType = 'App\Entities\Comment';
    protected $allowedFields = ["idRecipe", "idUsers", "commentTitle", "commentContent", "flag"];
    protected $primaryKey = "idComment";

}
