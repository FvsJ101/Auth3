<?php


namespace App\Auth;


use App\Models\User;

class Auth
{
	public function attempt($identity, $password)
	{
        
        //CHECK WEATHER THE USERNAME OR EMAIL IS REGISTERED
        $user = User::where('email', $identity)->orWhere('username', $identity)->first();
        
        //FAILED TO FIND USER
        if(!$user){
            return false;
        }
        
        //SUCCESS
        if (password_verify($password, $user->password)) {
        
            $_SESSION['user'] = $user->id;
            return true;
        }
        
        //FAILED
        return false;
        
    }
 
	
}