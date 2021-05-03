<?php

namespace App\Controllers;

class ArticleController extends BaseController
{
	public function list()
	{
		$data["slug"] = "article";
		$this->twig->display('article/list',$data);
	}

    public function oneArticle(){
		$data["slug"] = "article";
		$this->twig->display('article/oneArticle',$data);
    }

}