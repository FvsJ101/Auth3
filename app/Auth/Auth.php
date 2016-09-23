<?php


namespace App\Auth;


use App\Models\User;

class Auth
{
	public function attempt($identity, $password)
	{
		
		//CHECK WEATHER THE USERNAME OR EMAIL IS REGISTERED
		$user = User::where('email', $identity)->orWhere('username', $identity)->where('flag_active',1)->first();
		
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
	
	public function logout()
    {
    
        unset($_SESSION['user']);
        unset($_SESSION['auth']);
    
    }
    
    public function activate($email, $identifier)
    {
	
	    //CHECK IF IT CAN FIND A USER WITH THE PARAMS
	    $check_user = User::where('email',$email)->where('active_hash',$identifier)->count();
	
	    //IF NOTHING IS FOUND REDIRECT TO CONTACT US
	    if ($check_user != 1){
		    return false;
	    }
	
	    $user = User::select('id')->where('email',$email)->first();
	
	    User::where('id',$user->id)->update(array('flag_active'=>1,'active_hash'=>NULL));
	    
	    return true;
    
    }
	
}