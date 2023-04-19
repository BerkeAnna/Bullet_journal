<?php

namespace App\Controller;

use App\Entity\DailyHelper;
use App\Form\DailyHelperType;
use App\Repository\DailyHelperRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class DailyHelperController extends AbstractController
{

    public function TodoHandler(Request $request, EntityManagerInterface $entityManager, DailyHelperRepository $dailyHelperRepository)
    {
        $listOfTodos = $dailyHelperRepository->findBy(['type' => 'todo']);
        $listOfEvent = $dailyHelperRepository->findBy(['type' => 'event']);
        //TODO: birthday and nameDay will be one find function in repo
        $listOfBirthday = $dailyHelperRepository->findBy(['type' => 'birthday']);
        $listOfNameDay = $dailyHelperRepository->findBy(['type' => 'nameDay']);
        $listOfNote = $dailyHelperRepository->findBy(['type' => 'note']);

        $dailyHelper = new DailyHelper();
        $todo = true;

        $form = $this->createForm(DailyHelperType::class, $dailyHelper, [
            'todo' => $todo,
        ]);
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $dailyHelper->setDate(new DateTime());
                $dailyHelper->setCompleted(false);
                $dailyHelper->setType("todo");
                //Todo: a dailyhelpert majd úgy tudom hozzáadni, hogy sql-ben megnézem a dátumot, hogy ugyanaz legyen, meg a user is
                $entityManager->persist($dailyHelper);
                $entityManager->flush();
                return $this->redirect($this->generateUrl('dailyNoteIndex'));
            }
        }
        $newToDo = "ezt majd meg kell csinálni";
        return $this->render('dailyNote.html.twig', [
            'form' => $form->createView(),
            'newToDo' => $newToDo,
            'todos' => $listOfTodos,
            'notes' => $listOfNote,
            'events' => $listOfEvent,
            'birthdays' => $listOfBirthday,
            'nameDays' => $listOfNameDay
        ]);
    }


    public function Handler(Request $request, EntityManagerInterface $entityManager)
    {
        $dailyHelper = new DailyHelper();
        $createType = $request->attributes->get("name");
        $noteType = "note";
        $form = $this->createForm(DailyHelperType::class, $dailyHelper, ['note' => true]);
        if ($createType == "note") {
            $form = $this->createForm(DailyHelperType::class, $dailyHelper, ['note' => true]);
        } elseif ($createType == "event") {
            $noteType = "event";
            $form = $this->createForm(DailyHelperType::class, $dailyHelper, ['event' => true]);
        } elseif ($createType == "birthday") {
            $noteType = "birthday";
            $form = $this->createForm(DailyHelperType::class, $dailyHelper, ['birthday' => true]);
        } elseif ($createType == "nameDay") {
            $noteType = "nameday";
            $form = $this->createForm(DailyHelperType::class, $dailyHelper, ['nameDay' => true]);
        }
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {

                if ($createType == "note") {
                    $dailyHelper->setDate(new DateTime());
                }
                $dailyHelper->setCompleted(false);
                $dailyHelper->setType($noteType);
                //Todo: a dailyhelpert majd úgy tudom hozzáadni, hogy sql-ben megnézem a dátumot, hogy ugyanaz legyen, meg a user is

                $entityManager->persist($dailyHelper);
                $entityManager->flush();
                return $this->redirect($this->generateUrl('dailyNoteIndex'));
            }
        }

        return $this->render('createUpdatePages/dailyHelperForm.html.twig', [
            'form' => $form->createView(),
        ]);
    }


}


?>
