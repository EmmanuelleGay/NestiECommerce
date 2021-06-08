<?php

namespace App\Models;

use CodeIgniter\Model;

class RecipeModel extends Model
{
  protected $table = "nes_ad_recipe";
  protected $returnType = 'App\Entities\Recipe';
  protected $primaryKey = 'idRecipe';

  
  /**
   * findAllForApi
   *
   * @return array
   */
  public function findAllForApi() : array
  {
    $builder = $this->db->table('view_api_recipes');
    return $builder->get()->getResult();
  }
  
  /**
   * findAllFromCategoryForApi
   *
   * @param  mixed $category
   * @return array
   */
  public function findAllFromCategoryForApi($category) : array
  {
    $builder = $this->db->table('view_api_recipes');
    $builder->where("cat", $category);
    return $builder->get()->getResult();
  }

      
  /**
   * findIngredientsForApi
   *
   * @param  mixed $idRecipe
   * @return array
   */
  public function findIngredientsForApi($idRecipe) : array
  {
    $builder = $this->db->table('view_api_recipe_ingredients');
    $builder->where("idRecipe", $idRecipe);
    return $builder->get()->getResult();
  }
  
  /**
   * findStepsForApi
   *
   * @param  mixed $idRecipe
   * @return array
   */
  public function findStepsForApi($idRecipe) : array
  {
    $builder = $this->db->table('view_api_recipe_steps');
    $builder->where("idRecipe", $idRecipe);
    return $builder->get()->getResult();
  }

  
  /**
   * searchRecipe
   *
   * @param  mixed $name
   * @return array
   */
  public function searchRecipe($name) : array
  {
    return $this->like("name", $name)->findAll();
  }
  
  /**
   * searchRecipesForApi
   *
   * @param  mixed $search
   * @return array
   */
  public function searchRecipesForApi($search) : array
  {
    $builder = $this->db->table('nes_ad_recipe');
    $builder->select('idRecipe , name');
    $builder->like("name", $search);
    return $builder->get()->getResult();
  }
}
