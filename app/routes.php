<?php
// This is linked to the controller in the app file
// HomeController:index refers to the Calls and then the method being used. 
$app->get('/', 'HomeController:index' )->setName('home');


//AUTHCONTROLLER
$app->get('/auth/signup','AuthController:getSignUp')->setName('auth.signup');
//ON SUBMISSION
$app->post('/auth/signup','AuthController:postSignUp');

//AUTHCONTROLLER SIGN IN SECTION
$app->get('/auth/signin','AuthController:getSignIn')->setName('auth.signin');
//ON SUBMISSION
$app->post('/auth/signin','AuthController:postSignIn');