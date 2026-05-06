<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Position;
use App\Form\CategoryType;
use App\Form\PositionType;
use App\Repository\CategoryRepository;
use App\Repository\PositionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/more')]
final class MoreController extends AbstractController
{
    #[Route('/', name: 'more_index', methods: ['GET'])]
    public function index(CategoryRepository $categoryRepository, PositionRepository $positionRepository): Response
    {

        $categories = $categoryRepository->findAllCategories();
        $positions = $positionRepository->findAllPosition();

        return $this->render('more/index.html.twig', [
            'categories' => $categories,
            'positions' => $positions,
        ]);
    }

    // CREATE

    #[Route('/newCategory', name: 'more_newCategory', methods:['GET' , 'POST'])]
    public function newCategory(Request $request, EntityManagerInterface $em): Response
    {

        $newCategory = new Category;

        $newCategoryForm = $this->createForm(CategoryType::class, $newCategory);

        $newCategoryForm->handleRequest($request);

        if ($newCategoryForm->isSubmitted() && $newCategoryForm->isValid()) {
            $em->persist($newCategory);
            $em->flush();

            return $this->redirectToRoute('more_index');
        }

        return $this->render('more/form/category/newCategory.html.twig', [
            'newCategoryForm' => $newCategoryForm,
        ]);
    }

    #[Route('/newPosition', name: 'more_newPosition', methods:['GET' , 'POST'])]
    public function newPosition(Request $request, EntityManagerInterface $em): Response
    {

        $newPosition = new Position;

        $newPositionForm = $this->createForm(PositionType::class, $newPosition);

        $newPositionForm->handleRequest($request);

        if ($newPositionForm->isSubmitted() && $newPositionForm->isValid()) {
            $em->persist($newPosition);
            $em->flush();

            return $this->redirectToRoute('more_index');
        }

        return $this->render('more/form/position/newPosition.html.twig', [
            'newPositionForm' => $newPositionForm,
        ]);
    }

    // UPDATE

    #[Route('/editCategory/{id}', name: 'more_editCategory', methods:['GET' , 'POST'])]
    public function editCategory(Category $category, Request $request, EntityManagerInterface $em): Response
    {

        $editCategoryForm = $this->createForm(CategoryType::class, $category);

        $editCategoryForm->handleRequest($request);

        if ($editCategoryForm->isSubmitted() && $editCategoryForm->isValid()) {
            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute('more_index');
        }

        return $this->render('more/form/category/editCategory.html.twig', [
            'editCategoryForm' => $editCategoryForm,
        ]);
    }      

    #[Route('/editPosition/{id}', name: 'more_editPosition', methods:['GET' , 'POST'])]
    public function editPosition(Position $position, Request $request, EntityManagerInterface $em): Response
    {

        $editPositionForm = $this->createForm(PositionType::class, $position);

        $editPositionForm->handleRequest($request);

        if ($editPositionForm->isSubmitted() && $editPositionForm->isValid()) {
            $em->persist($position);
            $em->flush();

            return $this->redirectToRoute('more_index');
        }

        return $this->render('more/form/position/editPosition.html.twig', [
            'editPositionForm' => $editPositionForm,
        ]);
    }

    // DELETE

    #[Route('/{id}/deletePosition', name: 'more_deletePosition', methods:['POST'])]
    public function deletePosition(Position $position, Request $request, EntityManagerInterface $em)
    {
        if ($this->isCsrfTokenValid('delete' . $position->getId(), $request->request->get('_token'))) {
            $em->remove($position);
            $em->flush();

            return $this->redirectToRoute('more_index');
        }
    }

    #[Route('/{id}/deleteCategory', name: 'more_deleteCategory', methods:['POST'])]
    public function deleteCategory(Category $category, Request $request, EntityManagerInterface $em)
    {
        if ($this->isCsrfTokenValid('delete' . $category->getId(), $request->request->get('_token'))) {
            $em->remove($category);
            $em->flush();

            return $this->redirectToRoute('more_index');
        }
    }
}
