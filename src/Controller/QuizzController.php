<?php

namespace App\Controller;

use App\Entity\Question;
use App\Entity\Quizz;
use App\Repository\QuestionRepository;
use App\Repository\QuizzRepository;
use App\Repository\ReponseRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class QuizzController extends AbstractController
{
    #[Route('/categorie/{id_categories}', name: 'quizz')]
    public function index($id_categories): Response
    {
        $quizzs = $this->getDoctrine()->getRepository(Quizz::class)->findBy(
            ['categories' => $id_categories]
        );
        return $this->render('quizz/index.html.twig', [
            'quizzs' => $quizzs,
        ]);
    }

    /**
     * @Route("/create/quizz", "quizz_create")
     */
    public function create()
    {
        
        $comp = 0;
        $form = $this->createFormBuilder()
            ->add("name_quizz", TextType::class,[
                "label" => "Nom du quizz : "
            ]);

        for ($i = 1; $i < 11; $i++) {

            $form->add("question_$i", TextType::class)
             ->add("rep_1_$i",TextType::class,[
                 "label"=> "choix :1"
             ])
            
             ->add("rep_2_$i",TextType::class,[
                 "label"=> "choix :2"
             ])
             ->add("rep_3_$i",TextType::class,[
                 "label"=> "choix :3"
             ])
             ->add("rep_4_$i",TextType::class,[
                 "label"=> "choix :4"
             ])
             ->add("corect_reponse$i", ChoiceType::class, [
                'choices' => ["choix 1" => "rep_1_$i",
                              "choix 2" => "rep_2_$i",
                              "choix 3" => "rep_3_$i",
                              "choix 4" => "rep_4_$i"
                             ],
                'label' => "Quelle est la bonne reponse  ? : "
            ])
            ;
            
        }

        $view =  $form->getForm()->createView();

        return $this->render('quizz/create.html.twig', [
            "monform" => $view
        ]);
    }

    /**
     * @Route("/quizz/{id_quizz}", name="quizz_show" )
     */
    public function showQuizz(Request $request, QuestionRepository $questionRepository, ReponseRepository $reponse, $id_quizz, PaginatorInterface $paginator, EntityManagerInterface $em, SessionInterface $session): Response
    {
        $donnees = $questionRepository->findBy([
            "quizz" => $id_quizz
        ]);
        $questions = $paginator->paginate(
            $donnees,
            $request->query->getInt('question', 1),
            1 // Nombre de résultats par page
        );
        $score = $session->get('score', []);
        if ($request->query->getInt('question') > count($donnees)) {
            if (!empty($request->query->getInt('id_question'))) {
                $score[$request->query->getInt('id_question')] = $request->request->get("form", null)["reponse"];
                $session->set("score", $score);
            }

            if (count($session->get('score')) == count($donnees)) {
                return $this->redirectToRoute('quizz_score', [
                    // "score" => $score = $session->get('score')
                ]);
            }
        }
        if (!empty($request->query->getInt('id_question'))) {
            $score[$request->query->getInt('id_question')] = $request->request->get("form", null)["reponse"];
        }

        $session->set("score", $score);

        foreach ($questions as  $value) {
            $id_question = $value;
        }
        $donnees_reponse = $reponse->findBy(([
            "question" => $id_question
        ]));

        $option = [];
        for ($i = 0; $i < count($donnees_reponse); $i++) {

            $reponsee = str_replace('.', '~', $donnees_reponse[$i]->getReponse());

            $option[$reponsee] = $reponsee;
        }

        if ($request->query->getInt('question', 1) == count($donnees)) {
            $name_btn = "Obtenir_le_Resulat";
        } else {
            $name_btn = "Question_suivante";
        }

        $form = $this->createFormBuilder()
            ->setAction($this->generateUrl('quizz_show', [
                "id_quizz" => $id_quizz,
                "question" => $request->query->getInt('question', 1) + 1,
                "id_question" => $id_question->getId()

            ]))
            ->setMethod('POST')
            ->add("reponse", ChoiceType::class, [
                'choices' => $option,
                'expanded' => true,
                'label' => "Selectionne la bonne reponse :"
            ])

            ->add($name_btn, SubmitType::class)
            ->getForm();

        $view = $form->createView();

        $score = $session->get('score_final', []);
        $session->set("score_final", []);

        return $this->render('quizz/quizz.html.twig', [
            'questions' => $questions,
            "reponses" => $donnees_reponse,
            "monformulaire" => $view
        ]);
    }

    /**
     * @Route("/score", name="quizz_score")
     */
    public function score(SessionInterface $session, Request $request, ReponseRepository $reponseRepository, QuestionRepository $questionRepository)
    {


        $score = $session->get("score");


        $verifQuestion = [];
        $question_positif = 0;
        foreach ($score as $key => $value) {

            $donnees = $reponseRepository->findBy([
                "reponse" => $value,
                "question" => $key
            ]);
            foreach ($donnees as $value) {
                if ($value->getIndiceReponse() === 0) {
                    $verifQuestion[$value->getQuestion()->getId()] = 0;
                } else {
                    $verifQuestion[$value->getQuestion()->getId()] = 1;
                    $question_positif++;
                }
            }
        }
        $score_pourcentage = $question_positif * count($score);

        $donnees_final = [];
        $comp = 0;
        foreach ($score as $name_rep) {
            $comp++;
            $donnees_final[$comp]["repUser"] = $name_rep;
        }
        $tab1 = 0;
        foreach ($verifQuestion as $key => $value) {
            $tab1++;
            $donnees_final[$tab1]["result_repUser"] = $value;


            $question = $questionRepository->findBy(
                [
                    "id" => $key
                ]
            );
            $donnees_reponse = $reponseRepository->findBy(([
                "indice_reponse" => 1,
                "question" => $key
            ]));
            foreach ($donnees_reponse as $reps) {

                $donnees_final[$tab1]["corect"] = $reps->getReponse();
            }

            foreach ($question as $questions) {

                $donnees_final[$tab1]["question"] = $questions->getQuestion();
                $donnees_final[$tab1]["index_ques"] = $questions->getIndexQuestion();
            }
        }
        $session->set('score_final', $donnees_final);
        $score = $session->get('score_final');

        return $this->render('quizz/resultat.html.twig', [
            "result" => $score,
            "score" => $score_pourcentage,
        ]);
    }
}
