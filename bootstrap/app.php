<?php

use  Noodlehaus\Config AS Config;
use  App\Validation\Validator As Validator;

session_start();

//C:\bla\Auth3
define('INC_ROOT', dirname(__DIR__));

require __DIR__ . '/../vendor/autoload.php';

$app = new \Slim\App(array(
    'settings' => array(
        'displayErrorDetails' => true,
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


