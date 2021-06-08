<?php

namespace App\Controllers;

use App\Models\ArticleModel;
use App\Models\UsersModel;

class ArticleController extends BaseController
{	
	/**
	 * list
	 *
	 * @return void
	 */
	public function list()
	{
		$this->data["slug"] = "article";

		if (isset($_POST['article']['search']) && strlen($_POST['article']['search'])>2) {
			$articleModel = new ArticleModel();
			$articles = $articleModel->searchArticle($_POST['article']['search']);
			$this->data["articles"] = $articles;
		}
		else {
			$articleModel = new ArticleModel();
			$articles = $articleModel->where("flag","a")->findAll();
			$this->data["articles"] = $articles;
		}
		$this->twig->display('article/list', $this->data);
	}
	
	/**
	 * oneArticle
	 *
	 * @return void
	 */
	public function oneArticle()
	{
		$this->data["slug"] = "article";
		$this->twig->display('article/oneArticle', $this->data);
	}
}
