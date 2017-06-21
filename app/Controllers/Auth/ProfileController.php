<?php
namespace App\Controllers\Auth;

use App\Controllers\Controller;
use App\Models\User;

class ProfileController extends Controller
{
	public function getViewProfile($request,$response,$agrs)
	{
		//CHECK IF SIGNED IN BEFORE SHOWING THE PAGE
		if (!$this->auth->isSignedIn()){
			$this->flash->addMessage('error','You are not signed in.');
			return $this->view->render($response,'/auth/signin.twig');
		}
		
		
		
		//GET THE CURRENT LOGGED IN USER INFO
		$user = User::join('admin_type','user.fk_admin_type','=','admin_type.id')
			->select('user.username','user.first_name','user.created_at','user.last_name','user.email','admin_type.name as admin_type')
			->where('user.id',$_SESSION['user'])
			->first();

		return $this->view->render($response,'/auth/profile.twig', array('user'=>($user)));
	}
}