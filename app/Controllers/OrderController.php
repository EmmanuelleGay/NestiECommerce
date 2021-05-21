<?php

namespace App\Controllers;

use App\Models\CommentModel;
use App\Entities\Orders;

class OrderController extends BaseController
{
	public function validOrder()
	{

		$security = \Config\Services::security();
	
		$this->data["slug"] = "order";

		 $this->data["jsVars"]["csrfName"] = $security->getCSRFTokenName();
		 $this->data["jsVars"]["csrfHash"] = $security->getCSRFHash();

		$this->twig->display('order/validOrder',$this->data);
	}


	public function saveOrder(){
		$order = new Orders();
		dump("test");
	}
}