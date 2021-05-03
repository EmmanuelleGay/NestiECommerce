<?php

namespace App\Controllers;

use App\Models\TagModel;
use App\Models\RecipeModel;
use codeIgniter\http\requestInterface;

class Tagcontroller extends BaseController
{


    public function allTags()
    {
        $model = new TagModel();
        $tags = $model->findAll();
        $this->twig->display('tag/allTags', ['tags' => $tags]);
    }

    public function createTag()
    {
        $model = new TagModel();

        if (isset($_POST['Name'])) {
            $name = $_POST['Name'];
            $data = [
                "name" => $name
            ];
            $model->insert($data);
            $idTag = $model->getInsertID();
            return redirect()->to(base_url('oneTag/'.$idTag));
        }
        // var_dump($request->getPost());
            $this->twig->display('tag/createTag');
    }

    public function editTag($idTag)
    {
        $model = new tagModel();


        //faire avec un this request

        //la faire validaztoin 
        if (isset($_POST['name'])) {

            $name = $_POST['name'];
            $data = [
                "name" => $name
            ];
            $model->update($idTag, $data);
            $tag = $model->find($idTag);
            return redirect()->to(base_url('oneTag/'.$idTag));
        }

        $tag = $model->find($idTag);
        $this->twig->display('tag/editTag', ['tag' => $tag]);
    }

    public function oneTag($idTag)
    {
        $model = new tagModel();
        $tag = $model->find($idTag);
        $this->twig->display('tag/oneTag', ['tag' => $tag]);
    }

    public function searchTag()
    {
        $this->twig->display('tag/searchTag');
    }
}
