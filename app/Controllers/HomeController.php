<?php

namespace App\Controllers;


use App\Models\User;

Class HomeController extends Controller
{
    public function index ($request,$response)
   {
        User::create([
            'username' => "user",
            'first_name' => "user",
            'last_name' => "user",
            'email' => "user",
            'password' => "user"
        
        ]);
   
        return $this->view->render($response, 'home.twig');
   }
}

