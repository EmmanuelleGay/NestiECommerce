<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		$data["loggedInUser"] = UsersController::getLoggedInUser();
		$data["slug"] = "home";
		$this->twig->display('home',$data);
	}

	public function test()
	{
		return view('test');
	}

}
