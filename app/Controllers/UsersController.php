<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\CityModel;
use App\Entities\Users;
use App\Entities\City;

class UsersController extends BaseController
{



  protected $rules = [
    'lastName'  =>  "required|max_length[150]",
    'firstName' => "required|max_length[150]",
    'address1'  => "required|max_length[150]",
    'address2'  => 'max_length[150]',
    'zipCode'   => [
      "rules" => "required|max_length[5]|numeric",
      "errors" => [
        "numeric" => "Le code postal est incorrect, veuillez vérifier votre saisie"
      ]
    ],
    'city'      => "required|max_length[50]"
  ];




  public function login()
  {

    if (isset($_POST['User']['login'])) {

      $login = sanitize_filename($_POST['User']['login']);
      $plaintextPassword = sanitize_filename($_POST['User']['password']);

      $model = new UsersModel();
      $candidate = $model->findUser($login);


      if ($candidate != null && $candidate->isPassword($plaintextPassword)) {

        BaseController::setLoggedInUser($candidate, $plaintextPassword);

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



  public function oneUser()
  {
    $this->data["slug"] = "user";


    if (isset($_POST['login'])) {
  
      
        $this->rules ["email"] = [
              'rules' => 'required|valid_email',
                "valid_email" => "Le format de l'email est incorrect"
        ];

        $this->rules["login"] = [
          "rules" => "required|max_length[50]"
        ];


      if ($this->validate($this->rules)) {

        $userModel = new UsersModel();
        $user = BaseController::getLoggedInUser();

        $citymodel = new CityModel();
        $city = $citymodel->findCity($_POST["city"]);

        if ($city == null) {
          $city = new City();
          $city->name = $_POST["city"];
          $citymodel->save($city);
          $user->idCity = $citymodel->insertID();
        } 

           $data = $_POST;
           $data["idCity"] = $city->idCity;
           $userModel->update($user->idUsers,$data);

        $this->data['message'] = "success";
        $this->data["loggedInUser"]= BaseController::getLoggedInUser(true);

      } else {
        $this->data['validation'] = $this->validator;
        $this->data["isSubmitted"] = true;
      };

      }


    $this->twig->display('users/oneUser', $this->data);
  }



  public function registration()
  {
    $this->data["slug"] = "user";

    $userModel = new UsersModel();
  
    if (isset($_POST['login'])) {

        $rules = [
          'lastName'  =>  "required|max_length[150]",
          'firstName' => "required|max_length[150]",
          'address1'  => "required|max_length[150]",
          'address2'  => 'max_length[150]',
          'zipcode'   => [
            "rules" => "required|max_length[5]|numeric",
            "errors" => [
              "numeric" => "Le code postal est incorrect, veuillez vérifier votre saisie"
            ]
          ],
          'city'      => "required|max_length[50]",
          'email'     => [
            'rules' => 'required|valid_email|is_unique[nes_ad_users.email]',
            'errors' => [
              "is_unique" => "Un compte utilisateur ayant cette adresse email existe déjà.",
              "valid_email" => "Le format de l'email est incorrect"
            ]
          ],
          'password'  => [
            "rules" =>  "required|regex_match[/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/]",
            "errors" => [
              "regex_match" => "Le mot de passe doit contenir au moins 8 caractères dont une majuscule, une minuscule, un chiffre."
            ]
          ],
          'password2' => [
            "rules"   =>   "required|matches[password]",
            "errors"  => [
              "matches" => "Les mots de passe ne correspondent pas"
            ]
          ],
          'login' => [
            "rules" => "required|is_unique[nes_ad_users.login]|max_length[50]",
            "errors" => [
              "is_unique" => "Le nom d'utilisateur existe déjà, merci d'en choisir un autre"
            ]
          ]
        ];
      }
     
      if ($this->validate($rules)) {

        $user = new Users();
        $user->setPasswordHashFromPlaintext($_POST["password"]);
        $user->flag = "a";
        $user->lastName = $_POST["lastname"];
        $user->firstName = $_POST["firstname"];
        $user->address1 = $_POST["address1"];
        $user->address2 = $_POST["address2"];
        $user->zipCode = $_POST["zipcode"];
        $user->email = $_POST["email"];
        $user->login =  $_POST["login"];

        $citymodel = new CityModel();
        $city = $citymodel->findCity($_POST["city"]);


        if ($city == null) {
          $city = new City();
          $city->name = $_POST["city"];
          $citymodel->save($city);
          $user->idCity = $citymodel->insertID();
        } else {
          $user->idCity = $city->idCity;
        }

        $userModel->save($user);

        $this->data['message'] = "success";

      } else {
        $this->data['validation'] = $this->validator;
        $this->data["isSubmitted"] = true;
      };
    
    $this->twig->display('users/registration', $this->data);

  }
}
