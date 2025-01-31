<?php

namespace Anunde\Tests\Api\User\Infrastructure\Persistence;

use Anunde\Tests\Api\User\Domain\UserEmailMother;
use Anunde\Tests\Api\User\Domain\UserMother;
use Anunde\Tests\Api\User\UserModuleInfrastructureTestCase;
use PHPUnit\Framework\Attributes\Test;

final class DoctrineUserRepositoryTest extends UserModuleInfrastructureTestCase
{
    #[Test]
    public function it_should_save_a_user(): void
    {
        $user = UserMother::create();

        $this->repository()->save($user);

        $this->assertNotNull($this->repository()->findUserByEmail($user->getEmail()));
    }

    #[Test]
    public function it_should_return_an_existing_user(): void 
    {
        $user = UserMother::create();

        $this->repository()->save($user);

        $this->assertEquals($user, $this->repository()->findUserByEmail($user->getEmail()));
    }

    #[Test]
    public function it_should_not_return_a_non_existing_user(): void
    {
        $this->assertNull($this->repository()->findUserByEmail(UserEmailMother::create()));
    }
}