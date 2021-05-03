<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('test', 'Home::test');
// //a gauche : l'url (le slug), a droite l'endroit ou il doit aller ; d'abord le controller, après c'est le nom de la fonction
//$routes->add('allTags','Tagcontroller::allTags');
//$routes->add('createTag','Tagcontroller::createTag');
//$routes->add('editTag/(:num)','Tagcontroller::editTag/$1');
//$routes->add('oneTag/(:num)','Tagcontroller::oneTag/$1');

$routes->add('recette','RecipeController::list');
$routes->add('recette/(:num)','RecipeController::oneRecipe');

$routes->add('article','ArticleController::list');
$routes->add('article/(:num)','ArticleController::oneArticle');

$routes->add('panier','ShoppingCartController::validOrder');

$routes->add('compte/(:num)','UsersController::oneUser');
$routes->add('connexion/','UsersController::login');
$routes->add('deconnexion/','UsersController::logout');

$routes->get('/api', "ApiController::index");
$routes->get('/api/recipes', "ApiController::recipes");
$routes->get('/api/recipes/(:num)/ingredient', "ApiController::recipesIngredients/$1");
$routes->get('/api/recipes/(:num)/step', "ApiController::recipesSteps/$1");
$routes->get('/api/category/(:alpha)', "ApiController::category/$1");




// $routes->get('/test', 'Home::test');
// $routes->get('/tags/allTags','Tagcontroller::allTags/');
// $routes->get('/tags/(:num)','Tagcontroller::oneTag/$1');
// $routes->get('/tags/editTag','Tagcontroller::editTag');
// $routes->get('/tags/createTag','Tagcontroller::createTag');
// $routes->get('/tags/searchTag','Tagcontroller::searchTag');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}