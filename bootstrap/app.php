<?php

use Noodlehaus\Config AS Config;
use App\Validation\Validator AS Validator;
use App\Middleware\ValidationErrorsMiddleware AS ValidationErrors;
use App\Middleware\OldInputMiddleware AS OldInPut;
use Respect\Validation\Validator AS v;
use Slim\Csrf\Guard AS Guard;
use App\Middleware\CsrfViewMiddleware AS Csrf;
use App\Auth\Auth AS Auth;
use App\Middleware\UserAuthMiddleware AS UserAuthMiddleware;

session_start();

//C:\bla\Auth3
define('INC_ROOT', dirname(__DIR__));

require __DIR__ . '/../vendor/autoload.php';

$app = new \Slim\App(array(
	'settings' => array(
		'displayErrorDetails' => true,
		'determineRouteBeforeAppMiddleware' => true,
		'mode'=>file_get_contents(INC_ROOT.'/mode.php')
	)
));

//Need to get the slim container and add the twig view to it.
$container = $app->getContainer();

//TO RETRIEVE SETTINGS FORM CONTAINER
//$container->get('settings')['mode'];

//SETTING CONFIG OPTIONS TO CONTAINER
$container['Config'] = function ($container){
	$Config = new Config(INC_ROOT."/app/config/".$container->get('settings')['mode'].".php");
	return $Config;
};

/*
TO GET ITEMS OUT OF THE CONFIG FILE
//$Config = $container['Config'];
//echo $Config->get('app.url');
*/

//SETTING VIEW PARAMS TO CONTAINER
$container['view'] = function ($container){
	$view = new \Slim\Views\Twig(
							 __DIR__.'/../resources/views',
							array(
								'cache' => false,
							)
	);

	$view->addExtension(new \Slim\Views\TwigExtension(
		$container->router,
		$container->request->getUri()
	));

	return $view;
};

//DATABASE SETUP
require INC_ROOT."/app/db/database.php";
$container['db'] = function ($container) use ($capsule){
	return $capsule;
};

//VALIDATOR
$container['validator'] = function ($container) {
	return new Validator();
};

//SLIM CSRF PROTECTION
$container['csrf'] = function ($container){
    return new Guard();
};

//AUTH CLASS USED FOR CHECKING USER AUTHENTICATION IE REGISTERED, SINGED IN, PERMISSION, REMEMBER
$container['auth'] = function ($container){
    return new Auth();

};

//ADDING MIDDLEWARE TO THE APPLICATION
$app->add(new ValidationErrors($container));

//PASSES THE OLD FROM DATA BACK TO THE FORM FOR SIGNUP / REGISTER PAGE
$app->add(new OldInPut($container));


//CUSTOM MIDDLEWARE FOR THE CSRF
$app->add(new Csrf($container));

//TURN ON THE CSRF
$app->add($container->csrf);

//CUSTOM MIDDLEWARE FOR THE USER AUTHENTICATED
$app->add(new UserAuthMiddleware($container));


/*///////////ALLOW THE VALIDATION LIBRARY TO USE CUSTOM RULES/////////////////*/
v::with('App\\Validation\\Rules\\');

/*////////////////////////ROUTES SECTION////////////////////////////////*/
//HOME CONTROLLER FOR HOME PAGE
$container['HomeController'] = function ($container) {
	return new App\Controllers\HomeController($container);
};


//AUTH CONTROLLER FOR SIGNUP PAGE
$container['AuthController'] = function ($container) {
	return new App\Controllers\Auth\AuthController($container);
};


require __DIR__.'/../app/routes.php';


