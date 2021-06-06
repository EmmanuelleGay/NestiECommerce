<?php

namespace App\Models;

use CodeIgniter\Model;

class ArticleModel extends Model
{
  protected $table = "nes_ad_article";
  protected $returnType = 'App\Entities\Article';
  protected $primaryKey = 'idArticle';

  // public function getImage($idImage){
  //     $modelImage = new ImageModel();
  //     $image = $modelImage->find($idImage);

  //     return $image;
  // }


  public function findArticles()
  {
  //    $builder = $this->db->table('nes_ad_article');
  //   $builder->join('nes_ad_image','nes_ad_article.idImage = nes_ad_image.idImage', 'left');
  //   $articles = $builder->get()->getResult();

 //    return $builder->get()->getResult();

    return $this->join('nes_ad_image', 'nes_ad_article.idImage = nes_ad_image.idImage', 'left');
  }



  public function searchArticle($name)
  {
    return $this->where("flag", "a")->like("nameToDisplay", $name)->findAll();
  }
  
  // public function getPrice($idArticle)
  // {
  //     $price = "";
  //     $builder = $this->db->table('nes_ad_articleprice');
  //     $builder->where("idArticle", $idArticle);
  //     return $builder->get()->getResult();
  // }



  //     $builder = $this->db->table('view_api_recipe_steps');
  //     $builder->where("idRecipe", $idRecipe);
  //     return $builder->get()->getResult();

}
