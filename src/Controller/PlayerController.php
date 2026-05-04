<?php

namespace App\Controller;

use App\Entity\ContactPersons;
use App\Entity\Player;
use App\Entity\PlayerContact;
use App\Form\ContactPersonsType;
use App\Form\PlayerContactType;
use App\Form\PlayerTeamType;
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

        $step = $request->query->getInt('step', 1);
        $playerId = $request->query->getInt('playerId');
        $player = null;

        $newPlayer = new Player;
        $newContact = new ContactPersons;
        $newRelation = new PlayerContact;

        $newFormPlayer = $this->createForm(PlayerType::class , $newPlayer);
        $newFormContact = $this->createForm(ContactPersonsType::class, $newContact);
        $newFormRelation = $this->createForm(PlayerContactType::class, $newRelation);
        $newFormTeam = null;

        $newFormPlayer->handleRequest($request);
        $newFormContact->handleRequest($request);
        $newFormRelation->handleRequest($request);

        if ($step === 1 && $newFormPlayer->isSubmitted() && $newFormPlayer->isValid()) {

            $em->persist($newPlayer);
            $em->flush();

            return $this->redirectToRoute('player_new', [
                'step' => 2,
                'playerId' => $newPlayer->getId(),
            ]);

        }

        if ($step === 2 && $newFormContact->isSubmitted() && $newFormContact->isValid()) {

            $player = $em->getRepository(Player::class)->find($playerId);

            if (!$player) {
                throw $this->createNotFoundException('Player not found');
            }

            $newRelation->setPlayer($player);
            $newRelation->setContactPerson($newContact);

            $em->persist($newContact);
            $em->persist($newRelation);
            $em->flush();

            return $this->redirectToRoute('player_new', [
                'step' => 3,  
                'playerId' => $player->getId(),
            ]);
        }

        if ($step === 3) {
            
            $player = $em->getRepository(Player::class)->find($playerId);
            
            if (!$player) {
                throw $this->createNotFoundException('Player not found');
            }

            $newFormTeam = $this->createForm(PlayerTeamType::class, $player);
            $newFormTeam->handleRequest($request);

            if ($newFormTeam->isSubmitted() && $newFormTeam->isValid()) {
                $em->flush();
        
                return $this->redirectToRoute('player_show', [
                    'playerId' => $player->getId(),
                ]);
            }
        }

        return $this->render('player/new.html.twig',[
            'step' => $step,
            'playerId' => $playerId,
            'newPlayerForm' => $newFormPlayer,
            'newContactForm' => $newFormContact,
            'newRelationForm' => $newFormRelation,
            'newTeamForm' => $newFormTeam,
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
        $newFormPlayer = $this->createForm(PlayerType::class, $player);
        $newFormPlayer->handleRequest($request);

        if($newFormPlayer->isSubmitted() && $newFormPlayer->isValid()) {
            $em->persist($player);
            $em->flush();

            return $this->redirectToRoute('player_show', array(
                'id' => $player->getId(),
            ));
        }

        return $this->render('player/edit.html.twig', [
            'editPlayerForm' => $newFormPlayer,
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
