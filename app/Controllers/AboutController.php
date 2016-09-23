<?php


namespace App\Controllers;


class AboutController extends Controller
{
	public function about($request, $response)
	{
		return $this->view->render($response,'about.twig');
	}
}