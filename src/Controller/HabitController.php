<?php

namespace App\Controller;

use App\Entity\Habit;
use App\Form\HabitType;
use App\Repository\HabitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class HabitController extends AbstractController
{
    public function index(HabitRepository $habitRepository)
    {
        $habits= $habitRepository->findAll();
        return $this->render('habit.html.twig',[
            'habits' => $habits
        ]);
    }

    public function handler(Request $request, EntityManagerInterface $entityManager)
    {

        $habit = new Habit();

        $form = $this->createForm(HabitType::class, $habit);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager->persist($habit);
                $entityManager->flush();
                return $this->redirect($this->generateUrl('habit'));
            }
        }

        return $this->render('createUpdatePages/newHabitForm.html.twig', [
            'form' => $form->createView()
        ]);
    }
}

?>
