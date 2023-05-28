<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\String\Slugger\SluggerInterface;

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


    public function handler( Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger)
    {
        $book = new Book();
        $form = $this->createForm(BookType::class, $book);

        if ($request->isMethod('POST')) {

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
//                dd($form->get('image')->getData());
                /** @var UploadedFile $brochureFile */
                $brochureFile = $form->get('image')->getData();

                if ($brochureFile) {
                    $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                    // this is needed to safely include the file name as part of the URL
                    $safeFilename = $slugger->slug($originalFilename);
                    $newFilename = $safeFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();

                    // Move the file to the directory where brochures are stored
                    try {
                        $brochureFile->move(
                            $this->getParameter('bookCovers'),
                            $newFilename
                        );
                    } catch (FileException $e) {
                        // ... handle exception if something happens during file upload
                    }

                    // updates the 'brochureFilename' property to store the PDF file name
                    // instead of its contents
                    $book->setImage($newFilename);
                }


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