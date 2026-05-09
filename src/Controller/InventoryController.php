<?php

namespace App\Controller;

use App\Entity\Inventory;
use App\Form\EquipmentType;
use App\Repository\InventoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/dashboard/inventory')]
final class InventoryController extends AbstractController
{
    #[Route('', name: 'inventory_index')]
    public function index(InventoryRepository $inventoryRepository): Response
    {

        $equipments = $inventoryRepository->findAllEquipment();

        return $this->render('inventory/index.html.twig', [
            'equipments' => $equipments,
        ]);
    }

    #[Route('/new', name: 'inventory_new')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {

        $newEquipment = new Inventory;
        
        $formNewEquipment = $this->createForm(EquipmentType::class, $newEquipment);
        $formNewEquipment->handleRequest($request);

        if ($formNewEquipment->isSubmitted() && $formNewEquipment->isValid()) {
            $em->persist($newEquipment);
            $em->flush();
            return $this->redirectToRoute('inventory_index');
        }

        return $this->render('inventory/new.html.twig', [
            'formNewEquipment' => $formNewEquipment,
        ]);
    }

    #[Route('/{id}', name: 'inventory_show')]
    public function show(InventoryRepository $inventoryRepository, Inventory $inventory): Response
    {
        $id = $inventory->getId();
        $equipment = $inventoryRepository->findOneById($id);

        return $this->render('inventory/show.html.twig', [
            'equipment' => $equipment,
        ]);
    }

    #[Route('/edit/{id}', name: 'inventory_edit')]
    public function edit(Request $request, EntityManagerInterface $em, Inventory $equipment): Response
    {
        $formEditEquipment = $this->createForm(EquipmentType::class, $equipment);
        $formEditEquipment->handleRequest($request);

        if ($formEditEquipment->isSubmitted() && $formEditEquipment->isValid()) {
            $em->persist($equipment);
            $em->flush();
            return $this->redirectToRoute('inventory_show', array(
                'id' => $equipment->getId(),
            ));
        }

        return $this->render('inventory/edit.html.twig', [
            'formEditEquipment' => $formEditEquipment,
            'equipment' => $equipment,
        ]);
    }

    #[Route('/{id}/delete', name: 'inventory_delete')]
    public function delete(InventoryRepository $inventoryRepository, Inventory $inventory)
    {
        $id = $inventory->getId();
        $equipment = $inventoryRepository->findOneById($id);
    }
}
