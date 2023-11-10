<?php

namespace App\Tests\Unit;

use App\Entity\Users;
use PHPUnit\Framework\TestCase;


class UsersTest extends TestCase
{
    public function testIsTrue()
    {
        $user = new Users();
        $dateCreatedAt = new \DateTimeImmutable();
        $dateUpdatedAt = new \DateTime();

        $user->setEmail('true@test.com')
             ->setFirstname('prenom')
             ->setLastname('nom')
             ->setPassword('password')
             ->setRoles(['ROLE_TEST'])
             ->setCreatedAt($dateCreatedAt)
             ->setUpdatedAt($dateUpdatedAt);

        $this->assertTrue($user->getEmail() === 'true@test.com');
        $this->assertTrue($user->getFirstname() === 'prenom');
        $this->assertTrue($user->getLastname() === 'nom');
        $this->assertTrue($user->getPassword() === 'password');
        $this->assertTrue($user->getRoles() === ['ROLE_TEST', 'ROLE_USER']);
        $this->assertTrue($user->getCreatedAt() === $dateCreatedAt);
        $this->assertTrue($user->getUpdatedAt() === $dateUpdatedAt);
    }

    public function testIsFalse()
    {
        $user = new Users();

        $user->setEmail('true@test.com')
             ->setFirstname('prenom')
             ->setLastname('nom')
             ->setPassword('password');

        $this->assertFalse($user->getEmail() === 'false@test.com');
        $this->assertFalse($user->getFirstname() === 'false');
        $this->assertFalse($user->getLastname() === 'false');
        $this->assertFalse($user->getPassword() === 'false');
    }

    public function testIsEmpty()
    {
        $user = new Users();

        $user->setEmail('')
             ->setFirstname('')
             ->setLastname('')
             ->setPassword('');

        $this->assertEmpty($user->getEmail());
        $this->assertEmpty($user->getFirstname());
        $this->assertEmpty($user->getLastname());
        $this->assertEmpty($user->getPassword());
        $this->assertEmpty($user->getId());
    }
}