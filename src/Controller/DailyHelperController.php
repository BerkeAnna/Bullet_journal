<?php

namespace App\Controller;

use App\Entity\DailyHelper;
use App\Form\DailyHelperType;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class DailyHelperController extends AbstractController
{

    public function TodoHandler(Request $request, EntityManagerInterface $entityManager)
    {
        $dailyHelper = new DailyHelper();
        $todo = true;

        $form = $this->createForm(DailyHelperType::class, $dailyHelper, [
            'todo' => $todo,
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $dailyHelper->setName($form->getName());
            $dailyHelper->setDate(new DateTime());
            $dailyHelper->setCompleted(false);
            $dailyHelper->setType("todo");
            //Todo: a dailyhelpert majd úgy tudom hozzáadni, hogy sql-ben megnézem a dátumot, hogy ugyanaz legyen, meg a user is
            $entityManager->persist($dailyHelper);
            $entityManager->flush();
        }

        $newToDo = "ezt majd meg kell csinálni";
        return $this->render('dailyNote.html.twig', [
            'form' => $form->createView(),
            'newToDo' => $newToDo
        ]);
    }

    public function Handler(Request $request, EntityManagerInterface $entityManager)
    {
        $dailyHelper = new DailyHelper();
        $createType = $request->attributes->get("name");
        $noteType = "note";
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
        $form->handleRequest($request);
//        dd($form);
        if ($form->isSubmitted() && $form->isValid()) {

//            $dailyHelper->setName();
            $dailyHelper->setDate(new DateTime());
            $dailyHelper->setCompleted(false);
            $dailyHelper->setType($noteType);
            //Todo: a dailyhelpert majd úgy tudom hozzáadni, hogy sql-ben megnézem a dátumot, hogy ugyanaz legyen, meg a user is
//            dd($dailyHelper);
            $entityManager->persist($dailyHelper);
            $entityManager->flush();
        }

        return $this->render('createUpdatePages/dailyHelperForm.html.twig', [
            'form' => $form->createView(),
        ]);
    }


}


?>