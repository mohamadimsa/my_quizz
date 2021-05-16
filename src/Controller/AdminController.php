<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends AbstractController
{

    /**
     * @Route("/admin/utilisateurs", name="utilisateurs")
     */
    public function usersList(UserRepository $user)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $users = $this->getUser();
        if (!$users) {
            return $this->redirectToRoute('app_logout');
        } else {
            return $this->render('admin/users.html.twig', [
                'users' => $user->findAll(),
            ]);
        }
    }
}
