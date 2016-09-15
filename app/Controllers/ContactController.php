<?php


namespace App\Controllers;


class ContactController extends HomeController
{
    
    public function getContactUs ($request, $response)
    {
        return $this->view->render($response,'contact.twig');
    }
    
    public function postContactUs ($request, $response)
    {
        
        #TODO VALIDATION ON THE FROM
    
        $name =  $request->getParam('name');
        $phone = $request->getParam('phone');
        $email = $request->getParam('email');
        $message = $request->getParam('message');
        
        $mail_to = Null;
        switch($request->getParam('about')){
	        case 'Hosting':
		        $mail_to = 'hosting@frostweb.co.za';
	        break;
	        case 'Web Development';
	            $mail_to = 'michael@frostweb.co.za';
	        break;
	        default:
	            $mail_to = 'michael@frostweb.co.za';
        }
    
	    $this->mailer->send('email/contact.twig', array('name'=>$name,'phone'=>$phone,'email'=>$email,'message'=>$message), function ($message) use($mail_to) {
	        $message->to($mail_to);
	        $message->subject('New Contact Request');
	    
	    });
	
	    $this->mailer->send('email/thankyou.twig', array('name'=>$name), function ($message) use($email) {
		    $message->to($email);
		    $message->subject('Thank You');
		    $message->from("no-reply@frostweb.co.za");
		
	    });
	    
        
        //IF MESSAGES SENT BACK TO HOME
        return $response->withRedirect($this->router->pathFor('home'));
    
    }
    
}