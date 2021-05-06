<?php

namespace App\Controller;

use App\Entity\Question;
use App\Entity\Quizz;
use App\Repository\QuestionRepository;
use App\Repository\QuizzRepository;
use App\Repository\ReponseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;

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
     * @Route("/quizz/{id_quizz}", name="quizz_show")
     */
    public function showQuizz(Request $request, QuestionRepository $questionRepository, ReponseRepository $reponse, $id_quizz, PaginatorInterface $paginator,): Response
    {
        $donnees = $questionRepository->findBy([
            "quizz" => $id_quizz
        ]);
        $questions = $paginator->paginate(
            $donnees,
            $request->query->getInt('question', 1),
            1 // Nombre de résultats par page
        );

        foreach ($questions as  $value) {
            $id_question = $value;
        }

        $donnees_reponse = $reponse->findBy(([
            "question" => $id_question
        ]));
        
        return $this->render('quizz/quizz.html.twig', [
            'questions' => $questions,
            "reponses" => $donnees_reponse
        ]);
    }
}
