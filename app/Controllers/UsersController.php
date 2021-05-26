<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\CityModel;
use App\Entities\Users;
use App\Entities\City;
use App\Tools\FormatUtil;

class UsersController extends BaseController
{

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

      $userRules = FormatUtil::combineRules("userRules", "userRulesSignUp");

      if ($this->validate($userRules)) {

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
        $userModel->update($user->idUsers, $data);

        $this->data['message'] = "success";
        $this->data["loggedInUser"] = BaseController::getLoggedInUser(true);
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

      $userRules = FormatUtil::combineRules("userRules", "userRulesRegistration");

      if ($this->validate($userRules)) {

        $user = new Users();
        $user->setPasswordHashFromPlaintext($_POST["password"]);
        $user->flag = "a";
        $user->lastName = $_POST["lastName"];
        $user->firstName = $_POST["firstName"];
        $user->address1 = $_POST["address1"];
        $user->address2 = $_POST["address2"];
        $user->zipCode = $_POST["zipCode"];
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
  
    }

   
    $this->twig->display('users/registration', $this->data);
  }
}
