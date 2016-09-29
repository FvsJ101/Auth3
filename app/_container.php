<?php
use Noodlehaus\Config AS Config;
use App\Validation\Validator AS Validator;
use Slim\Csrf\Guard AS Guard;
use App\Auth\Auth AS Auth;
use App\Mail\Mailer AS Mailer;
use RandomLib\Factory AS RandomLib;


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

//MAILER
$container['mailer'] = function ($container) {
	$Config = $container['Config'];
	
	$mailer = new PHPMailer;
	
	$mailer->Host           = $Config->get('mail.host');
	$mailer->SMTPAuth       = $Config->get('mail.smtp_auth');
	$mailer->SMTPSecure     = $Config->get('mail.smtp_secure');
	$mailer->Port           = $Config->get('mail.port');
	$mailer->Username       = $Config->get('mail.username');
	$mailer->Password       = $Config->get('mail.password');
	
	$mailer->isHTML($Config->get('mail.html'));
	$mailer->SetFrom($Config->get('mail.sendfrom_email'),$Config->get('mail.sendfrom_person'));
	
	return new Mailer($container->view, $mailer);
};

//RANDOMLIB HASH GENERATOR
$container['randomlib'] = function ($container) {
	$factory = new RandomLib();
	return $factory->getMediumStrengthGenerator();
};