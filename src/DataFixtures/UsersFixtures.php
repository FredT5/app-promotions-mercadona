<?php

namespace App\DataFixtures;

use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker;

/**
 * @codeCoverageIgnore
 */

class UsersFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $passwordEncoder
    ) {}

    public function load(ObjectManager $manager): void
    {
        // create admin
        $admin = new Users();
        $admin->setEmail('admin@yopmail.com')
              ->setLastname('Totée')
              ->setFirstname('Frédéric')
              ->setPassword($this->passwordEncoder->hashPassword($admin, 'admin!'))
              ->setRoles(['ROLE_ADMIN']);

        $manager->persist($admin);

        // use the factory to create a Faker\Generator instance
        // create a French faker
        $faker = Faker\Factory::create('fr_FR');
        
        // create users
        for($i = 1; $i <= 5; $i++){
            $user = new Users();
            $user->setEmail("user$i@yopmail.com")
                 ->setFirstname($faker->firstName)
                 ->setLastname($faker->lastName)
                 ->setPassword($this->passwordEncoder->hashPassword($user, 'user!'));

            $manager->persist($user);
        }

        $manager->flush();
    }
}