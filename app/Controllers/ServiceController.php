<?php


namespace App\Controllers;

use App\Models\Customer;

class ServiceController extends Controller
{
	public function getServices($request, $response)
	{
		//USER INPUT
		$page = !empty($request->getParam('page')) ? (int)$request->getParam('page') : 1;
		$perPage = 3;
		
		//POSITION OF THE START QUERY
		$start = ($page > 1 ) ? ($page * $perPage) - $perPage : 0;
		
		//TOTAL RECORDS
		$totalPosts = Customer::count();
		$pages = ceil($totalPosts / $perPage);
		
		//QUERY
		
		$customers = Customer::offset($start)->limit($perPage)->get();
		
		
		
		
		return $this->view->render($response,'service.twig', array('customers'=>$customers,'pages'=>$pages,'currentPage'=>$page));
	}
}