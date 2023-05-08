<?php

namespace App\Controller;

use App\Entity\BookTag;
use App\Form\BookTagType;
use App\Repository\BookTagRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class BookTagController extends AbstractController
{

    public function index()
    {
        //todo: a table with tags, to edit or delete like Minible blog
    }

    public function handler(Request $request, EntityManagerInterface $entityManager)
    {
        $bookTag = new BookTag();

        $form  =$this->createForm(BookTagType::class, $bookTag);
        if ($request->isMethod('POST')) {

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager->persist($bookTag);
                $entityManager->flush();
                return $this->redirect($this->generateUrl('bookIndex'));
            }
        }


        return $this->render('createUpdatePages/newEditBookTagForm.html.twig',[
            'form' => $form->createView(),
        ]);


    }

}