<?php


namespace App\Controllers;

use Respect\Validation\Validator AS v;

Class HomeController extends Controller
{
	public function index ($request,$response)
   {
		return $this->view->render($response, 'home.twig');
   }
   
   public function homeNewsLetter ($request,$response){
	
	   //FORM VALIDATION
	   $validation = $this->validator->validate($request,array(
		   //KEY IS DEPENDED ON THE NAME VALUES FROM THE FORM
		   'name'  => v::alpha()->notEmpty(),
		   'email' => v::email()->noWhitespace()->notEmpty()
	   ));
	
	
	   if($validation->failed()){
		   return $response->withRedirect($this->router->pathFor('home'));
	   }
	
	   $fname = $request->getParam('name');
	   $email = $request->getParam('email');
	  
	   // MailChimp API credentials
	   $apiKey = $this->Config->get('mailchimp.api_key');
	   $listID = $this->Config->get('mailchimp.web_listing');;
	
	   // MailChimp API URL
	   $memberID = md5(strtolower($email));
	   $dataCenter = substr($apiKey,strpos($apiKey,'-')+1);
	   $url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $listID . '/members/' . $memberID;
	
	   // member information
	   $json = json_encode([
		   'email_address' => $email,
		   'status'        => 'subscribed',
		   'merge_fields'  => [
			   'FNAME'     => $fname
		   ]
	   ]);
	
	   // send a HTTP POST request with curl
	   $ch = curl_init($url);
	   curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $apiKey);
	   curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
	   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	   curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	   curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
	   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	   curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
	   $result = curl_exec($ch);
	   $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	   curl_close($ch);
	
	   // store the status message based on response code
	   switch ($httpCode) {
		   case 200:
			   $this->flash->addMessage('info','Your have been added to our mailing list. Thank you!');
		   break;
			case 214:
			   $this->flash->addMessage('warning','You are already subscribed.');
		   break;
		   default:
			   $this->flash->addMessage('error','Some problem occurred, please try again.');
		   break;
	   }
	  
	
	   return $this->view->render($response, 'home.twig');
   }
   
}

