<?php

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

//ALL THE ADDED CONTAINER FUCTION
require __DIR__.'/../app/_container.php';

//ALL THE MIDDLEWARE PARTS
require __DIR__.'/../app/_middleware.php';

/*////////////////////////ROUTES SECTION////////////////////////////////*/
//HOME CONTROLLER FOR HOME PAGE
$container['HomeController'] = function ($container) {
	return new App\Controllers\HomeController($container);
};

//AUTH CONTROLLER FOR SIGNUP PAGE
$container['AuthController'] = function ($container) {
	return new App\Controllers\Auth\AuthController($container);
};

//AUTH PROFILE CONTROLLER FOR VIEWING PROFILE
$container['ProfileController'] = function ($container) {
	return new App\Controllers\Auth\ProfileController($container);
};

//CONTACT US
$container['ContactController'] = function ($container){
    return new App\Controllers\ContactController($container);
};

//ABOUT US
$container['AboutController'] = function ($container){
	return new App\Controllers\AboutController($container);
};

//SERVICES
$container['ServiceController'] = function ($container){
	return new App\Controllers\ServiceController($container);
};

//SETUP OF THE ROUTS
require __DIR__.'/../app/routes.php';


