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

        return $this->render('quiz/index.html.twig', [
            'questions' => $questions,
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
}
