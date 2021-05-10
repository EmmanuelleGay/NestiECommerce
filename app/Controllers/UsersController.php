<?php

namespace App\Controllers;

use App\Models\UsersModel;



class UsersController extends BaseController
{

  protected static $loggedInUser;

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

        self::setLoggedInUser($candidate, $plaintextPassword);

      //   $dataSession = array(
      //     'username' => $candidate->login
      //   );
      //  $this->session->set_userdata($dataSession);
      //   $this->twig->addGlobal("session",$candidate->login);
       

       // $this->twig->display('recipe/oneRecipe',$data);
        return redirect()->to(base_url('home'));
        exit();
       
      }
      else {
        $this->data["message"] = "failed";
      }
        
    }

    $this->twig->display('users/login',$this->data);
  }

  public function logout(){
    self::setLoggedInUser(null);
    $this->data["message"] = "logout";
    $this->twig->display('users/login',$this->data);
  }

     /**
     * Get the value of user
     */
    public static function getLoggedInUser()
    {
        if (self::$loggedInUser == null &&  isset($_COOKIE['user'])) {
          $model = new UsersModel();
            $candidate = $model->findUser($_COOKIE['user']['login']);
            if ($candidate != null && $candidate->isPassword($_COOKIE['user']['password'])) {
                self::$loggedInUser = $candidate;
            };
        }
        return self::$loggedInUser;
    }

    public static function setLoggedInUser($user, $plaintextPassword = null)
    {
        if ($user != null) {
            self::$loggedInUser = $user;
            setcookie("user[login]", $user->login, 2147483647, '/');
            setcookie("user[password]", $plaintextPassword, 2147483647, '/');
        }
    }

}
