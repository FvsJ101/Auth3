<?php

namespace App\Controllers;


use App\Models\User;

Class HomeController extends Controller
{
    public function index ($request,$response)
   {
   
        return $this->view->render($response, 'home.twig');
   }
}

