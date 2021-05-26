<?php

namespace App\Controllers;

use App\Models\RecipeModel;

$session = \Config\Services::session();

class Home extends BaseController
{
	public function index()
	{

		
		if (!isset($_SESSION['visitedRecipe'])) {
			$_SESSION['visitedRecipe'] = [];
		}

		arsort($_SESSION['visitedRecipe']);

		$lastPage = array_slice($_SESSION['visitedRecipe'], 0, 5,true);

		$recipeModel = new RecipeModel();

		if (isset($_SESSION['visitedRecipe'])) {
			foreach($lastPage as $values => $key){
				$recipe =	$recipeModel->find($values);
				$this->data['recipes'][] = $recipe;
			}
		}

		$this->data["slug"] = "home";
		$this->twig->display('home', $this->data);
	}

	public function test()
	{
		return view('test');
	}
}
