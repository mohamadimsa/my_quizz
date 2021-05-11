<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Entity\Quizz;
use App\Repository\CategoriesRepository;
use App\Repository\QuizzRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        $categories = $this->getDoctrine()->getRepository(Categories::class)->findAll();

        return $this->render('home/index.html.twig', compact('categories'));
    }

    /**
     *@Route("/categorie/{name}" ,"home_categorie")
     */
    public function show_categories($name, CategoriesRepository $categoriesRepository, QuizzRepository $quizzRepository)
    {

        $categories = $categoriesRepository->findBy([
            "name" => $name
        ]);

        if (count($categories) == 0) {
            $error = "cette categorie n'existe pas";

            return $this->render("home/listQuizz.html.twig", [
                "error" => $error
            ]);
        }

        $id_categories = $categories[0]->getId();

        $quizz = $quizzRepository->findBy([
            "categories" => $id_categories
        ]);

        if (count($quizz) == 0) {
            $error = "aucun quizz n'a etait trouver";

            return $this->render("home/listQuizz.html.twig", [
                "error" => $error
            ]);
        }

        return $this->render("home/listQuizz.html.twig",[

           "listQuizzs" => $quizz
        ]);
    }
}
