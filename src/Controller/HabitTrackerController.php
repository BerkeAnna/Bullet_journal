<?php

namespace App\Controller;

use App\Entity\HabitTracker;
use App\Form\HabitTrackerType;
use App\Repository\HabitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HabitTrackerController extends AbstractController
{

    public function index(int $year, int $month, int $day, Request $request, EntityManagerInterface $entityManager, HabitRepository $habitRepository): Response
    {
        $habitTracker = new HabitTracker();
        $habitTracker->setDate(new \DateTime(sprintf('%04d-%02d-%02d', $year, $month, $day)));
        //todo: list of habits name with querybuilder and add to twig to list in first column
        $habits = $habitRepository->findHabitName();
//        dd($habits);


        $form = $this->createForm(HabitTrackerType::class, $habitTracker);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager->persist($habitTracker);
                $entityManager->flush();

                $this->addFlash('success', 'Habit has been updated.');

                return $this->redirectToRoute('hb', [
                    'year' => $year,
                    'month' => $month,
                    'day' => $day,
                ]);
            }
        }

        return $this->render('createUpdatePages/hb.html.twig', [
            'form' => $form->createView(),
            'year' => $year,
            'month' => $month,
            'day' => $day,
            'habits' => $habits,
        ]);
    }
}
