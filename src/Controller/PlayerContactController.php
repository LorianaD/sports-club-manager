<?php

namespace App\Controller;

use App\Entity\ContactPersons;
use App\Entity\Player;
use App\Entity\PlayerContact;
use App\Form\ContactPersonsType;
use App\Form\PlayerContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/dashboard/player')]
final class PlayerContactController extends AbstractController
{
    #[Route('/{id}/contact/new', name: 'player_contact_new', methods: ['GET' , 'POST'])]
    public function index(Player $player, Request $request, EntityManagerInterface $em): Response
    {
        $newContact = new ContactPersons;
        $newRelation = new PlayerContact;

        $newContactForm = $this->createForm(ContactPersonsType::class, $newContact);
        $newRelationForm = $this->createForm(PlayerContactType::class, $newRelation);

        $newContactForm->handleRequest($request);
        $newRelationForm->handleRequest($request);

        $verifNewContactForm = $newContactForm->isSubmitted() && $newContactForm->isValid();

        if ($verifNewContactForm) {
            $newRelation->setPlayer($player);
            $newRelation->setContactPerson($newContact);

            $em->persist($newContact);
            $em->persist($newRelation);
            $em->flush();

            return $this->redirectToRoute('player_show', [
                'id' => $player->getId(),
            ]);
        }

        return $this->render('player_contact/new.html.twig', [
            'player' => $player,
            'newContactForm' => $newContactForm,
            'newRelationForm' => $newRelationForm
        ]);
    }

    #[Route('/{player}/contact/edit/{relation}', name: 'player_contact_edit', methods: ['GET' , 'POST'])]
    public function edit(Player $player, PlayerContact $relation, Request $request, EntityManagerInterface $em): Response
    {
        $contact = $relation->getContactPerson();

        $newContactForm = $this->createForm(ContactPersonsType::class, $contact);
        $newRelationForm = $this->createForm(PlayerContactType::class, $relation);

        $newContactForm->handleRequest($request);
        $newRelationForm->handleRequest($request);

        $verifNewContactForm = $newContactForm->isSubmitted() && $newContactForm->isValid();

        if ($verifNewContactForm) {
            $em->flush();

            return $this->redirectToRoute('player_show', array(
                'id' => $player->getId(),
            ));
        }

        return $this->render('player_contact/edit.html.twig', [
            'player' => $player,
            'relation' => $relation,
            'newContactForm' => $newContactForm,
            'newRelationForm' => $newRelationForm,
        ]);
    }

    #[Route('/{player}/contact/delete/{relation}', name: 'player_contact_delete', methods: ['POST'])]
    public function delete(Player $player, PlayerContact $relation, Request $request, EntityManagerInterface $em)
    {
        if ($this->isCsrfTokenValid('delete' . $relation->getId(), $request->request->get('_token'))) {
            $em->remove($relation);
            $em->flush();
        }

        return $this->redirectToRoute('player_show', [
            'id' => $player->getId(),
        ]);
    }    
}
