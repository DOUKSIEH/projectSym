<?php

namespace App\Controller;

use App\Entity\Events;
use App\Repository\EventsRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class EventController extends Controller
{
    /**
     * @Route("/events", name="events_index")
     */
    public function index(EventsRepository $repo)
    {
        $events = $repo->findAll();
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
     * Permet d'afficher une seule annonce
     *
     * @Route("/events/{id}/{slug}", name="events_show")
     * 
     * @return Response
     */
    public function show(int $id, EventsRepository $rep , string $slug){
       
       
        $event = $rep->findByAuthor($id);

        dump($event);
        return $this->render('event/show.html.twig', [
            'nom'=>$slug,
            'event' => $event
        ]);
    }
    /**
     * Permet de supprimer une annonce
     * 
     * @Route("/events/{slug}/delete", name="events_delete")
     * @Security("is_granted('ROLE_USER') and user == event.getAuthor()", message="Vous n'avez pas le droit d'accéder à cette ressource")
     *
     * @param event $event
     * @param ObjectManager $manager
     * @return Response
     */
    public function delete(Events $event, ObjectManager $manager) {
        $manager->remove($event);
        $manager->flush();
        $this->eventdFlash(
            'success',
            "L'annonce <strong>{$event->getTitle()}</strong> a bien été supprimée !"
        );
        return $this->redirectToRoute("events_index");
    }
}
