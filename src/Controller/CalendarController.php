<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CalendarController extends AbstractController
{

    public function index(Request $request)
    {
        return $this->render('calendar.html.twig');
    }

}