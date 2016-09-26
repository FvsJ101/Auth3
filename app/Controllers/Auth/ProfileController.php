<?php


namespace App\Controllers\Auth;


use App\Controllers\Controller;

class ProfileController extends Controller
{
	public function getViewProfile($request,$response,$agrs)
	{
	
		$names = array();
		$names[] = array("name"=>"one");
		$names[] = array("name"=>"two");
		$names[] = array("name"=>"three");
	
		return $this->view->render($response,'/auth/profile.twig', array('test'=>($names)));
	}
}