<?php

namespace App\Controller;

use App\Entity\Sanction;
use App\Form\SanctionType;
use App\Repository\SanctionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/dashboard/sanction')]
final class SanctionController extends AbstractController
{
    #[Route('', name: 'sanction_index', methods: ['GET'])]
    public function index(SanctionRepository $sanctionRepository): Response
    {
        $sanctions = $sanctionRepository->findAllSanction();

        return $this->render('sanction/index.html.twig', [
            'sanctions' => $sanctions,
        ]);
    }

    #[Route('/new', name: 'sanction_new', methods: ['GET' , 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $newSantion = new Sanction;

        $formNewSaction = $this->createForm(SanctionType::class, $newSantion);
        $formNewSaction->handleRequest($request);

        if ($formNewSaction->isSubmitted() && $formNewSaction->isValid()) {
            $em->persist($newSantion);
            $em->flush();

            return $this->redirectToRoute('sanction_index');
        }

        return $this->render('sanction/new.html.twig', [
            'formNewSanction' => $formNewSaction,
        ]);
    }

    #[Route('/show/{id}', name: 'sanction_show', methods: ['GET'])]
    public function show(Sanction $sanction, SanctionRepository $sanctionRepository): Response
    {
        $id = $sanction->getId();
        $sanction = $sanctionRepository->findSanctionById($id);

        return $this->render('sanction/show.html.twig', [
            'sanction' => $sanction,
        ]);
    }

    #[Route('/edit/{id}', name: 'sanction_edit', methods: ['GET' , 'POST'])]
    public function edit(Request $request, Sanction $sanction, EntityManagerInterface $em): Response
    {
        $formEditSaction = $this->createForm(SanctionType::class, $sanction);
        $formEditSaction->handleRequest($request);

        if ($formEditSaction->isSubmitted() && $formEditSaction->isValid()) {
            $em->persist($sanction);
            $em->flush();

            return $this->redirectToRoute('sanction_show', array(
                'id' => $sanction->getId(),
            ));
        }

        return $this->render('sanction/edit.html.twig', [
            'formEditSanction' => $formEditSaction,
            'sanction' => $sanction,
        ]);
    }

    #[Route('/{id}/delete', name: 'sanction_delete', methods: ['POST'])]
    public function delete(Request $request, Sanction $sanction, EntityManagerInterface $em)
    {
        if ($this->isCsrfTokenValid('delete' . $sanction->getId(), $request->request->get('_token'))) {
            $em->remove($sanction);
            $em->flush();

            return $this->redirectToRoute('sanction_index');
        }
    }
}