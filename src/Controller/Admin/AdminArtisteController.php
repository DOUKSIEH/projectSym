<?php

namespace App\Controller\Admin;

use App\Entity\Artiste;
use App\Form\ArtisteType;
use App\Repository\ArtisteRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminArtisteController extends AbstractController
{
    
    /**
     * @Route("/admin/artiste", name="admin.artiste.index")
     * 
     */
    public function index(ArtisteRepository $repo)
    {
        $artistes = $repo->findAll();
        return $this->render('admin/artiste/index.html.twig', compact('artistes'));
    }
    /**
     * @Route("/admin/artiste/new", name = "admin.artiste.new")
     * @IsGranted("ROLE_ADMIN")
     */
    public function new (Request $request, ObjectManager $manager)
    {
      $artiste = new Artiste();

      $form =  $this->createForm(ArtisteType::class,$artiste);
      
      $form->handleRequest($request);

      
      if ($form->isSubmitted() && $form->isValid())
      {
        $manager->persist($artiste);

        $manager->flush();

        $this->addFlash('success','L\'artiste a bien été ajouté avec succès');

          return $this->redirectToRoute('admin.artiste.index');
      }
      return $this->render('admin/artiste/new.html.twig', [
        'artiste' => $artiste,
        'form'   => $form->createView()
    ]);
    }
    /**
     * @Route("/admin/artiste/{id}", name="admin.artiste.show",requirements={"id":"\d+"})
     */
    public function show(Artiste $artiste): Response
    {
        return $this->render('admin/artiste/show.html.twig', [
            'artiste' => $artiste,
        ]);
    }
     /**
     * @Route("/admin/artiste/{id}/edit", name = "admin.artiste.edit",methods ="GET|POST")
     */
    public function edit(Artiste $artiste,Request $request, ObjectManager $manager)
    {
       $form =  $this->createForm(ArtisteType::class,$artiste);
       $form->handleRequest($request);
       
       if ($form->isSubmitted() && $form->isValid())
       {
          
         /* nous avons pas persistés parce que l'objet exist */
          $manager->flush();
          $this->addFlash('success','Votre modification a été bien enregistrée avec succès');
          return $this->redirectToRoute('admin.artiste.index');
       }
        return $this->render('admin/artiste/edit.html.twig', [
            'artiste' => $artiste,
            'form'   => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/artiste/{id}/delete",name="admin.artiste.delete",methods="DELETE")
     */
    public function delete (Artiste $artiste,Request $request, ObjectManager $manager)
    {
        if($this->isCsrfTokenValid('delete'.$artiste->getId(),$request->get('_token')))
         {
         
          $manager->remove($artiste);
          $manager->flush();
          $this->addFlash('success','Votre suppression a bien été executée avec succès');
         
         }
      
      return $this->redirectToRoute('admin.artiste.index');
    }
   
}
