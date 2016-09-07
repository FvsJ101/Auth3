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
	
	public function checkUserLoggedIn ()
	{
		
	    return isset($_SESSION['user']);
	
	}
 
	public function userInfo()
	{
	
	    return User::select(array('id','username','first_name','last_name','email','flag_active','fk_admin_type'))->where('id',$_SESSION['user'])->first();
	
	}
	
	
}