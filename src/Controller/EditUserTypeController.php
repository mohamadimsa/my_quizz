<?php

namespace App\Controller;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Security\UserChecker;
use App\Form\EditUserType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
class EditUserTypeController extends AbstractController
{
    /**
 * @Route("/utilisateurs/modifier/{id}", name="modifier_utilisateur")
 */
public function editUser(User $user, Request $request,UserPasswordEncoderInterface $passwordEncoder)
{
    $form = $this->createForm(EditUserType::class, $user);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $user->setUpdateAt(
             $form->setUpdateAt= new \DateTime(null, new \DateTimeZone('Europe/Paris')),
        );
        $user->setPassword(
            $passwordEncoder->encodePassword(
                $user,
                $form->get('password')->getData()
            )
        );
        $user->setPseudo(  
                $form->get('firstname')->getData()
        );
        
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        $this->addFlash('message', 'Utilisateur modifié avec succès');
        return $this->redirectToRoute('utilisateurs');
    }
    
    return $this->render('admin/edituser.html.twig', [
        'userForm' => $form->createView(),
    ]);
}
   /**
 * @Route("/utilisateurs/delete/{id}", name="supprimer_utilisateur")
 */
public function deleteUser(User $user, Request $request){
    $users = $this->getDoctrine()->getRepository(User::class)->findOneBy(['id' => $user]);
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->remove($users);
    $entityManager->flush($users);
    $this->addFlash('succes', 'Utilisateur effacé avec succés');
        return $this->redirectToRoute('utilisateurs');
}
}
