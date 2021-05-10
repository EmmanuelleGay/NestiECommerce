<?php

namespace App\Controllers;

class ShoppingCartController extends BaseController
{
	public function validOrder()
	{
		$this->data["slug"] = "shoppingCart";
		$this->twig->display('shoppingCart/validOrder',$this->data);
	}

}