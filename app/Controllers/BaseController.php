<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\UsersModel;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */

class BaseController extends Controller
{
	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = ["form", "security", "date", "inflector", "translation", "url", "format"];
	protected static $loggedInUser;
	/**
	 * Constructor.
	 *
	 * @param RequestInterface  $request
	 * @param ResponseInterface $response
	 * @param LoggerInterface   $logger
	 */




	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		$this->data["loggedInUser"]= null;
		if (isset($_COOKIE['user']['login'])){
			$this->data["loggedInUser"] = BaseController::getLoggedInUser();
		}
		
		$this->data["jsVars"] = [
			"baseUrl" => base_url(),
		];

		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.: $this->session = \Config\Services::session();
		$config = ["functions" => [
			"translate",
		]];
		$this->twig = new \Kenjis\CI4Twig\Twig($config);
	}

	/**
	 * getLoggedInUser 
	 * Get the value of user
	 *
	 * @param  mixed $refresh
	 */
	public static function getLoggedInUser($refresh = false)
	{
		if ($refresh || 
			(self::$loggedInUser == null && isset($_COOKIE['user']['login']) && isset($_COOKIE['user']['password']) ) ){
			$model = new UsersModel();

			$candidate = $model->findUser($_COOKIE['user']['login']);
			if ($candidate != null && $candidate->isPassword($_COOKIE['user']['password'])) {
				self::$loggedInUser = $candidate;
			};
		}
		return self::$loggedInUser;
	}
	
	/**
	 * setLoggedInUser
	 *
	 * @param  mixed $user
	 * @param  mixed $plaintextPassword
	 */
	public static function setLoggedInUser($user, $plaintextPassword = null)
	{
		if ($user != null) {
			self::$loggedInUser = $user;
			setcookie("user[login]", $user->login, 2147483647, '/');
			setcookie("user[password]", $plaintextPassword, 2147483647, '/');
		}
	}
}
