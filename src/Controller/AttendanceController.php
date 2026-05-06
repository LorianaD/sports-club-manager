<?php

namespace App\Controller;

use App\Entity\Attendance;
use App\Form\AttendanceType;
use App\Repository\AttendanceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('dashboard/attendance')]
final class AttendanceController extends AbstractController
{
    #[Route('', name: 'attendance_index', methods: ['GET'])]
    public function index(AttendanceRepository $attendanceRepository): Response
    {

        $attendances = $attendanceRepository->findAllAttendance();

        return $this->render('attendance/index.html.twig', [
            'attendances' => $attendances,
        ]);
    }

    #[Route('/new', name: 'attendance_new', methods: ['GET' , 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $newAttendance = new Attendance;

        $formNewAttendance = $this->createForm(AttendanceType::class, $newAttendance);
        $formNewAttendance->handleRequest($request);

        if ($formNewAttendance->isSubmitted() && $formNewAttendance->isValid()) {
            $em->persist($newAttendance);
            $em->flush();

            return $this->redirectToRoute('attendance_index');
        }

        return $this->render('attendance/new.html.twig', [
            'formNewAttendance' => $formNewAttendance,
        ]);
    }

    #[Route('/{id}', name: 'attendance_show', methods: ['GET'])]
    public function show(AttendanceRepository $attendanceRepository, Attendance $attendance): Response
    {

        $id = $attendance->getId();
        $attendance = $attendanceRepository->findAttendanceById($id);


        return $this->render('attendance/show.html.twig', [
            'attendance' => $attendance,
        ]);
    }

    #[Route('/edit/{id}', name: 'attendance_edit', methods: ['GET' , 'POST'])]
    public function edit(Request $request, Attendance $attendance, EntityManagerInterface $em): Response
    {
        $formEditSaction = $this->createForm(attendanceType::class, $attendance);
        $formEditSaction->handleRequest($request);

        if ($formEditSaction->isSubmitted() && $formEditSaction->isValid()) {
            $em->persist($attendance);
            $em->flush();

            return $this->redirectToRoute('attendance_show', array(
                'id' => $attendance->getId(),
            ));
        }

        return $this->render('attendance/edit.html.twig', [
            'formEditattendance' => $formEditSaction,
            'attendance' => $attendance,
        ]);
    }

    #[Route('/{id}/delete', name: 'attendance_delete', methods: ['POST'])]
    public function delete(Request $request, Attendance $attendance, EntityManagerInterface $em)
    {
        if ($this->isCsrfTokenValid('delete' . $attendance->getId(), $request->request->get('_token'))) {
            $em->remove($attendance);
            $em->flush();

            return $this->redirectToRoute('attendance_index');
        }
    }
}
