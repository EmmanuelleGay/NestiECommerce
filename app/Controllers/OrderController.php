<?php

namespace App\Controllers;

use App\Models\CommentModel;
use App\Entities\Orders;
use App\Entities\OrderLine;
use App\Models\OrderLineModel;
use App\Models\OrdersModel;

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
		$orderModel = new OrdersModel();

		$order->flag = "a";
		$order->setUser(static::getLoggedInUser());
		$orderModel->save($order);

		$idOrder = $orderModel->insertId();

		$orderLinesModel = new OrderLineModel();
		

		foreach($_POST["articles"] as $article){
			$orderLine = new OrderLine();
			$orderLine->idOrders = $idOrder;
			$orderLine->idArticle = $article["id"];
			$orderLine->quantity = $article["quantity"];

			$orderLinesModel->save($orderLine);
		}

		echo("success");
	}

	public function successPayment(){
		$this->data["slug"] = "order";
		$this->twig->display('order/successPayment',$this->data);
	}


}