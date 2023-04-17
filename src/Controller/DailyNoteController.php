<?php

namespace App\Controller;

use App\Entity\DailyHelper;
use App\Form\DailyHelperType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class DailyNoteController extends AbstractController
{

    public function index(Request $request, EntityManagerInterface $entityManager)
    {
        $dailyHelper = new DailyHelper();
        $todo = true;

        $form = $this->createForm(DailyHelperType::class, $dailyHelper, [
            'todo' => $todo,
        ]);

        $newToDo = $request->request->get("daily_helper")["name"];
        return $this->render('dailyNote.html.twig', [
            'form' => $form->createView(),
            'newToDo' => $newToDo
        ]);
    }


}


?>