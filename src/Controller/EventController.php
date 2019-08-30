<?php

namespace App\Controller;

use App\Entity\Events;
use App\Entity\EventLike;
use App\Repository\EventsRepository;
use App\Repository\EventLikeRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EventController extends AbstractController
{
    /**
     * @Route("/events", name="events_index")
     */
    public function index(EventsRepository $repo)
    {
        $events = $repo->findAll();
       // dd($events);
        return $this->render('event/index.html.twig', [
            'events' => $events
        ]);
    }
    /**
     * Permet de créer une annonce
     *
     * @Route("/events/new", name="events_create")
     * @IsGranted("ROLE_USER")
     * 
     * @return Response
     */
    public function create(Request $request, ObjectManager $manager){
        $event = new Events();
        $form = $this->createForm(eventType::class, $event);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            foreach($event->getImages() as $image) {
                $image->setevent($event);
                $manager->persist($image);
            }
            $event->setAuthor($this->getUser());
            $manager->persist($event);
            $manager->flush();
            $this->eventdFlash(
                'success',
                "L'annonce <strong>{$event->getTitle()}</strong> a bien été enregistrée !"
            );
            return $this->redirectToRoute('events_show', [
                'slug' => $event->getSlug()
            ]);
        }
        return $this->render('event/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * Permet d'afficher le formulaire d'édition
     *
     * @Route("/events/{slug}/edit", name="events_edit")
     * @Security("is_granted('ROLE_USER') and user === event.getAuthor()", message="Cette annonce ne vous appartient pas, vous ne pouvez pas la modifier")
     * 
     * @return Response
     */
    public function edit(Events $event, Request $request, ObjectManager $manager){
        $form = $this->createForm(eventType::class, $event);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            foreach($event->getImages() as $image) {
                $image->setevent($event);
                $manager->persist($image);
            }
            $manager->persist($event);
            $manager->flush();
            $this->eventdFlash(
                'success',
                "Les modifications de l'annonce <strong>{$event->getTitle()}</strong> ont bien été enregistrées !"
            );
            return $this->redirectToRoute('events_show', [
                'slug' => $event->getSlug()
            ]);
        }
        return $this->render('event/edit.html.twig', [
            'form' => $form->createView(),
            'event' => $event
        ]);
    }
    
    /**
    *Permet de liker ou unliker un article
    *@route("/events/{id}/like",name="events_like",methods="GET")
    * @param Events $event
    * @param ObjectManager $manager
    * @param EventLikeRepository $repo
    * @return Response
    */
    public  function like(Events $event, ObjectManager $manager,EventLikeRepository $repo): Response
    {
         $user = $this->getUser();

       
         if (!$user) return $this->json([
             'code' => 403,
             'message' => 'Non autorisé, veuillez vous connecter!!!!'
         ],403);
         if($event->isLikedByUser($user))
         {
             $like = $repo->findOneBy([
                 'event' => $event,
                 'user' => $user,
             ]);
             $manager->remove($like);
             $manager->flush();
         return $this->json([
                 'code' => 200,
                 'message' => 'Like bien supprimé',
                 'likes' => $repo->count(['event' => $event])
             ], 200);
         }
         $like = new EventLike();
         $like->setEvent($event)
             ->setUser($user);
         $manager->persist($like);
         $manager->flush();
         return $this->json([
             'code'=> 200,
             'message' => 'Like bien ajouté',
             'likes' => $repo->count(['event' => $event])
         ], 200);
    }
    /**
     * Permet d'afficher une seule annonce
     *
     * @Route("events/{id}/{slug}", name="events_show")
     * 
     * @return Response
     */
    public function show(int  $id, EventsRepository $repo, string $slug )
    {
        $event = $repo->findByAuthor($id);

        return $this->render('event/show.html.twig', [
            'nom' => $slug ,
            'events' => $event
        ]);
    }
    
}
