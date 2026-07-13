<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;

class UsersFixture extends Fixture
{
    const USERS = [
        [
            'email' => 'user@example.com',
            'roles' => ['ROLE_USER'],
            'password' => 'password',
        ],
        [
            'email' => 'admin@example.com',
            'roles' => ['ROLE_SUPER_ADMIN', 'ROLE_ADMIN'],
            'password' => 'password',
        ]
    ];

    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
    }


    public function load(ObjectManager $manager): void
    {
        foreach (self::USERS as $userData) {
            $user = new User();
            $user->setEmail($userData['email']);
            $user->setRoles($userData['roles']);
            $user->setPassword($this->passwordHasher->hashPassword($user, $userData['password']));

            $manager->persist($user);
        }

        $manager->flush();
    }
}
