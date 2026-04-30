<?php

namespace App\Controller;

use App\Entity\ContactPersons;
use App\Form\ContactPersonsType;
use App\Repository\ContactPersonsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/contact-persons')]
final class ContactPersonsController extends AbstractController
{
    #[Route('/', name: 'contactPersons_index')]
    public function index(): Response
    {

        return $this->render('contact_persons/index.html.twig', [
            'persons' => 'ContactPersonsController',
        ]);
    }

    // #[Route('/new', name: 'contactPersons_new')]
    // public function new(Request $request, EntityManagerInterface $em): Response
    // {

    //     $newContact = new ContactPersons;

    //     $formContact = $this->createForm(ContactPersonsType::class, $newContact);
    //     $formContact->handleRequest($request);

    //     if ($formContact->isSubmitted() && $formContact->isValid()) {
    //         $em->persist($formContact);
    //         $em->flush();

    //         return $this->redirectToRoute('player_index');
    //     }

    //     return $this->render('contact_persons/forms/_create.html.twig', [
    //         'newFormPerson' => $formContact,
    //     ]);

    // }

    #[Route('/show', name: 'contactPersons_show')]
    public function show(): Response
    {

        return $this->render('contact_persons/index.html.twig', [
            'person' => 'ContactPersonsController',
        ]);
    }

    #[Route('/edit', name: 'contactPersons_edit')]
    public function edit(): Response
    {

        return $this->render('contact_persons/index.html.twig', [
            'editFormPerson' => 'ContactPersonsController',
        ]);
    }

    #[Route('/delete', name: 'contactPersons_delete')]
    public function delete(): Response
    {

        return $this->render('contact_persons/index.html.twig', [
            'deletePerson' => 'ContactPersonsController',
        ]);
    }

}
