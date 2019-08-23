<?php

namespace App\Controller;

use App\Hello\Geo;
use App\Hello\HelloWorld;
use App\Hello\MessageUpper;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HelloController extends AbstractController
{
    /**
     * @Route("/hello", name="hello")
     */
    public function index(HelloWorld $m, Geo $g)
    {
       // dump(json_decode($g->geolocalise('2 cite berger'),true));
        $t = $g->geolocalise('9 rue du piemont');
        dump($_SERVER['HTTP_USER_AGENT']);
        return $this->render('hello/index.html.twig', [
            'controller_name' => $m->yoUpper(),
            'geol' => $t
        ]);
    }
}
