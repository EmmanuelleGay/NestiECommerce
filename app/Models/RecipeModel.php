<?php

namespace App\Models;

use CodeIgniter\Model;

class RecipeModel extends Model
{
    protected $table = "nes_ad_recipe"; // nom de la table
 //   protected $allowedFields = ['name']; // Nom des colonnes autorisées : mettre toutes les colonnes a enregistrer, insérer ou mise à jour
    protected $returnType = 'App\Entities\Recipe'; // Type de retour
    // protected $useTimestamps = true; // Utilisation du timestamps : colonne created_at, updated_at
    protected $primaryKey = 'idRecipe';

    public function findAllForApi() {
   //     $query = $this->db->query('SELECT * FROM view_api_recipes');
   //     return $query->getResult();

        $builder = $this->db->table('view_api_recipes');
        return $builder->get()->getResult();
        }

  public function findAllFromCategoryForApi($category) {
  //  $query = $this->db->query('SELECT * FROM view_api_recipes var WHERE var.cat = "glutenFree"');
  $builder = $this->db->table('view_api_recipes');
  $builder->where("cat", $category);
  return $builder->get()->getResult();
  }

public function findIngredientsForApi($idRecipe){
  $builder = $this->db->table('view_api_recipe_ingredients');
  $builder->where("idRecipe",$idRecipe);
  return $builder->get()->getResult();
}

public function findStepsForApi($idRecipe){
  $builder = $this->db->table('view_api_recipe_steps');
  $builder->where("idRecipe",$idRecipe);
  return $builder->get()->getResult();
}




}
