<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LigneCommandeController extends AbstractController
{
    /**
     * @Route("/ligne/commande", name="ligne_commande")
     */
    public function index()
    {
        return $this->render('ligne_commande/index.html.twig', [
            'controller_name' => 'LigneCommandeController',
        ]);
    }
}
