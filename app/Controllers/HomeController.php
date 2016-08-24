<?php

namespace App\Controllers;


Class HomeController extends Controller
{
    public function index ($request,$response)
   {
        return $this->view->render($response, 'home.twig');
   }
}

