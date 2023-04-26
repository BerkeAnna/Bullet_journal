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
    public function index(Request $request, HabitRepository $habitRepository)
    {
        //todo: át kell majd adni külön egy tömbben a daytömböket. ÉS valahogy így fogom tudni lekérni, hogy
        //todo: csak a jó helyen jelölje be
        $habits= $habitRepository->findAll();

//        dd($request);



        $completedHabits = $habitRepository->completedHabits(1);
        $tos = ($completedHabits[1]["date"]);
        $dayss= $tos->format('d');
//        dd($completedHabits);
        $days = [];


        //get datetimes, but we need only days
        for($i=0; $i<count($completedHabits); $i++){
            //select the days
            $dateWithZeros= $completedHabits[$i]["date"]->format('d');
            //if day is less then 10 it has 0, it is trim that
            $dateString = ltrim($dateWithZeros, '0');
            //convert string to int
            $date = intval($dateString);
            array_push($days, $date );
        }
//        dd($days[0]);

        $habitsName = [];
        for($i =0 ; $i<count($habits); $i++){
            $habitsName[$i] = $habits[$i]->getName();
            }

        $completedHabitsByName = array();
            for($i =0 ; $i<count($habits); $i++){
                //todo: Instead of 1, you need an array that stores the days when completed
                $completedHabitsByName[$habitsName[$i]] = "1";
            }

//            dd($completedHabitsByName);


        return $this->render('habit.html.twig',[
            'habits' => $habits,
            'days' => $days,
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
