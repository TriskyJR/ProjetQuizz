<?php

namespace App\Controller;

use App\Repository\TQuestionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class QuizController extends AbstractController
{
    /**
     * @Route("/quiz", name="quiz")
     */
    public function index(TQuestionRepository $repo)
    {
        $questions = $repo->findAll();
        $nbrQuestions = count($questions);
        for($i=1; $i <= $nbrQuestions; $i++){
            $nbr[] = $i;
        }

        return $this->render('quiz/index.html.twig', [
            'questions' => $questions,
            'nbrQuestion' => $nbr
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('quiz/home.html.twig', [

        ]);
    }

    /**
     * @Route("/login", name="login")
     *
     * @return void
     */
    public function login()
    {
        return $this->render('quiz/login.html.twig');
    }
}
