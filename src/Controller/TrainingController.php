<?php

namespace App\Controller;

use App\Entity\TrainingSession;
use App\Form\TrainingType;
use App\Repository\TrainingSessionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/dashboard/planning/training')]
final class TrainingController extends AbstractController
{
    #[Route('', name: 'training_index')]
    public function index(TrainingSessionRepository $trainingSessionRepository): Response
    {
        $trainings = $trainingSessionRepository->findAllTraining();

        return $this->render('training/index.html.twig', [
            'trainings' => $trainings,
        ]);
    }

    #[Route('/new', name: 'training_new')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $newTraining = new TrainingSession;

        $newTrainingForm = $this->createForm(TrainingType::class, $newTraining);
        $newTrainingForm->handleRequest($request);

        if ($newTrainingForm->isSubmitted() && $newTrainingForm->isValid()) {
            $em->persist($newTraining);
            $em->flush();

            return $this->redirectToRoute('training_index');
        }

        return $this->render('training/new.html.twig', [
            'newTrainingForm' => $newTrainingForm,
        ]);
    }

    #[Route('/{id}', name: 'training_show')]
    public function show(TrainingSessionRepository $trainingSessionRepository, TrainingSession $training): Response
    {
        $id = $training->getId();

        $training = $trainingSessionRepository->findTrainingById($id);

        return $this->render('training/show.html.twig', [
            'training' => $training,
        ]);
    }

    #[Route('/{id}/edit', name: 'training_edit')]
    public function edit(Request $request, TrainingSession $training, EntityManagerInterface $em): Response
    {
        $editTrainingForm = $this->createForm(TrainingType::class, $training);
        $editTrainingForm->handleRequest($request);

        if ($editTrainingForm->isSubmitted() && $editTrainingForm->isValid()) {
            $em->persist($training);
            $em->flush();

            return $this->redirectToRoute('training_show', array(
                'id' => $training->getId(),
            ));
        }

        return $this->render('training/edit.html.twig', [
            'training' => $training,
            'editTrainingForm' => $editTrainingForm,
        ]);
    }

    #[Route('/{id}/delete', name: 'training_delete')]
    public function delete(TrainingSession $training, Request $request, EntityManagerInterface $em)
    {
        if ($this->isCsrfTokenValid('delete' . $training->getId(), $request->request->get('_token'))) {
            $em->remove($training);
            $em->flush();

            return $this->redirectToRoute('training_index');
        }
    }
}