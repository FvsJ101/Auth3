<?php
// This is linked to the controller:method in the app file
// HomeController:index refers to the Calls and then the method being used. 
$app->get('/', 'HomeController:index' )->setName('home');


//SUPER GROUP NOT REGISTERED

//AUTHCONTROLLER
$app->get('/auth/signup','AuthController:getSignUp')->setName('auth.signup');
//ON SUBMISSION
$app->post('/auth/signup','AuthController:postSignUp');
//ACTIVATE ACCOUNT
$app->get('/activate','AuthController:getActivateAccount')->setName('activate');



//CONTACT GET
$app->get('/contact','ContactController:getContactUs')->setName('contact');
//CONTACT POST
$app->post('/contact','ContactController:postContactUs');

//ABOUT US
$app->get('/about','AboutController:getAboutUs')->setName('about');

//SERVICE
$app->get('/service','ServiceController:getServices')->setName('service');

///SUPER GROUP REGISTERED

//AUTHCONTROLLER SIGN IN SECTION
$app->get('/auth/signin','AuthController:getSignIn')->setName('auth.signin');
//ON SUBMISSION
$app->post('/auth/signin','AuthController:postSignIn');

//AUTHCONTROLLER SIGNING THE USER OUT
$app->get('/auth/logout','AuthController:getLogout')->setName('auth.logout');