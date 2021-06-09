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
    
    /**
     * getTag
     *
     * @return Object
     */
    public function getTag(): Object {
        $tagModel = new TagModel();
        return $tagModel->where("idRecipe", $this->idRecipe)->first();
    }
    
    
    /**
     * getImage
     *
     * @return Object
     */
    public function getImage() : Object {
        $imageModel = new ImageModel();
        return $imageModel->where("idImage", $this->idImage)->first();
    }
    
    
    /**
     * getComments
     *
     * @return array
     */
    public function getComments() : array {
        $commentModel = new CommentModel();
        return $commentModel->where("idRecipe", $this->idRecipe)->orderBy('dateCreation', 'desc')->findAll();
    }
    
     
    /**
     * getIngredientRecipe
     *
     * @return array
     */
    public function getIngredientRecipe() : array {
    $modelIngredientRecipe = new IngredientRecipeModel();
    return $modelIngredientRecipe->where("idRecipe", $this->idRecipe)->findAll();
    }
    
    
    /**
     * getParagraphs
     *
     * @return array
     */
    public function getParagraphs() : array {
        $model = new ParagraphModel();
        return  $model->where("idRecipe", $this->idRecipe)->orderBy('paragraphOrder', 'asc')->findAll();
    }
    
    
    /**
     * getGrades
     *
     * @return array
     */
    public function getGrades() : array {
        $model = new GradesModel();
        return $model->where("idRecipe", $this->idRecipe)->findAll();
    }
    
    
    /**
     * getGrade
     *
     * @param  mixed $user
     * @return array
     */
    public function getGrade($user) : array {
        $model = new GradesModel();
        return $model->where("idRecipe", $this->idRecipe)->where("idUsers", $user->idUsers)->first();
    }


}