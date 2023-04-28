<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BookController extends AbstractController
{

    public function index()
    {
        return $this->render('bookshelf.html.twig');
    }

}