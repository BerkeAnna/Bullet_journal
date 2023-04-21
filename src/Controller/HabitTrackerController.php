<?php

namespace App\Controller;

use App\Entity\Habit;
use App\Entity\HabitTracker;
use App\Form\HabitType;
use App\Repository\HabitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class HabitTrackerController extends AbstractController
{


    public function handler(Request $request, EntityManagerInterface $entityManager)
    {

        $habitTracker = new HabitTracker();

        //Todo: nem kell formType, elég egy olyan mint a blog searchnél.
        //Majd a habit tábla megkapja egy tömbben a habittrackerrek id-ját és úgy tudom listázni. Ha van arra a napra akkor oké

//        if ($request->isMethod('POST')) {
//            $form->handleRequest($request);
//            if ($form->isSubmitted() && $form->isValid()) {
//                $entityManager->persist($habit);
//                $entityManager->flush();
//                return $this->redirect($this->generateUrl('habit'));
//            }
//        }

//        return $this->render('createUpdatePages/newHabitForm.html.twig', [
//            'form' => $form->createView()
//        ]);
    }
}

?>
