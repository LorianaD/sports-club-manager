<?php

namespace App\Controller;

use App\Repository\AttendanceRepository;
use App\Repository\EventsRepository;
use App\Repository\PlayerRepository;
use App\Repository\SanctionRepository;
use App\Repository\TeamRepository;
use App\Repository\TrainingSessionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/dashboard')]
final class DashboardController extends AbstractController
{
    #[Route('', name: 'user_dashboard')]
    public function index(PlayerRepository $playerRepository, TeamRepository $teamRepository, AttendanceRepository $attendanceRepository, SanctionRepository $sanctionRepository, TrainingSessionRepository $trainingSessionRepository, EventsRepository $eventsRepository): Response
    {
        $user = $this->getUser();
        
        $recentPlayers = $playerRepository->findBy( 
            [], 
            ['id' => 'DESC'], 
            5
        );

        $recentTeams = $teamRepository->findBy(
            [],
            ['id' => 'DESC'],
            5
        );

        $attendanceThisMonth = $attendanceRepository->countThisMonth();
        $sanctionsThisMonth = $sanctionRepository->countThisMonth();

        $nextTrainings = $trainingSessionRepository->findNextTrainings(1);
        $nextEvents = $eventsRepository->findNextEvents(1);

        return $this->render('dashboard/index.html.twig', [
            'recentPlayers' => $recentPlayers,
            'recentTeams' => $recentTeams,
            'user' => $user,
            'attendanceThisMonth' => $attendanceThisMonth,
            'sanctionsThisMonth' => $sanctionsThisMonth,
            'nextTrainings' => $nextTrainings,
            'nextEvents' => $nextEvents,
        ]);
    }
}
