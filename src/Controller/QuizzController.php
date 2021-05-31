<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Entity\Historique;
use App\Entity\Question;
use App\Entity\Quizz;
use App\Entity\Reponse;
use App\Entity\Reponsehistorique;
use App\Entity\User;
use App\Repository\CategoriesRepository;
use App\Repository\QuestionRepository;
use App\Repository\QuizzRepository;
use App\Repository\ReponseRepository;
use App\Repository\UserRepository;
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
    public function create(CategoriesRepository $categoriesRepository, Request $request, EntityManagerInterface $em)
    {


        if ($request->get("form") !== null and count($request->get("form"))) {
            $donnees = $request->get("form");

            // dd($donnees);

            $categories = $categoriesRepository->find($donnees["categorie"]);

            // dd($categories);

            $quizz = new Quizz;
            $quizz->setName($donnees["name_quizz"]);
            $quizz->setCategories($categories);
            $em->persist($quizz);

            for ($i = 1; $i < 11; $i++) {
                $question = new Question;
                $question->setQuestion($donnees["question_$i"]);
                $question->setQuizz($quizz);
                $question->setIndexQuestion($i);
                $em->persist($question);
                for ($j = 1; $j < 5; $j++) {
                    $reponse = new Reponse;

                    $reponse->setReponse($donnees["rep_$j" . "_$i"]);
                    if ($donnees["corect_reponse$i"] !== "rep_$j" . "_$i") {
                        $reponse->setIndiceReponse(0);
                    } else {
                        $reponse->setIndiceReponse(1);
                    }
                    $reponse->setQuestion($question);
                    $em->persist($reponse);


                    // $reponse->setIndiceReponse(int)
                }
            }

            $em->flush();
        }


        $categories_donnee = $categoriesRepository->findAll();
        $list = [];
        $list[""] = "";

        for ($i = 0; $i < count($categories_donnee); $i++) {
            $list[$categories_donnee[$i]->getName()] = $categories_donnee[$i]->getId();
        }

        $form = $this->createFormBuilder()
            ->add("name_quizz", TextType::class, [
                "label" => "Nom du quizz : "
            ])
            ->add("categorie", ChoiceType::class, [
                "choices" => $list,
                "label" => "Selectionner une categorie :"
            ]);;

        for ($i = 1; $i < 11; $i++) {

            $form->add("question_$i", TextType::class)
                ->add("rep_1_$i", TextType::class, [
                    "label" => "choix :1"
                ])

                ->add("rep_2_$i", TextType::class, [
                    "label" => "choix :2"
                ])
                ->add("rep_3_$i", TextType::class, [
                    "label" => "choix :3"
                ])
                ->add("rep_4_$i", TextType::class, [
                    "label" => "choix :4"
                ])
                ->add("corect_reponse$i", ChoiceType::class, [
                    'choices' => [
                        "choix 1" => "rep_1_$i",
                        "choix 2" => "rep_2_$i",
                        "choix 3" => "rep_3_$i",
                        "choix 4" => "rep_4_$i"
                    ],
                    'label' => "Quelle est la bonne reponse  ? : "
                ]);
        }
        $form->add("Cree_le_Quizz", SubmitType::class);

        $view =  $form->getForm()->createView();
        $categories = $this->getDoctrine()->getRepository(Categories::class)->findAll();

        return $this->render('quizz/create.html.twig', [
            "monform" => $view, 
            "categories" => $categories

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
        if (count($score)> 10) {
            $session->set('score', []);
        }
        
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
                'expanded' => true,
                'label' => "Selectionne la bonne reponse :", 
                'choices' => $option,
                "attr"=> [
                    "class"=> "reponse d-flex flex-column-reverse"
                ]
            ])

            ->add($name_btn, SubmitType::class, [
                "attr"=> [
                    "class"=> "bouton_question_suivante btn btn-outline-danger"
                ]
            ]) 
            ->getForm();

        $view = $form->createView();
        $score = $session->get('score_final', []);
        $session->set("score_final", []);
        $categories = $this->getDoctrine()->getRepository(Categories::class)->findAll();

        return $this->render('quizz/quizz.html.twig', [
            'questions' => $questions,
            "reponses" => $donnees_reponse,
            "monformulaire" => $view,
            "categories" => $categories

        ]);
    }
    /**
     * @Route("/quizz/delete/{id}", name="quizz_delete" )
     */
    public function deleteUser(Request $request, QuestionRepository $questionRepository, ReponseRepository $reponse, $id, QuizzRepository $quizzRepository){

        $quizz =  $this->getDoctrine()->getRepository(Quizz::class)->findAll([
            "id" => $id
        ]);
        foreach ($quizz as $value) {
            $historique=  $this->getDoctrine()->getRepository(Historique::class)->findAll([
                "quizz" => $value->getId()
            ]);
        }
        foreach ($historique as $key) {
            $reponsehisto=$this->getDoctrine()->getRepository(Reponsehistorique::class)->findAll([
            
                "historique"=>$key->getId()
            ]);
       }
        
       foreach ($quizz as $key) {
        $question=$this->getDoctrine()->getRepository(Question::class)->findAll([
            
            "quizz" => $key->getId()
        ]);
       }
       foreach ($question as $key) {
        $response=$this->getDoctrine()->getRepository(Reponse::class)->findAll([
            "question" => $key->getId()
        ]);
       }
      
        $entityManager = $this->getDoctrine()->getManager();
        foreach ($reponsehisto as $value) {
            $entityManager->remove($value);
        }
        foreach ($historique as $value) {
            $entityManager->remove($value);
        }
        foreach ($response as $value) {
            $entityManager->remove($value);
        }
        foreach ($question as $value) {
            $entityManager->remove($value);
        }
        foreach ($quizz as $value) {
            $entityManager->remove($value);
        }
        $entityManager->flush();
       
        $this->addFlash('success', 'Quizz effacé avec succés');
            return $this->redirectToRoute('home');

    }

    /**
     * @Route("/score", name="quizz_score")
     */
    public function score(UserRepository $utilisateur,SessionInterface $session, Request $request, ReponseRepository $reponseRepository, QuestionRepository $questionRepository,EntityManagerInterface $em, QuizzRepository $quizzRepository, CategoriesRepository $categoriesRepository)
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


       
         /**envoie dans la bases de donner historique */
         foreach ($score as $key => $value) {
            $id_question = $key;
        }
        $cat_temp = $questionRepository->findOneBy([
            "id" => $id_question
        ])->getId();

        $id_quizz = $questionRepository->findOneBy([
            "id"=> $cat_temp
        ])->getQuizz()->getId();

        $id_cate = $quizzRepository->findOneBy([
            "id"=> $id_quizz
        ])->getCategories()->getId();



        $categories = $categoriesRepository->find($id_quizz);
        $quizz = $quizzRepository->find($id_cate);
        


           $user = $this->getUser();
            if ($user !== null) {
                $users = $utilisateur->find($user->getId());
                $historique = new Historique ;
                $historique->setCategories($categories);
                $historique->setQuizz($quizz);
                $historique->setUsers($users);
                $historique->setDate(new \DateTime());
                $historique->setScore( (string) $score_pourcentage);
                $em->persist($historique);
        
                
                $rephistorique = new Reponsehistorique;
                $rephistorique->setHistorique($historique);
                $rephistorique->setReponse($donnees_final);
                   $em->persist($rephistorique);
                
                $em->flush();
               
            }
            else{
                //code historique cookie
            }

        /**fin de l'envois */

        $session->set('score_final', $donnees_final);

        $score = $session->get('score_final');
        $session->set('score', []);
        $categories = $this->getDoctrine()->getRepository(Categories::class)->findAll();
        return $this->render('quizz/resultat.html.twig', [
            "result" => $score,
            "score" => $score_pourcentage,
            'categories' => $categories
        ]);
    }
}
