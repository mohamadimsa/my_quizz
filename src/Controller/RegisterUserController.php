<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterUserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterUserController extends AbstractController
{
    /**
    *@Route("/register_user", name="register_user")
    */
    public function register_user(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new User();
        $form = $this->createForm(RegisterUserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('password')->getData()
                )
            );
            $user->setPseudo(  
                    $form->get('firstname')->getData()
            );
            
            try{
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();
                $this->addFlash('success', 'Utilisateur ajouté avec succès');
                return $this->redirectToRoute('utilisateurs');
            } catch (\Exception $e) {
                $this->addFlash('warning', $e->getMessage());
            }
    }
   
   
    return $this->render('admin/register_user.html.twig', [
        'registerUserType' => $form->createView(),
    ]);
    
   
   
}
}