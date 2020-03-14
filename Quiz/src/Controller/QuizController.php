<?php

namespace App\Controller;

use App\Entity\TAnswer;
use App\Entity\TQuestion;
use App\Entity\TUserAnswer;
use App\Entity\TUser;
use App\Repository\TAnswerRepository;
use App\Repository\TQuestionRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Repository\TUserRepository;
use App\Controller\FormBuilderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\IsNull;

class QuizController extends AbstractController
{    
    /**
     * @Route("/quiz", name="quiz")
     */
    public function index(TQuestionRepository $querepo, TAnswerRepository $answerrepo ,TUserRepository $userrepo,TUserAnswer $userAnswer = null ,Session $session, Request $request, ManagerRegistry $managerRegistry)
    {
        $nbr[] = null;
        $user = $userrepo->find(['id' => $_SESSION['userID']]);
        if($user->getUseAnswered() == 0){
            $questions = $querepo->findAll();
            $nbrQuestions = count($questions);
            for($i=1; $i <= $nbrQuestions; $i++){
                $nbr[] = $i;
            }
            if(!empty($_POST)){
                var_dump($_POST);
                $em = $managerRegistry->getManager();
                foreach($_POST as $useQuestion){
                    
                    foreach($useQuestion as $useAnswer){
                        $userAnswer = new TUserAnswer();
                        $ans = $answerrepo->find(['id' => $useAnswer]);
                        $userAnswer->setAnswer($ans);
                        $userAnswer->setUser($user);
                        $em->persist($userAnswer);
                    }
                }
                
                $em->flush();
                $user->setUseAnswered(1); 
                return $this->redirectToRoute('quiz');
            }
            return $this->render('quiz/index.html.twig', [
                'questions' => $questions,
                'nbrQuestion' => $nbr, 
                'userID' => $_SESSION['userID']          
            ]);
        }
        else{
            $error = "Vous avez déjà répondu au questionnaire";
            return $this->redirectToRoute('login',array($alreadyAnswered = $error));
        }
    }
    
    /** 
     * @Route("/", name="home")
     */
    public function home(TUserRepository $repo, TUser $class = NULL)
    {
        
        if($this->isGranted('ROLE_USER') == true){          
            $user = $this->get('security.token_storage')->getToken()->getUsername();       
            $dbUser = $repo->findBy(['useUsername' => $user]);  
            if(empty($dbUser)){                  
                $this->firstLog();
                return $this->render('quiz/firstLog.html.twig');
            }         
            $_SESSION['userID'] = $dbUser[0]->getId();
        }
        else{
            return $this->render('quiz/home.html.twig');
        }
        return $this->render('quiz/home.html.twig');

    }

    /**
     * @Route("/firstLog", name="firstLog")
     */
    public function firstLog()
    {
        $user = $this->get('security.token_storage')->getToken()->getUsername();
        $entityManager = $this->getDoctrine()->getManager();
        
                $tUser = new TUser();
                $tUser->setUseUsername($user);
                $tUser->setUseClass('FIN2');
                $tUser->setUseAnswered(0);
                
                $entityManager->persist($tUser);
                
                $entityManager->flush();
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
                             'placeholder' => "intitulé de la question"
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
     * @Route("/answer/question={id_question}", name="answerEdit")
     */
    public function createAnswer(TAnswer $answer = null, TQuestionRepository $repo, TAnswerRepository $ansRepo,Request $request, ManagerRegistry $managerRegistry){

        if(!$answer){
            $answer = new TAnswer();
        }


        $addMode = true;

        $id = $request->attributes->get('id_question');
        $question = $repo->findOneBy(['id' => $id]);


        $answers = $ansRepo->findBy(['question' => $question]);

        if(count($answers) == 5){
            $addMode = false;
        }

        $formAnswer = $this->createFormBuilder($answer)
                           ->add('ansTitle', TextType::class, [
                                'label' => "Réponse",
                                'attr' => [
                                    'placeholder' => 'oui'
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


        if($formAnswer->isSubmitted() && $formAnswer->isValid()){
            if(count($answers) < 5){
                $em = $managerRegistry->getManager();
                $answer->setQuestion($question);
                $em->persist($answer);
                $em->flush();
                return $this->redirect($request->getUri());
            }
            else{
                $addMode = false;
            }
        }


        return $this->render('quiz/createAnswer.html.twig', [
            'question' => $question,
            'formAnswer' => $formAnswer->createView(),
            'answers' => $answers,
            'addMode' => $addMode,
            'id' => $id,
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
        $ans = $em->getRepository(TAnswer::class)->find(['id' => $id]);
        $question = $ans->getQuestion();
        $idQuestion = $question->getId();


        if (!$post) {
            throw $this->createNotFoundException('No answer found for id '.$id);
        }

        $em->remove($post);
        $em->flush();

        return $this->redirectToRoute('answerEdit', array('id_question' => $idQuestion));
    }


    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request, AuthenticationUtils $authUtils, $alreadyAnswered = null)
    {       
        // get the login error if there is one
        $error = $authUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authUtils->getLastUsername();
                              
        return $this->render('quiz/login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
            'alreadyAns' => $alreadyAnswered
        ));
    }   

}
