<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DailyNoteController extends AbstractController
{

    public function index()
    {
        $pageTitle = "Bujo";
        return $this->render('dailyNote.html.twig', [
            'page_title' => $pageTitle]);
    }

}


?>