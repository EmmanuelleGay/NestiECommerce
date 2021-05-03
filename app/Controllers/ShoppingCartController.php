<?php

namespace App\Controllers;

class ShoppingCartController extends BaseController
{
	public function validOrder()
	{
		$data["slug"] = "shoppingCart";
		$this->twig->display('shoppingCart/validOrder',$data);
	}

}