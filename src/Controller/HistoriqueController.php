<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Categories;
use App\Repository\HistoriqueRepository;
use App\Repository\ReponsehistoriqueRepository;
use PhpParser\Node\Stmt\ElseIf_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class HistoriqueController extends AbstractController
{
    #[Route('/user/{pseudo}/historique', name: 'user_historique')]
    public function index($pseudo, HistoriqueRepository $historiqueRepository): Response
    {
        $user = $this->getUser();

        if ($user->getPseudo() !== $pseudo) {

            return $this->redirectToRoute("user_historique", [
                "pseudo" => $user->getPseudo()
            ]);
        }

        $all_historique = $historiqueRepository->findBy(
            [

                "Users" => $user->getId()
            ],
            [
                "date" => "DESC"
            ]
        );


        return $this->render('historique/index.html.twig', [
            'historiques' => $all_historique,
        ]);
    }


    #[Route('/user/{pseudo}/correction/{id}', name: 'user_correction')]
    public function corection($pseudo, $id, ReponsehistoriqueRepository $reponsehistoriqueRepository, HistoriqueRepository $historiqueRepository): Response
    {
        $user = $this->getUser();



        $verif_his = $historiqueRepository->find($id);
     
        if($verif_his !== null){
            if ($verif_his->getUsers()->getId() !== $user->getId()) {
                return $this->redirectToRoute("user_historique", [
                    "pseudo" => $user->getPseudo()
                ]);
            }
        }
        elseif($verif_his === null){
            return $this->redirectToRoute("user_historique", [
                "pseudo" => $user->getPseudo()
            ]);
        }

        if ($user->getPseudo() !== $pseudo) {

            return $this->redirectToRoute("user_historique", [
                "pseudo" => $user->getPseudo()
            ]);
        }

        

        $historique = $reponsehistoriqueRepository->findOneby([
            "historique" => $id
        ]);
        $categories = $this->getDoctrine()->getRepository(Categories::class)->findAll();

        return $this->render('quizz/resultat.html.twig', [
            'result' => $historique->getReponse(),
            'score' =>  $verif_his->getScore(),
            'categories' => $categories
            ]);
    }
}
