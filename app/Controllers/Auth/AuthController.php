<?php


namespace App\Controllers\Auth;

use App\Controllers\Controller;

class AuthController extends Controller
{
    //RENDER SIGNUP>TWIG VIEW
    public function getSignUp($request, $response)
    {
        return $this->view->render($response,'auth/signup.twig');
    }
    
    //WHATS GAING TO HAPPEN WHEN WE SUBMIT THE FORM
    public function postSignUp($request, $response)
    {
        
    }
    
}