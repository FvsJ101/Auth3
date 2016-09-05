<?php



namespace App\Controllers\Auth;

use App\Controllers\Controller;
use App\Models\User;
use Respect\Validation\Validator AS v;

class AuthController extends Controller
{
    //RENDER SIGNUP>TWIG VIEW
    public function getSignUp($request, $response)
    {
        return $this->view->render($response,'auth/signup.twig');
    }
    
    //WHATS GOING TO HAPPEN WHEN WE SUBMIT THE FORM (POST SIGN UP)
    /**
     * @param $request
     * @param $response
     * @return mixed
     */
    public function postSignUp($request, $response)
    {
        
        //PARAMS NEEDED $REQUST FROM SLIM AND THE ARRAY OF RULES
        $validation = $this->validator->validate($request,array(
            //KEY IS DEPENDED ON THE NAME VALUES FROM THE FORM
            'username'           => v::notEmpty()->noWhitespace()->alnum(),
            'first_name'         => v::alpha(),
            'surname'            => v::alpha(),
            'email'              => v::email()->noWhitespace()->notEmpty(),
            'password'           => v::noWhitespace()->notEmpty()->min(6),
            'confirmed_password' => v::equals($request->getParam('password'))->notEmpty()
                
        ));
    
    
        if($validation->failed()){
    
            return $response->withRedirect($this->router->pathFor('auth.signup'));
        
        }
    
    
        //CREATES A USER
        $user = User::create(array(
            //getParams RETURNS WHOLE POST ARRAY getParam RETURNS ENTITY
            'username'   => $request->getParam('username'),
            'first_name' => $request->getParam('first_name'),
            'last_name'  => $request->getParam('surname'),
            'email'      => $request->getParam('email'),
            'password'   => password_hash($request->getParam('password'),PASSWORD_DEFAULT)
        ));
        
        //REDIRECT TO HOME
        //this->router WE ACCRESS THE CONTAINER PASSED IN THE APP SECTION "home" is the setName GIVEN IN ROUTES FILE
        return $response->withRedirect($this->router->pathFor('home'));
        
        
    }
    
}