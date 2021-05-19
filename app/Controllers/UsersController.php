<?php

namespace App\Controllers;

use App\Models\UsersModel;

class UsersController extends BaseController
{



  public function oneUser()
  {
    $this->data["slug"] = "user";
    $this->twig->display('users/oneUser', $this->data);
  }


  public function login()
  {

    if (isset($_POST['User']['login'])) {

      $login = sanitize_filename($_POST['User']['login']);
      $plaintextPassword = sanitize_filename($_POST['User']['password']);

      $model = new UsersModel();
      $candidate = $model->findUser($login);


      if ($candidate != null && $candidate->isPassword($plaintextPassword)) {

        //   $data["login"] = $candidate->login;

        // if(isset($_POST['User']['connectedChexbox'])){
        //   setcookie("user[login]", $candidate->login, 2147483647, '/');
        //   setcookie("user[password]", $plaintextPassword, 2147483647, '/');
        // }

        BaseController::setLoggedInUser($candidate, $plaintextPassword);

        //   $dataSession = array(
        //     'username' => $candidate->login
        //   );
        //  $this->session->set_userdata($dataSession);
        //   $this->twig->addGlobal("session",$candidate->login);


        // $this->twig->display('recipe/oneRecipe',$data);
        return redirect()->to(base_url('home'));
        exit();
      } else {
        $this->data["message"] = "failed";
      }
    }

    $this->twig->display('users/login', $this->data);
  }

  public function logout()
  {
    BaseController::setLoggedInUser(null);
    $this->data["message"] = "logout";
    setcookie("user[login]", null, 2147483647, '/');
    setcookie("user[password]", null, 2147483647, '/');
    $this->twig->display('users/login', $this->data);
  }

  public function registration()
  {
    $this->data["slug"] = "user";

    if (isset($_POST['login'])) {

      $rules = [
        'lastname'  =>  "required|max_length[150]",
        'firstname' => "required|max_length[150]",
        'address1'  => "required|max_length[150]",
        'address2'  => 'max_length[150]',
        'zipcode'   => "required|max_length[5]|numeric",
        'city'      => "required|max_length[50]",
        'email'     => [
          'rules' => 'required|valid_email|is_unique[nes_ad_users.email]',
          'errors' => [
            "is_unique" => "Un compte utilisateur ayant cette adresse existe déjà.",
            "valid_email" => "Le format de l'email est incorrect"
          ]
        ],
        'phone'     => "required|numeric",
        'password'  => "required",
        'password2' => [
          "rules"   =>   "required|matches[password]",
          "errors"  => [
            "matches" => "Les mots de passe ne correspondent pas"
          ]
        ],
        'login' => [
          "rules" => "required|is_unique[nes_ad_users.login]",
          "errors" => [
            "is_unique" => "Le nom d'utilisateur existe déjà, merci d'en choisir un autre"
          ]
        ]
      ];


      if ($this->validate($rules)) {

      } else {
        $this->data['validation'] = $this->validator;
      };
    }

    $this->twig->display('users/registration', $this->data);
  }
}
