<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\HistoriqueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class HistoriqueController extends AbstractController
{
    #[Route('/user/{pseudo}/historique', name: 'user_historique')]
    public function index($pseudo,HistoriqueRepository $historiqueRepository): Response
    {  
        $user = $this->getUser();
        
        if($user->getPseudo() !== $pseudo){
           
            return $this->redirectToRoute("user_historique",[
                "pseudo"=> $user->getPseudo()
            ]);
        }

        $all_historique = $historiqueRepository->findOneBy([
            
            "Users" => $user->getId()
        ],[
            "date" => "DESC"
        ]
    );

    dd($all_historique);
        
        
        

        return $this->render('historique/index.html.twig', [
            'controller_name' => 'HistoriqueController',
        ]);
    }
}
