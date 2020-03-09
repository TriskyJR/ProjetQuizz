<?php

namespace App\Controller;

use App\Entity\TAnswer;
use App\Entity\TQuestion;
use App\Entity\TUserAnswer;
use App\Repository\TAnswerRepository;
use App\Repository\TQuestionRepository;
use App\Repository\TUserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class QuizController extends AbstractController
{
    /**
     * @Route("/quiz", name="quiz")
     */
    public function index(TQuestionRepository $querepo, TAnswerRepository $answerrepo ,TUserRepository $userrepo,TUserAnswer $userAnswer = null ,Session $session, Request $request, ManagerRegistry $managerRegistry)
    {
        $user = $userrepo->find(['id' => 1]);
        $questions = $querepo->findAll();
        $nbrQuestions = count($questions);
        for($i=1; $i <= $nbrQuestions; $i++){
            $nbr[] = $i;
        }
        if(!empty($_POST["answers"])){
            var_dump($_POST['answers']);
            $em = $managerRegistry->getManager();
            foreach($_POST["answers"] as $useAnswer){
                $userAnswer = new TUserAnswer();
                $ans = $answerrepo->find(['id' => $useAnswer]);
                $userAnswer->setAnswer($ans);
                $userAnswer->setUser($user);
                $em->persist($userAnswer);
            }
            
            $em->flush(); 
            return $this->redirectToRoute('quiz');
        }

        return $this->render('quiz/index.html.twig', [
            'questions' => $questions,
            'nbrQuestion' => $nbr,
        ]);

    }
    
    public function SendAnswers(){
        return $this->render('quiz/weefuhfuehf.html.twig', [
            
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

    /**
     * @Route("/new", name="new")
     * @Route("/question/{id}/edit", name="questionEdit")
     */
    public function create(TQuestion $question = null,Request $request, ManagerRegistry $managerRegistry)
    {

        if(!$question){
            $question = new TQuestion();
        }
        
        $form = $this->createFormBuilder($question)
                     ->add('queTitle', TextType::class, [
                         'label' => "Énoncé de la question",
                         'attr' => [
                             'placeholder' => "La maman d'alex"
                         ]
                     ])
                     ->add('queType', ChoiceType::class, [
                         'label' => "Type de question",
                         'choices' => [
                             'Radio bouton' => true,
                             'Checkbox' => false
                         ],
                         'choice_label' => function($choice, $key, $value){
                            return strtoupper($key);
                         },
                     ])
                     ->getForm();


        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $managerRegistry->getManager();
            $em->persist($question);
            $em->flush();
            return $this->redirectToRoute('questions');
        }


        return $this->render('quiz/createQuestion.html.twig',[
            'formQuestion' => $form->createView(),
            'editMode' => $question->getId() !== null

        ]);
    }

    /**
     * @Route("/create", name="createAnswer")
     * @Route("/answer/question={id_question}", name="answerEdit")
     */
    public function createAnswer(TAnswer $answer = null, TQuestionRepository $repo, TAnswerRepository $ansRepo,Request $request, ManagerRegistry $managerRegistry){

        if(!$answer){
            $answer = new TAnswer();
        }

        $id = $request->attributes->get('id_question');
        $question = $repo->findOneBy(['id' => $id]);


        $answers = $ansRepo->findBy(['question' => $question]);

        $formAnswer = $this->createFormBuilder($answer)
                           ->add('ansTitle', TextType::class, [
                                'label' => "Réponse",
                                'attr' => [
                                    'placeholder' => 'Le CLient'
                                ]
                            ])
                            ->add('ansTrueFalse', ChoiceType::class, [
                                'label' => "Réponse juste ou fausse",
                                'choices' => [
                                    'vrai' => true,
                                    'faux' => false
                                ],
                                'choice_label' => function($choice, $key, $value){
                                    return strtoupper($key);
                                },
                            ])
                            ->getForm();

        $formAnswer->handleRequest($request);

        $addMode = true;

        if($formAnswer->isSubmitted() && $formAnswer->isValid()){
            if(count($answers)<5){
                $em = $managerRegistry->getManager();
                $answer->setQuestion($question);
                $em->persist($answer);
                $em->flush();
                return $this->redirect($request->getUri());
            }
            else{
                $addMode = false;
                return $this->redirectToRoute('questions');
            }
        }

        return $this->render('quiz/createAnswer.html.twig', [
            'question' => $question,
            'formAnswer' => $formAnswer->createView(),
            'answers' => $answers,
            'addMode' => $addMode,
            'id' => $id
        ]);
    }

    /**
     * @Route("/adminPanel", name="adminPanel")
     */
    public function adminPanel(TQuestionRepository $repo , TAnswerRepository $ansRepo){


        return $this->render('quiz/adminPanel.html.twig', [


        ]);
    }

    /**
     * @Route("/editQuestions", name="questions")
     */
    public function questions(TQuestionRepository $repo, TAnswerRepository $ansRepo){
        $questions = $repo->findAll();
        $nbrQuestions = count($questions);
        for($i=1; $i <= $nbrQuestions; $i++){
            $nbr[] = $i;
        }
        
        return $this->render('quiz/questions.html.twig', [
            'questions' => $questions,
            'nbrQuestion' => $nbr,

        ]);
    }
    
    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function deleteAtion($id){
        $em = $this->getDoctrine()->getManager();

        $post = $em->getRepository(TAnswer::class)->find($id);

        if(!$post){
            return $this->redirectToRoute('questions');
        }
        $em->remove($post);
        $em->flush();
    }

}
