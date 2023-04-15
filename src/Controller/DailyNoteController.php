<?php

namespace App\Controller;

use App\Entity\DailyHelper;
use App\Form\DailyHelperType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class DailyNoteController extends AbstractController
{

    public function index(Request $request)
    {
        $dailyHelper = new DailyHelper();
        $todo = true;

        $form = $this->createForm(DailyHelperType::class, $dailyHelper, [
            'todo' => $todo,
        ]);

        $pageTitle = "Bujo";
        return $this->render('dailyNote.html.twig', [
            'page_title' => $pageTitle,
            'form' => $form->createView()]);
    }


}


?>