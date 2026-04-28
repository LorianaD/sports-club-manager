<?php

namespace App\Controller;

use App\Entity\Player;
use App\Form\PlayerType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/dashboard/player')]
final class PlayerController extends AbstractController
{
    #[Route('/', name: 'player_index')]
    public function index(): Response
    {

        return $this->render('player/index.html.twig', [
            'controller_name' => 'PlayerController',
        ]);
    }

    #[Route('/new', name: 'player_new', methods:['GET' , 'POST'])]
    public function new(Request $request, EntityManagerInterface $em)
    {

        $newPlayer = new Player;

        $formPlayer = $this->createForm(PlayerType::class , $newPlayer);
        $formPlayer->handleRequest($request);

        if ($formPlayer->isSubmitted() && $formPlayer->isValid()) {

            $em ->persist($newPlayer);
            $em->flush();

            return $this->redirectToRoute('player_index');

        }

        return $this->render('player/new.html.twig',[
            'newPlayerForm' => $formPlayer,
        ]);

    }
}
