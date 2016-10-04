<?php


namespace App\Controllers;

use Respect\Validation\Validator AS v;
use App\Middleware\BreadCrumbs AS BreadCrumbs;

class ContactController extends Controller
{
    
    public function getContactUs ($request, $response)
    {
		return $this->view->render($response,'contact.twig');
    }
    
    public function postContactUs ($request, $response)
    {
	
        //POST VALUES
	    $name = $request->getParam('name');
	    $phone = $request->getParam('phone');
	    $email = $request->getParam('email');
	    $message = $request->getParam('message');
	
		//FORM VALIDATION
		$validation = $this->validator->validate($request,array(
			//KEY IS DEPENDED ON THE NAME VALUES FROM THE FORM
			'name'    => v::alpha()->notEmpty(),
			'phone'   => v::phone()->notEmpty(),
			'email'   => v::email()->noWhitespace()->notEmpty(),
			'message' => v::notEmpty()
		));
		
	
	    if($validation->failed()){
		
		    return $response->withRedirect($this->router->pathFor('contact'));
		
	    }
        
        //WHO IT SHOULD MAIL REGARDING CHOICE
        $mail_to = Null;
        switch($request->getParam('about')){
	        case 'Hosting':
		        $mail_to = 'hosting@frostweb.co.za';
	        break;
	        case 'Web Development';
	            $mail_to = 'michael@frostweb.co.za';
	        break;
	        case 'SEO';
		        $mail_to = 'michael@frostweb.co.za';
	        break;
	        default:
	            $mail_to = 'michael@frostweb.co.za';
        }
    
        //SENDS TO ME
	    $this->mailer->send('email/contact.twig', array('name'=>$name,'phone'=>$phone,'email'=>$email,'message'=>$message), function ($message) use($mail_to) {
	        $message->to($mail_to);
	        $message->subject('New Contact Request');
	        $message->from('No-Reply@frostweb.co.za');
	    
	    });
	   
	    //SENDS TO USER
		$this->mailer->send('email/thankyou.twig', array('name'=>$name), function ($message) use($email) {
		    $message->to($email);
		    $message->subject('Thank You');
			$message->from('No-Reply@frostweb.co.za');
		});
	
	    $this->flash->addMessage('info','Your email request has been sent. Thank You.');
        
        //IF MESSAGES SENT BACK TO HOME
        return $response->withRedirect($this->router->pathFor('home'));
    
    }
    
}