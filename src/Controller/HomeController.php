<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Repository\EventsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends Controller {
    /**
     * @Route("/", name="home")
     */
    public function home(EventsRepository $eventRepo, UserRepository $userRepo,TranslatorInterface $translator){
        $event = $eventRepo->findLastest();
        $user = $userRepo->findLastest();

        $msg = $translator->trans('text.msg');
        $events = $translator->trans('num_of_events', ['events' => 0]);  
         
    //    dd($events);
    // dd($user);
       // dump( $userRepo->findLastest());
    //   die();
        return $this->render(
            'home/index.html.twig', 
            [
                'message' => $msg,
                'events' => $event,
                'users' => $user,
                'nbEvents' => 6
            ]
        );
    }
}
