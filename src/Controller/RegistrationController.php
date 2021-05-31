<?php

namespace App\Controller;
use App\Entity\Categories;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Form\RegistrationFormType;
use App\Form\ResetPasswordType;
use App\Repository\CategoriesRepository;
use App\Security\EmailVerifier;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
class RegistrationController extends AbstractController
{
    

    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler,\Swift_Mailer $mailer): Response
    {

        if ($this->getUser()) {
            return $this->redirectToRoute('show_profil');
         }
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
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
            $user->setActivationToken(md5(uniqid()));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // generate a signed url and email it to the user
            // do anything else you need here, like send an email
            $message = (new \Swift_Message('Nouveau compte'))
            // On attribue l'expéditeur
            ->setFrom('votre@adresse.fr')
            // On attribue le destinataire
            ->setTo($user->getEmail())
            // On crée le texte avec la vue
            ->setBody(
                $this->renderView(
                    'registration/confirmation_email.html.twig', ['token' => $user->getActivationToken()]
                ),
                'text/html'
            )
        ;

        $mailer->send($message);
        $this->addFlash('success', "Une message d'activation viens de vous être envoyé");
            return $this->redirectToRoute('app_login');
        }
        $categories_name = $this->getDoctrine()->getRepository(Categories::class)->findAll();
        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
            "categories" => $categories_name
        ]);
    }

    
    /**
    *@Route("/activation/{token}", name="activation")
    */
    public function activation($token, UserRepository $user)
    {
    // On recherche si un utilisateur avec ce token existe dans la base de données
    $user = $user->findOneBy(['activation_token' => $token]);

    // Si aucun utilisateur n'est associé à ce token
    if(!$user){
        // On renvoie une erreur 404
        throw $this->createNotFoundException('Cet utilisateur n\'existe pas');
    }

    // On supprime le token
    $user->setActivationToken(null);
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->persist($user);
    $entityManager->flush();

    // On génère un message
    $this->addFlash('message', 'Utilisateur activé avec succès');

    // On retourne à l'accueil
    return $this->redirectToRoute('app_login');
}

/**
 * @Route("/oubli-pass", name="app_forgotten_password")
 */

    public function oubliPass(Request $request, UserRepository $user, \Swift_Mailer $mailer, TokenGeneratorInterface $tokenGenerator
    ): Response
{
    // On initialise le formulaire
    $form = $this->createForm(ResetPasswordType::class);

    // On traite le formulaire
    $form->handleRequest($request);

    // Si le formulaire est valide
    if ($form->isSubmitted() && $form->isValid()) {
        // On récupère les données
        $donnees = $form->getData();

        // On cherche un utilisateur ayant cet e-mail
        $user = $user->findOneByEmail($form->get('email')->getData());

        // Si l'utilisateur n'existe pas
        if ($user === null) {
            // On envoie une alerte disant que l'adresse e-mail est inconnue
            $this->addFlash('warning', 'Cette adresse e-mail est inconnue');
            
            // On retourne sur la page de connexion
            return $this->redirectToRoute('app_login');
        }

        // On génère un token
        $token = $tokenGenerator->generateToken();

        // On essaie d'écrire le token en base de données
        try{
            $user->setResetToken($token);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
        } catch (\Exception $e) {
            $this->addFlash('warning', $e->getMessage());
            return $this->redirectToRoute('app_login');
        }

        // On génère l'URL de réinitialisation de mot de passe
        $url = $this->generateUrl('app_reset_password', array('token' => $token), UrlGeneratorInterface::ABSOLUTE_URL);

        // On génère l'e-mail
        $message = (new \Swift_Message('Mot de passe oublié'))
            ->setFrom('Mahamat@gmail.fr')
            ->setTo($user->getEmail())
            ->setBody ($this->renderView(
                'registration/reset_password_mail.html.twig', ['token' => $token]
            ),
            'text/html'
            )
        ;

        // On envoie l'e-mail
        $mailer->send($message);

        // On crée le message flash de confirmation
        $this->addFlash('success', 'E-mail de réinitialisation du mot de passe envoyé !');

        // On redirige vers la page de login
        return $this->redirectToRoute('app_login');
    }
    $categories = $this->getDoctrine()->getRepository(Categories::class)->findAll();
    // On envoie le formulaire à la vue
    return $this->render('reset_password/base.html.twig',['emailForm' => $form->createView(),"categories" => $categories]);
}
/**
 * @Route("/reset_pass/{token}", name="app_reset_password")
 */
public function resetPassword(Request $request, string $token, UserPasswordEncoderInterface $passwordEncoder)
{
    // On cherche un utilisateur avec le token donné
    $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['reset_token' => $token]);

    // Si l'utilisateur n'existe pas
    if ($user === null) {

        // On affiche une erreur
        $this->addFlash('danger', 'Token Inconnu');
        return $this->redirectToRoute('app_login');
    }

    // Si le formulaire est envoyé en méthode post
    if ($request->isMethod('POST')) {
        // On supprime le token
        $user->setResetToken(null);

        // On chiffre le mot de passe
        $user->setPassword($passwordEncoder->encodePassword($user, $request->request->get('password')));

        // On stocke
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        // On crée le message flash
        $this->addFlash('success', 'Mot de passe mis à jour');

        // On redirige vers la page de connexion
        return $this->redirectToRoute('app_login');
    }else {
        $categories = $this->getDoctrine()->getRepository(Categories::class)->findAll();
        // Si on n'a pas reçu les données, on affiche le formulaire
        return $this->render('reset_password/reset_pass.html.twig', [
            'token' => $token,
            "categories" => $categories
        ]);
    }

}
/**
 * @Route("/send_back/{id}", name="send_back")
 */
public function send_back(User $user,Request $request,\Swift_Mailer $mailer){
    $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['id' => $user]);
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

    // On crée le message flash
    $this->addFlash('success', "Une message d'activation viens de vous être envoyé");
    return $this->redirectToRoute('app_login');
    }



}
