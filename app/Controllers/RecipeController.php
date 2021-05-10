<?php

namespace App\Controllers;

use App\Models\RecipeModel;
use App\Models\TagModel;
use App\Models\IsTaggedModel;

class Recipecontroller extends BaseController
{
	public function list()
	{
	$this->data["slug"] = "recipe";

	$tagModel = new TagModel();
	$tags = $tagModel->findAll();


	// $data["tags"] = $tags;

	// $recipeModel = new RecipeModel();
	// $recipes = $recipeModel->findAllForApi();
	// $data["recipes"] = $recipes;

	// $model = new IsTaggedModel();
	// $isTagged = $model->findAll();
	
	$this->data["tags"] = $tags;
	
 	$this->twig->display("recipe/list", $this->data);
		
	}

    public function oneRecipe($idRecipe){
		$this->data["slug"] = "recipe";

		$model = new RecipeModel();
		$recipe = $model->find($idRecipe);
		$this->data["recipe"] = $recipe;

		$this->twig->display('recipe/oneRecipe',$this->data);
    }

}