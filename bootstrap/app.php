<?php
session_start();

require __DIR__ . '/../vendor/autoload.php';

$app = new \Slim\App(array(
    'settings' => array(
        'displayErrorDetails' => true,
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


$container['HomeController'] = function ($container) {
    return new \App\Controllers\HomeController($container);
};


require __DIR__.'/../app/routes.php';


