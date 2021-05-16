<?php

namespace App\Controller;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\User\UserInterface;


class DashboardController extends AbstractController 
{
    #[Route('/dashboard', name: 'dashboard')]
    public function index(Request $request, SessionInterface $session ,UserInterface $user): Response
    {
       
        
    
      
    
        
        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
        ]);

        
    }
}
