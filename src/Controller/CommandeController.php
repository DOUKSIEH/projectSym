<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Repository\CommandeRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommandeController extends AbstractController
{
    /**
     * @Route("/commande", name="commande.index")
     */
    public function index(CommandeRepository $repo)
    {
        $commande = $repo->findAll();
    
       // dd($commande);
        return $this->render('commande/index.html.twig', [
            'commandes' => $commande
        ]);
    }
    /**
     * @Route("/commande/{id}", name="commande.delete", methods={"DELETE"})
     */
    public function delete(Request $request, Commande $commande,ObjectManager $manager): RedirectResponse
    {
        

        if ($this->isCsrfTokenValid('delete'.$commande->getId(), $request->request->get('_token'))) {

            $this->denyAccessUnlessGranted('deleteOrder', $commande);
            //$entityManager = $this->getDoctrine()->getManager();
            $manager->remove($commande);
            $manager->flush();
            // dd($request->request->get('_token'));
        }

        return $this->redirectToRoute('commande.index');
    }
    
    
}
