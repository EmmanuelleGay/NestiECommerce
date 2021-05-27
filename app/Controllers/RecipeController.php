<?php

namespace App\Controllers;

use App\Models\RecipeModel;
use App\Models\TagModel;
use App\Models\GradesModel;
use App\Entities\Grades;
use App\Models\CommentModel;
use App\Entities\Comment;

$session = \Config\Services::session();

class Recipecontroller extends BaseController
{
	public function list()
	{
		$this->data["slug"] = "recipe";


		if (isset($_POST['recipe']['search'])) {
			$recipeModel = new RecipeModel();
			$recipes = $recipeModel->searchRecipe($_POST['recipe']['search']);
			$this->data["recipes"] = $recipes;
		} else {
			$tagModel = new TagModel();
			$tags = $tagModel->findAll();
			$this->data["tags"] = $tags;
		}
	
		$this->twig->display("recipe/list", $this->data);
	}

	public function oneRecipe($idRecipe)
	{
		$this->data["slug"] = "recipe";

		$model = new RecipeModel();
		$recipe = $model->find($idRecipe);
		$this->data["recipe"] = $recipe;

		//user add a grade to a recipe
		if (isset($_POST['recipe']['grade'])) {
			$rating = sanitize_filename($_POST['recipe']['grade']);
			if ($rating > 0 && $rating < 6) {
				$modelGrade = new GradesModel();
				$grade = $recipe->getGrade(static::getLoggedInUser());
				if ($grade == null) {
					$grade = new Grades();
					$grade->setUser(static::getLoggedInUser());
					$grade->setRecipe($recipe);
					$grade->rating = $rating;

					$modelGrade->save($grade);
				} else {
					$grade->rating = $rating;
					$modelGrade->save($grade);
				}
				$this->data["message"] = "gradeSuccess";
			} else {
				$this->data["message"] = "gradeFailed";
			}
		}

		//user add a comment to a recipe
		if(isset($_POST['recipe']['commentTitle'])){
			$commentTitle = sanitize_filename($_POST['recipe']['commentTitle']);
			$commentContent = sanitize_filename($_POST['recipe']['commentContent']);
			if(!empty($commentTitle) &&!empty ($commentContent)){
				$commentModel = new CommentModel();
				$comment = new Comment();
				$comment->setRecipe($recipe);
				$comment->setUser(static::getLoggedInUser());
				$comment->commentTitle = $commentTitle;
				$comment->commentContent = $commentContent;
				$comment->flag = "w";

				$commentModel->save($comment);
				$this->data["message"] = "commentSuccess";
			}
			else {
				$this->data["message"] = "commentFailed";
			}
		}

		$_SESSION['visitedRecipe'][$idRecipe] = date("Y-m-d H:i:s") ;
	
		$this->twig->display('recipe/oneRecipe', $this->data);
	}
}
