<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Rate;
use App\Form\BookType;
use App\Repository\BookRepository;
use App\Repository\CategoryRepository;
use App\Repository\RateRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index(BookRepository $repo)
    {
        $books = $repo->findBy(array(), array('id' => 'DESC'));

        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'books' => $books
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function home(BookRepository $repo){
        $books = $repo->findBy(array(), array('id' => 'desc'), 6, 0);

        return $this->render('blog/home.html.twig', [
            'books' => $books
        ]);
    }

    /**
     * @Route("/blog/new", name="blog_create")
     * @Route("/blog/{id}/edit", name="blog_edit")
     */
    public function form(Book $book = null,Request $request, ManagerRegistry $managerRegistry){
        if(!$this->getUser()){
            return $this->redirectToRoute('security_login');
        }

        if(!$book){
            $book = new book();
        }

        $form = $this->createForm(BookType::class, $book);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $managerRegistry->getManager();
            $user = $this->container->get('security.token_storage')->getToken()->getUser();
            $book->setUser($user);
            $em->persist($book);
            $em->flush();

            return $this->redirectToRoute('blog_show', ['id' => $book->getId()]);
        }

        return $this->render('blog/create.html.twig', [
            'formBook' => $form->createView(),
            'editMode' => $book->getId() !== null,
        ]);
    }

    /**
     * @Route("/blog/{id}", name="blog_show")
     */
    public function show(BookRepository $repo, $id, Request $request, ManagerRegistry $managerRegistry){
        if(!$this->getUser()){
            return $this->redirectToRoute('security_login');
        }

        $book = $repo->find($id);

        $user = $this->getUser();

        $rateRepo = $this->getDoctrine()->getRepository(Rate::class);

        $userRate = $rateRepo->findByBookAndUser($book, $user);

        $canVote = false;

        if(empty($userRate)){
            $canVote = true;
        }

        $rate = new Rate();

        $form = $this->createFormBuilder($rate)
                    ->add('rate', ChoiceType::class, [
                        'choices' => [
                            '1' => 1,
                            '1.5' => 1.5,
                            '2' => 2,
                            '2.5' => 2.5,
                            '3' => 3,
                            '3.5' => 3.5,
                            '4' => 4,
                            '4.5' => 4.5,
                            '5' => 5
                        ],
                    ])
                    ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $managerRegistry->getManager();
            $user = $this->container->get('security.token_storage')->getToken()->getUser();
            $rate->setBook($book);
            $rate->setUser($user);
            $em->persist($rate);
            $em->flush();
        }

        return $this->render('blog/show.html.twig',[
            'book' => $book ,
            'formRate' => $form->createView(),
            'vote' => $canVote
        ]);
    }
}
