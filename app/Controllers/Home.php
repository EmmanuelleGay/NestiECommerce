<?php

namespace App\Controllers;

use App\Models\RecipeModel;

$session = \Config\Services::session();

class Home extends BaseController
{	
	/**
	 * index
	 *
	 * @return void
	 */
	public function index()
	{

		
		if (!isset($_SESSION['visitedRecipe'])) {
			$_SESSION['visitedRecipe'] = [];
		}
	
		arsort($_SESSION['visitedRecipe']);

		$lastPage = array_slice($_SESSION['visitedRecipe'], 0, 4,true);

		$recipeModel = new RecipeModel();

		if (isset($_SESSION['visitedRecipe'])) {
			foreach($lastPage as $key => $values){
				$recipe =	$recipeModel->find($key);
				$this->data['recipes'][] = $recipe;
			}
		}

		$this->data["slug"] = "home";
		$this->twig->display('home', $this->data);
	}
	
	/**
	 * test
	 *
	 * @return void
	 */
	public function test()
	{
		return view('test');
	}
}
