<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController
{
public function index()
{
    $pageTitle = "Bujo";
return $this->render('base.html.twig', [
    'page_title' => $pageTitle,
]);
}
}

?>
