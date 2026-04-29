<?php

namespace App\Controller;

use App\Entity\Player;
use App\Form\PlayerType;
use App\Repository\PlayerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/dashboard/player')]
final class PlayerController extends AbstractController
{
    #[Route('/', name: 'player_index', methods: ['GET'])]
    public function index(PlayerRepository $playerRepository): Response
    {

        $players = $playerRepository->findAllPlayer();

        return $this->render('player/index.html.twig', [
            'players' => $players,
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

    #[Route('/{id}', name: 'player_show', methods: ['GET'])]
    public function show(PlayerRepository $playerRepository, Player $player): Response
    {
        $id = $player->getId();

        $player = $playerRepository->findPlayerById($id);

        return $this->render('player/show.html.twig', [
            'player' => $player,
        ]);
    }

    #[Route('/edit/{id}', name: 'player_edit', methods: ['GET', 'POST'])]
    public function edit(Player $player, Request $request, EntityManagerInterface $em)
    {
        $formPlayer = $this->createForm(PlayerType::class, $player);
        $formPlayer->handleRequest($request);

        if($formPlayer->isSubmitted() && $formPlayer->isValid()) {
            $em->persist($player);
            $em->flush();

            return $this->redirectToRoute('player_show', array(
                'id' => $player->getId(),
            ));
        }

        return $this->render('player/edit.html.twig', [
            'editPlayerForm' => $formPlayer,
            'player' => $player,
        ]);
    }

    #[Route('/{id}/delete', name: "player_delete", methods: ["POST"])]
    public function delete(Player $player, Request $request, EntityManagerInterface $em)
    {
        if ($this->isCsrfTokenValid('delete' . $player->getId(), $request->request->get('_token'))) {
            $em->remove($player);
            $em->flush();

            return $this->redirectToRoute('player_index');
        }
    }

}
