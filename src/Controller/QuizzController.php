<?php

namespace App\Controller;

use App\Entity\Question;
use App\Entity\Quizz;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuizzController extends AbstractController
{
    #[Route('/categorie/{id_categories}', name: 'quizz')]
    public function index($id_categories): Response
    {
        $quizzs = $this->getDoctrine()->
        getRepository(Quizz::class)->
        findBy(
            ['categories' => $id_categories]
        );
        return $this->render('quizz/index.html.twig', [
            'quizzs' => $quizzs,
        ]);
    }

     /**
     * @Route("/quizz/{id_quizz}", name="showQuizz")
     */
   public function showQuizz($id_quizz) {
        $questions = $this->getDoctrine()->
        getRepository(Question::class)->
        findBy([
            "quizz" => $id_quizz
        ]);
            
        return $this->render('quizz/quizz.html.twig', [
            'questions' => $questions,
        ]);
    }
}
