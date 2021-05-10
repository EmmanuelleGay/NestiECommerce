<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		$this->data["slug"] = "home";
		$this->twig->display('home',$this->data);
	}

	public function test()
	{
		return view('test');
	}

}
