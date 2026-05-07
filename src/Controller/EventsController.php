<?php

namespace App\Controller;

use App\Entity\Events;
use App\Form\EventType;
use App\Repository\EventsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/dashboard/planning/events')]
final class EventsController extends AbstractController
{
    #[Route('', name: 'events_index')]
    public function index(EventsRepository $eventsRepository): Response
    {

        $events = $eventsRepository->findAllEvent();

        return $this->render('events/index.html.twig', [
            'events' => $events,
        ]);
    }

    #[Route('/new', name: 'events_new')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {

        $newEvent = new Events;

        $newEventForm = $this->createForm(EventType::class, $newEvent);
        $newEventForm->handleRequest($request);

        if ($newEventForm->isSubmitted() && $newEventForm->isValid()) {
            $em->persist($newEvent);
            $em->flush();

            return $this->redirectToRoute('events-index');
        }

        return $this->render('events/new.html.twig', [
            'newEventForm' => $newEventForm,
        ]);
    }

    #[Route('/{id}', name: 'events_show')]
    public function show(Events $events, EventsRepository $eventsRepository): Response
    {

        $id = $events->getId();
        $event = $eventsRepository->findEventById($id);

        return $this->render('events/show.html.twig', [
            'event' => $event,
        ]);
    }

    #[Route('/{id}/edit', name: 'events_edit')]
    public function edit(Request $request, Events $event, EntityManagerInterface $em): Response
    {

        $editEventForm = $this->createForm(EventType::class, $event);
        $editEventForm->handleRequest($request);

        if ($editEventForm->isSubmitted() && $editEventForm->isValid()) {
            $em->persist($event);
            $em->flush();

            return $this->redirectToRoute('events_show', array(
                'id' => $event->getId(),
            ));
        }

        return $this->render('events/edit.html.twig', [
            'event' => $event,
            'editEventForm' => $editEventForm,
        ]);
    }

    #[Route('/{id}/delete', name: 'events_delete')]
    public function delete(Events $event, Request $request, EntityManagerInterface $em)
    {
        if ($this->isCsrfTokenValid('delete' . $event->getId(), $request->request->get('_token'))) {
            $em->remove($event);
            $em->flush();

            return $this->redirectToRoute('events_index');
        }
    }
}