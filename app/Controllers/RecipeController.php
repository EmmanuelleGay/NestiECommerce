<?php

namespace App\Controllers;

class Recipecontroller extends BaseController
{
	public function list()
	{
		//a voir pour le mettre en base controlleur pour éviter de devoir le mettre partout
	$data["loggedInUser"] = UsersController::getLoggedInUser();
	$data["slug"] = "recipe";
 	$this->twig->display("recipe/list", $data);
	}

    public function oneRecipe(){
		$data["loggedInUser"] = UsersController::getLoggedInUser();
		$data["slug"] = "recipe";
		$this->twig->display('recipe/oneRecipe', $data);
    }

}