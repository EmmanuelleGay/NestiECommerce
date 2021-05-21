<?php
namespace App\Entities;


use App\Models\TagModel;
use App\Models\ImageModel;
use App\Models\GradesModel;
use App\Models\ParagraphModel;
use App\Models\IngredientRecipeModel;
use App\Models\CommentModel;


class Recipe extends BaseEntity
{

    public function getTag(){
        $tagModel = new TagModel();
        return $tagModel->where("idRecipe", $this->idRecipe)->first();
    }

    public function getImage(){
        $imageModel = new ImageModel();
        return $imageModel->where("idImage", $this->idImage)->first();
    }

    public function getComments(){
        $commentModel = new CommentModel();
        return $commentModel->where("idRecipe", $this->idRecipe)->orderBy('dateCreation', 'desc')->findAll();
    }

    public function getIngredientRecipe(){
    $modelIngredientRecipe = new IngredientRecipeModel();
    return $modelIngredientRecipe->where("idRecipe", $this->idRecipe)->findAll();
    }

    public function getParagraphs(){
        $model = new ParagraphModel();
        return  $model->where("idRecipe", $this->idRecipe)->orderBy('paragraphOrder', 'asc')->findAll();
    }

    public function getGrades(){
        $model = new GradesModel();
        return $model->where("idRecipe", $this->idRecipe)->findAll();
    }

    public function getGrade($user){
        $model = new GradesModel();
        return $model->where("idRecipe", $this->idRecipe)->where("idUsers", $user->idUsers)->first();
    }


}