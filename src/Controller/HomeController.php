<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Repository\EventsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends Controller {
    /**
     * @Route("/", name="home")
     */
    public function home(EventsRepository $eventRepo, UserRepository $userRepo){
        $event = $eventRepo->findLastest();
        $user = $userRepo->findLastest();
       // dump( $userRepo->findLastest());
       // die();
        return $this->render(
            'home/index.html.twig', 
            [
                'events' => $event,
                'users' => $user
            ]
        );
    }
}
