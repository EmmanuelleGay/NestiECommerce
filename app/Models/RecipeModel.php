<?php

namespace App\Models;

use CodeIgniter\Model;

class RecipeModel extends Model
{
    protected $table = "nes_ad_recipe"; 
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

// public function countComment($idRecipe){
//   $builder = $this->db->table('comment');
//   return $builder->get()->getResult();
// }

public function searchRecipe($name)
{
  return $this->like("name", $name)->findAll();
}
}
