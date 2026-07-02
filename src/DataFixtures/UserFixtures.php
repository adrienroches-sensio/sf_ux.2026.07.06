<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;

class UserFixtures extends Fixture
{
    private const USERS = [
        [
            'email' => 'nobody@example.com',
            'password' => 'nobody',
            'roles' => [],
        ],
        [
            'email' => 'user@example.com',
            'password' => 'user',
            'roles' => ['ROLE_USER'],
        ],
        [
            'email' => 'website@example.com',
            'password' => 'website',
            'roles' => ['ROLE_WEBSITE'],
        ],
        [
            'email' => 'organizer@example.com',
            'password' => 'organizer',
            'roles' => ['ROLE_ORGANIZER'],
        ],
        [
            'email' => 'admin@example.com',
            'password' => 'admin',
            'roles' => ['ROLE_ADMIN'],
        ],
    ];

    public function __construct(
        private readonly PasswordHasherFactoryInterface $passwordHasherFactory,
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        foreach (self::USERS as $userDetails) {
            [
                'email' => $email,
                'password' => $password,
                'roles' => $roles,
            ] = $userDetails;

            $user = (new User())
                ->setEmail($email)
                ->setPassword($this->passwordHasherFactory->getPasswordHasher(User::class)->hash($password))
                ->setRoles($roles)
            ;

            $manager->persist($user);

            $this->addReference($email, $user);
        }

        $manager->flush();
    }
}
