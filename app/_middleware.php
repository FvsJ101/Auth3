<?php
use App\Middleware\ValidationErrorsMiddleware AS ValidationErrors;
use App\Middleware\OldInputMiddleware AS OldInPut;
use Respect\Validation\Validator AS v;
use App\Middleware\UserAuthMiddleware AS UserAuthMiddleware;
use App\Middleware\CsrfViewMiddleware AS Csrf;
use App\Middleware\BreadCrumbs AS BreadCrumbs;
use App\Middleware\FlashMessageMiddleware AS FlashMessage;

//////////MIDDLEWARE SECTION/////////////////
//VALIDATION OF ERRORS
$app->add(new ValidationErrors($container));

//PASSES THE OLD FROM DATA BACK TO THE FORM FOR SIGNUP / REGISTER PAGE
$app->add(new OldInPut($container));

//CUSTOM MIDDLEWARE FOR THE CSRF
$app->add(new Csrf($container));

//TURN ON THE CSRF
$app->add($container->csrf);

//CUSTOM MIDDLEWARE FOR THE USER AUTHENTICATED
$app->add(new UserAuthMiddleware($container));

//BREADCRUMBS
$app->add(new BreadCrumbs($container));

//FLASH MESSAGE
$app->add(new FlashMessage($container));

/*///////////ALLOW THE VALIDATION LIBRARY TO USE CUSTOM RULES/////////////////*/
v::with('App\\Validation\\Rules\\');