<?php

use  Noodlehaus\Config AS Config;

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

//TO RETRIEVE SETTINGS FORM CONTAINER
//$container->get('settings')['mode'];

$container['Config'] = function ($container){
    $Config = new Config(INC_ROOT."/app/config/".$container->get('settings')['mode'].".php");
    return $Config;
};

/*
TO GET ITEMS OUT OF THE CONFIG FILE
//$Config = $container['Config'];
//echo $Config->get('app.url');
*/



$container['HomeController'] = function ($container) {
    return new \App\Controllers\HomeController($container);
};


require __DIR__.'/../app/routes.php';


