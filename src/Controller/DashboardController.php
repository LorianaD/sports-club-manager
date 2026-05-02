<?php

namespace App\Controller;

use App\Repository\PlayerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'user_dashboard')]
    public function index(PlayerRepository $playerRepository): Response
    {

        
        $recentPlayers = $playerRepository->findBy([], ['id' => 'DESC'], 5);

        return $this->render('dashboard/index.html.twig', [
            'recentPlayers' => $recentPlayers,
        ]);
    }
}
