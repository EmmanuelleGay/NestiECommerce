<?php

namespace App\Models;

use CodeIgniter\Model;

class TagModel extends Model
{
    protected $table = "nes_ad_tag"; // nom de la table
    protected $allowedFields = ['name']; // Nom des colonnes autorisées : mettre toutes les colonnes a enregistrer, insérer ou mise à jour
    protected $returnType = 'App\Entities\Tag'; // Type de retour
    protected $useTimestamps = true; // Utilisation du timestamps : colonne created_at, updated_at

}
