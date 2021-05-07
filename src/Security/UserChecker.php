<?php

namespace App\Security;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpClient\Exception\RedirectionException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAccountStatusException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\LockedException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class UserChecker implements UserCheckerInterface
{
    public function __construct(EntityManagerInterface $entityManager, UrlGeneratorInterface $urlGenerator)
    {
        $this->entityManager = $entityManager;
        $this->urlGenerator = $urlGenerator;
    }
    public function checkPreAuth(UserInterface $user)
    {
        if (!$user instanceof User) {
            return;
        }
     

    }

    public function checkPostAuth(UserInterface $user)
    {
    
        if (!$user instanceof User) {
            return;
        }
        if (!$user->getActivationToken()==null) {
            throw new CustomUserMessageAccountStatusException("Please check your email to confirm your registration before 1 hour");
        }
        
    }
}