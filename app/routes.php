<?php
// This is linked to the controller in the app file
// HomeController:index refers to the Calls and then the method being used. 
$app->get('/', 'HomeController:index' )->setName('home');


//AuthController
$app->get('/auth/signup','AuthController:getSignUp')->setName('auth.signup');
//ON SUBMISSION
$app->post('/auth/signup','AuthController:postSignUp');