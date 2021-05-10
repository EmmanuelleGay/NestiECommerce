<?php

namespace App\Controllers;

use App\Models\ArticleModel;
use App\Models\UsersModel;

class ArticleController extends BaseController
{
	public function list()
	{
		$this->data["slug"] = "article";

		$articleModel = new ArticleModel();
		$articles = $articleModel->findAll();

		$this->data["articles"] = $articles;
	
		$this->twig->display('article/list',$this->data);
	}

	public function oneArticle()
	{
		$this->data["slug"] = "article";
		$this->twig->display('article/oneArticle', $this->data);
	}
}
