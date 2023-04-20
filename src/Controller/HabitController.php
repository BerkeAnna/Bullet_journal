<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HabitController extends AbstractController
{
    public function index()
    {
        return $this->render('habit.html.twig');
    }
}

?>
