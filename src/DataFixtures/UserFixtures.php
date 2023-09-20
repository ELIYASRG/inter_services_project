<?php

namespace App\DataFixtures;

use App\Entity\Associer;
use DateTimeImmutable;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{

    private UserPasswordHasherInterface $userPasswordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $super_admin = $this->createAdmin();

        $manager->persist($super_admin);

        $manager->flush();
    }

    private function createAdmin()
    {
        $super_admin = new Associer();

        $password_hashed = $this->userPasswordHasher->hashPassword($super_admin, "Azerty1234A*");

        $super_admin->setAgence("InterServices VLG");
        $super_admin->setEmail("inter-services@gmail.com");
        $super_admin->setPassword($password_hashed);
        $super_admin->setRoles(['ROLE_SUPER_ADMIN', 'ROLE_ADMIN', 'ROLE_USER']);
        $super_admin->setIsVerified(true);
        $super_admin->setVerifiedAt(new DateTimeImmutable('now'));

        return $super_admin;
    }
}
