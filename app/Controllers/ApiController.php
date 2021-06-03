<?php

namespace App\Controllers;

use App\Models\ApiLogModel;
use App\Models\RecipeModel;
use App\Models\TokenModel;

class ApiController extends BaseController
{
    public function index()
    {
        //   $token = bin2hex(random_bytes(20));

        $this->data["slug"] = "api";
        $this->twig->display('api_help', $this->data);
    }

    /**
     * find recipes and return Json
     */
    public function recipes()
    {
        if (isset($_GET['token'])) {
            $model = new TokenModel();
            $candidate = $model->findToken($_GET['token']);
            if ($candidate != null) {
                $modelApi = new ApiLogModel();
                $data['idToken'] = $candidate->idToken;
                $data['userAgent'] = $_SERVER['HTTP_USER_AGENT'];

                $modelApi->save($data);
                $model = new RecipeModel();
                $recipes = $model->findAllForApi();
                header('Content-Type: application/json');
                echo json_encode($recipes);
                die;
            } else {
                header("Content-Type: application/json");
                echo json_encode("Error 401 : erreur d'identification");
                die();
            }
        } else {
            return redirect()->to(base_url('api'));
        }
    }

    /**
     * find recipes and return Json with ingredients
     */
    public function recipesIngredients($idRecipe)
    {
        $model = new TokenModel();
        $candidate = $model->findToken($_GET['token']);
        if ($candidate != null) {
            $modelApi = new ApiLogModel();
            $data['idToken'] = $candidate->idToken;
            $data['userAgent'] = $_SERVER['HTTP_USER_AGENT'];

            $modelApi->save($data);
            $model = new RecipeModel();
            $ingredients = $model->findIngredientsForApi($idRecipe);
            header('Content-Type: application/json');
            echo json_encode($ingredients);
            die;
        } else {
            header("Content-Type: application/json");
            echo json_encode("Error 401 : erreur d'identification");
            die();
        }
    }

    /**
     * find recipes and return Json with preparation's steps
     */
    public function recipesSteps($idRecipe)
    {
        $model = new TokenModel();
        $candidate = $model->findToken($_GET['token']);

        if ($candidate != null) {
            $model = new RecipeModel();
            $step = $model->findStepsForApi($idRecipe);
            header('Content-Type: application/json');
            echo json_encode($step);
            die;
        } else {
            header("Content-Type: application/json");
            echo json_encode("Error 401 : erreur d'identification");
            die();
        }
    }



    /**
     * find recipes by category and return Json
     */
    public function category($cat)
    {

        $model = new TokenModel();
        $candidate = $model->findToken($_GET['token']);

        if ($candidate != null) {
            $model = new RecipeModel();
            $recipes = $model->findAllFromCategoryForApi($cat);

            $modelApi = new ApiLogModel();
            $data['idToken'] = $candidate->idToken;
            $data['userAgent'] = $_SERVER['HTTP_USER_AGENT'];

            $modelApi->save($data);


            header('Content-Type: application/json');
            echo json_encode($recipes);
            die;
        } else {
            header("Content-Type: application/json");
            echo json_encode("Error 401 : erreur d'identification");
            die();
        }
    }

    public function search($search)
    {
        $model = new TokenModel();
        $candidate = $model->findToken($_GET['token']);

        if ($candidate != null) {
            $modelApi = new ApiLogModel();
            $data['idToken'] = $candidate->idToken;
            $data['userAgent'] = $_SERVER['HTTP_USER_AGENT'];

            $modelApi->save($data);
            $model = new RecipeModel();
            $recipes = $model->searchRecipesForApi($search);
            header('Content-Type: application/json');
            echo json_encode($recipes);
            die();
        } else {
            header("Content-Type: application/json");
            echo json_encode("Error 401 : erreur d'identification");
            die();
        }
    }
}
