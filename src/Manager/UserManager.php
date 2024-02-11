<?php

namespace App\Manager;

use App\Entity\User;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
class UserManager
{
  /**
   * @param  EntityManagerInterface $entityManager
   */
  private $entityManager;

  /**
   * @param UserPasswordHasherInterface $passwordHasher
   */
  private $passwordHasher;

  public function __construct(EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher) 
  {
    $this->entityManager = $entityManager;
    $this->passwordHasher = $passwordHasher;
  }

  public function save(User $user): void
  {
    $password = $user->getPassword();
    $user->setPassword($this->passwordHasher->hashPassword($user, $password));
    $user->getClient()->setEmail($user->getEmail());

    $this->entityManager->persist($user);
    $this->entityManager->flush();
  }
}