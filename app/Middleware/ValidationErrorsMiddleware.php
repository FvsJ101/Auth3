<?php


namespace App\Middleware;


class ValidationErrorsMiddleware extends Middleware
{
    
    public function __invoke($request, $response, $next)
    {
        //WE TAKE THE SESSION INFO AND ADD IT TO ALL OF THE VIEWS
        //THE addGlobal 2 params variable(key used in the views) and the value
        if(isset($_SESSION['signupErrors']) && is_array($_SESSION['signupErrors'])){
            $this->container->view->getEnvironment()->addGlobal('signupErrors', $_SESSION['signupErrors']);
            unset($_SESSION['signupErrors']);
        }
        
        $response = $next($request,$response);
        return $response;
        
    }
    
    
}