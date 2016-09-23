<?php


namespace App\Controllers;


class ServiceController extends Controller
{
	public function getServices($request, $response)
	{
		return $this->view->render($response,'service.twig');
	}
}