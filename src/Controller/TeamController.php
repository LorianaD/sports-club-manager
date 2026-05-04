<?php

namespace App\Controller;

use App\Entity\Team;
use App\Form\TeamType;
use App\Repository\TeamRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/team')]
final class TeamController extends AbstractController
{
    #[Route('/', name: 'team_index', methods: ['GET'])]
    public function index(TeamRepository $teamRepository): Response
    {
        $teams = $teamRepository->findAllTeam();

        return $this->render('team/index.html.twig', [
            'teams' => $teams,
        ]);
    }

    #[Route('/new', name: 'team_new', methods: ['GET' , 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $newTeam = new Team;

        $newFormTeam = $this->createForm(TeamType::class, $newTeam);

        $newFormTeam->handleRequest($request);

        if ($newFormTeam->isSubmitted() && $newFormTeam->isValid()) {
            $em->persist($newTeam);
            $em->flush();
            return $this->redirectToRoute('team_index');
        }

        return $this->render('team/new.html.twig', [
            'newTeamForm' => $newFormTeam,
        ]);
    }

    #[Route('/{id}', name: 'team_show', methods: ['GET'])]
    public function show(TeamRepository $teamRepository, Team $team): Response
    {
        $id = $team->getId();
        $team = $teamRepository->findTeamById($id);


        return $this->render('team/show.html.twig', [
            'team' => $team,
        ]);
    }

}
