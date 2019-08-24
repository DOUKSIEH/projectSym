<?php

namespace App\Controller;

use App\Hello\Geo;
use App\Hello\HelloWorld;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TestController extends AbstractController
{
    /**
     * @Route("/test", name="test")
     */
    public function index(HelloWorld $test,Geo $g)
    {
       dump($g->geolocalise('2 cite bergere'));
        //   dump(json_decode($g->geolocalise('2 cite bergere'),true));
         
         //$t= json_decode($g->geolocalise('2 cite bergere'),true);

        return $this->render('test/index.html.twig', [
            'controller_name' => $test->yoUpper(),
            'geol' => $g->geolocalise("1 rue honnoré d'estiennes d'orves 91000"),
            'search' => json_decode($g->searchArtist("Lionel_Messi"),true)
            //$t["features"][0]["geometry"]
        ]);
    }
}
