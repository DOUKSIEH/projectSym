<?php

namespace App\Eventlistener;

use App\Event\RegisterEvent;


class Registerlistener {


    private $mail;

    public function __construct( \Swift_Mailer $mail)
    {
        $this->mail = $mail;
    }

    public function sendMailToUser( RegisterEvent $r)
    {
       
        $e = $r->getUser();
        $message = (new \Swift_Message('Hello Email'))
                ->setFrom('douksieha@gmail')
                ->setTo($e->getEmail())
                ->setBody('Bonjour ','text/html');


    $this->mail->send($message);

    

    }
}