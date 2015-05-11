<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AppController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return array();
    }

    public static function email($subject, $content, $user)
    {
        $mandrill = new \Mandrill('Tg8FVSuqNCuaIP16-fLsLQ');
    	$message = array(
	        'html' => $content,
	        'subject' => $subject,
	        'from_email' => 'noreply@offthelines.fr',
	        'from_name' => 'Off the lines',
	        'to' => array(
	            array(
	                'email' => $user->getEmail(),
	                'name' => $user->getUsername(),
	                'type' => 'to'
	            )
	        )
	    );
	    $mandrill->messages->send($message);
        return true;
    }
}
