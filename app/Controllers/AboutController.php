<?php


namespace App\Controllers;


class AboutController extends Controller
{
	public function getAboutUs($request, $response)
	{
		return $this->view->render($response,'about.twig');
	}
}