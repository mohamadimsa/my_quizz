<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ProfilTypeForm;
use App\Form\EditProfil;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'profil')]
    public function index(): Response
    {
        return $this->render('profil/index.html.twig', [
           
        ]);
    }

/**
 * @Route("user/profil", name="show_profil")
 */

 public function show_profil() : Response
 {
     
     return $this->render('profil/index.html.twig');
 }



 /**
 * @Route("/profil/edit/{id}", name="modifier_profil")
 */
public function editUser(User $user,UserRepository $utilisateur, Request $request,UserPasswordEncoderInterface $passwordEncoder,\Swift_Mailer $mailer)
{
    $user = $this->getUser();
            if ($user !== null) {
                $users = $utilisateur->find($user->getId());
               
            
    $form = $this->createForm(EditProfil::class, $user);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $user->setUpdateAt(
             $form->setUpdateAt= new \DateTime(null, new \DateTimeZone('Europe/Paris')),
        );
        $userss = $this->getDoctrine()->getRepository(User::class)->findOneBy(['password' => $form->get('password')->getData()]);
        if(!$userss){
              $user->setPassword(
                $passwordEncoder->encodePassword(
                            $user,
                            $form->get('password')->getData()
                        )
                        );
        }
        
        
    
        $user->setPseudo(  
                $form->get('firstname')->getData()
        );
     
        $users = $this->getDoctrine()->getRepository(User::class)->findOneBy(['email' => $form->get('email')->getData()]);
        if(!$users){
            $user->setActivationToken(md5(uniqid()));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            $message = (new \Swift_Message('Nouveau compte'))
            // On attribue l'expéditeur
            ->setFrom('votre@adresse.fr')
            // On attribue le destinataire
            ->setTo($user->getEmail())
            // On crée le texte avec la vue
            ->setBody(
                $this->renderView(
                    'registration/send_email.html.twig', ['token' => $user->getActivationToken()]
                ),
                'text/html'
            );
        
            $mailer->send($message);
            $this->addFlash('success', "Votre compte a été désactiver,veuillez l'activer en cliquant sur le lien envoyé par mail");
            return $this->redirectToRoute('app_logout');
        }
        
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        $this->addFlash('success', 'Votre profil a été modifié avec succès');
        return $this->redirectToRoute('home');
    }
    
    return $this->render('profil/EditProfil.html.twig', [
        'editForm' => $form->createView(),
    ]);
            }
}
}
