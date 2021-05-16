<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Entity\Quizz;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use App\Repository\CategoriesRepository;
use App\Repository\QuizzRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index( Request $request ,SessionInterface $session): Response

    {

      
          
             
          
        $categories = $this->getDoctrine()->getRepository(Categories::class)->findAll();

        return $this->render('home/index.html.twig', compact('categories'));
    }

    

    /**
     *@Route("/categorie/{name}" ,"home_categorie")
     */
    public function show_categories($name, CategoriesRepository $categoriesRepository, QuizzRepository $quizzRepository)
    {
        $categories_name = $this->getDoctrine()->getRepository(Categories::class)->findAll();

        $categories = $categoriesRepository->findBy([
            "name" => $name
        ]);

        if (count($categories) == 0) {
            $error = "Cette categorie n'existe pas";

            return $this->render("home/listQuizz.html.twig", [
                "error" => $error,
                "categories" => $categories_name
            ]);
        }
      

        $id_categories = $categories[0]->getId();

        $quizz = $quizzRepository->findBy([
            "categories" => $id_categories
        ]);

        if (count($quizz) == 0) {
            $error = "Aucun quizz n'a été trouvé";

            return $this->render("home/listQuizz.html.twig", [
                "error" => $error,
                "categories" => $categories_name
            ]);
        }

        return $this->render("home/listQuizz.html.twig",[

           "listQuizzs" => $quizz,
           "categories" => $categories_name,
           "name"=> $name
        ]);
    }
}
