<?php

namespace App\Controllers;

use App\Models\ArticleModel;
use App\Models\UsersModel;

class ArticleController extends BaseController
{
	public function list()
	{
		$data["loggedInUser"] = UsersController::getLoggedInUser();
		$data["slug"] = "article";

		$articleModel = new ArticleModel();
		$articles = $articleModel->findAll();

		$data["articles"] = $articles;
	
		$this->twig->display('article/list',$data);
	}

	public function oneArticle()
	{
		$data["loggedInUser"] = UsersController::getLoggedInUser();
		$data["slug"] = "article";
		$this->twig->display('article/oneArticle', $data);
	}
}
