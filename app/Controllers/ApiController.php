<?php

namespace App\Controllers;

use App\Models\RecipeModel;

class ApiController extends BaseController
{
    public function index()
    {
        return view('api_help');
    }

    /**
     * find recipes and return Json
     */
    public function recipes()
    {
        $model = new RecipeModel();
        $recipes = $model->findAllForApi();
        header('Content-Type: application/json');
        echo json_encode($recipes);
        die;
    }

    /**
     * find recipes and return Json with ingredients
     */
    public function recipesIngredients($idRecipe)
    {
        $model = new RecipeModel();
        $ingredient = $model->findIngredientsForApi($idRecipe);
        header('Content-Type: application/json');
        echo json_encode($ingredient);
        die;
    }

    /**
     * find recipes and return Json with preparation's steps
     */
    public function recipesSteps($idRecipe)
    {
        $model = new RecipeModel();
        $step = $model->findStepsForApi($idRecipe);
        header('Content-Type: application/json');
        echo json_encode($step);
        die;
    }


    /**
     * find recipes by category and return Json
     */
    public function category($cat)
    {
        $model = new RecipeModel();
        $recipes = $model->findAllFromCategoryForApi($cat);
        header('Content-Type: application/json');
        echo json_encode($recipes);
        die;
    }
}
