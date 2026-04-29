<?php

namespace App\Controller;

use App\Repository\ContactPersonsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

    #[Route('/new', name: 'contactPersons_new')]
    public function new(): Response
    {

        return $this->render('contact_persons/index.html.twig', [
            'newFormPerson' => 'ContactPersonsController',
        ]);
    }

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
