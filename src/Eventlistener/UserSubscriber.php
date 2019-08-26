<?php


namespace App\Eventlistener;


use App\Event\RegisterEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\KernelEvent;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class UserSubscriber implements EventSubscriberInterface
{
   private $session;
   /**
    * UserSubscriber constructor.
    */
   public function __construct(SessionInterface $session)
   {
       $this->session=$session;
   }
   public function displayRegistrationMessage(RegisterEvent $registerEvent) {

       //$user =  $registerEvent->getUser()->getFirstName();

       $message = "Salut votre compte a bien été enregistré";
       
       $this->session->getFlashBag()->add('message', $message);
 
    //    return $this;
       //return $this->session->getFlashBag()->add('message', $message);

   }
   public function displayKernelResponse(ResponseEvent $kernelEventResponse) {

       $reponse =  $kernelEventResponse->getResponse();
      // dd($reponse);
       
       
       return $this;
   }
   public static function getSubscribedEvents() {
       return [
           RegisterEvent::NAME => ['displayRegistrationMessage', 1],
           KernelEvents::RESPONSE => ['displayKernelResponse', 10]
       ];
   }
}