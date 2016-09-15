<?php


namespace App\Controllers;


class ContactController extends HomeController
{
    
    public function getContactUs ($request, $response)
    {
        return $this->view->render($response,'contact.twig');
    }
    
    public function postContactUs ($request, $response)
    {
    
        //TODO add the mail function
    
    
        
        //IF MESSAGES SENT BACK TO HOME
        return $response->withRedirect($this->router->pathFor('home'));
    
    }
    
}