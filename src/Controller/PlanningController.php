<?php

namespace App\Controller;

use App\Repository\EventsRepository;
use App\Repository\TrainingSessionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/dashboard/planning')]
final class PlanningController extends AbstractController
{
    #[Route('/', name: 'planning_index')]
    public function index(TrainingSessionRepository $trainingSessionRepository, EventsRepository $eventsRepository): Response
    {

        $trainings = $trainingSessionRepository->findBy([], ['id'=>'DESC'], 5);
        $events = $eventsRepository->findBy([], ['date' => 'DESC'], 5);

        return $this->render('planning/index.html.twig', [
            'trainings' => $trainings,
            'events' => $events,
        ]);
    }
}
