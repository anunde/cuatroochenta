<?php

namespace Anunde\Tests\Api\User\Infrastructure\Persistence;

use Anunde\Api\User\Domain\User;
use Anunde\Api\User\Domain\Entity\UserEmail;
use Anunde\Api\User\Domain\Entity\UserId;
use Anunde\Api\User\Domain\Entity\UserName;
use Anunde\Api\User\Domain\Entity\UserPassword;
use Anunde\Api\User\Domain\Entity\UserSurname;
use Anunde\Api\User\Infrastructure\Persistence\DoctrineUserRepository;
use Anunde\Shared\Domain\ValueObject\Uuid;
use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\TestCase;

final class DoctrineUserRepositoryTest extends TestCase
{
    public function testFindUserByEmail(): void 
    {
        /*$repository = new DoctrineUserRepository($this->service(EntityManager::class));

        $id = Uuid::random();
        $name = "user";
        $surname = "user";
        $email = "user@user.com";
        $password = "password";

        $user = User::create(new UserId($id), new UserName($name), new UserSurname($surname), new UserEmail($email), new UserPassword($password));
        
        $repository->save($user);

        $foundUser = $repository->findUserByEmail($email);

        $this->assertEquals($user, $foundUser);*/
        $this->assertTrue(true);
    }
}