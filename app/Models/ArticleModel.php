<?php

namespace App\Models;

use CodeIgniter\Model;

class ArticleModel extends Model
{
  protected $table = "nes_ad_article";
  protected $returnType = 'App\Entities\Article';
  protected $primaryKey = 'idArticle';

  /**
   * findArticles
   *
   * @return Object
   */
  public function findArticles() : Object
  {
    return $this->join('nes_ad_image', 'nes_ad_article.idImage = nes_ad_image.idImage', 'left');
  }


  
  /**
   * searchArticle
   *
   * @param  mixed $name
   * @return Object
   */
  public function searchArticle($name) : Object
  {
    return $this->where("flag", "a")->like("nameToDisplay", $name)->findAll();
  }
  
}
