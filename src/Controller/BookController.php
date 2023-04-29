<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BookController extends AbstractController
{

    public function index(BookRepository $bookRepository)
    {
        $books = $bookRepository->findAll();
        $booksCount = count($books);
        $shelfCount = ceil($booksCount/4) ;
        $lastRow = $booksCount%4;
        if($lastRow == 0){
            $lastRow=4;
        }

//        dd($lastRow);

        return $this->render('bookshelf.html.twig', [
            'books' => $books,
            'booksCount' => $booksCount,
            'shelfCount' => $shelfCount,
            'lastRow' => $lastRow
        ]);
    }

    public function bookPage(Request $request, int $id, BookRepository $bookRepository)
    {
        $book=$bookRepository->find($id);
//        dd($book);
//        dd($request);
        return $this->render('book.html.twig', [
            'book' => $book
        ]);
    }


    public function handler( Request $request, EntityManagerInterface $entityManager)
    {
        $book = new Book();
        $form = $this->createForm(BookType::class, $book);

        if ($request->isMethod('POST')) {

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager->persist($book);
//                dd($book);
                $entityManager->flush();
                return $this->redirect($this->generateUrl('bookIndex'));
            }
        }


        return $this->render('createUpdatePages/newEditBookForm.html.twig',[
            'form' => $form->createView(),
        ]);
    }

}