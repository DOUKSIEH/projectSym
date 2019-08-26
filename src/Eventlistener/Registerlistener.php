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
        $message = (new \Swift_Message('Salut'))
                ->setFrom('ismanhassan18@gmail.com')
                ->setTo($e->getEmail())
                ->setBody('Coucou , ca marche','text/html');


    $this->mail->send($message);

    

    }
}