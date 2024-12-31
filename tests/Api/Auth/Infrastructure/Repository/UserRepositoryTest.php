<?php

namespace Tests\Api\Auth\Infrastructure\Repository;

use Api\Auth\Infrastructure\Repository\UserRepository;
use PHPUnit\Framework\TestCase;

final class UserRepositoryTest extends TestCase
{
    public function testFindUserByEmail(): void
    {
        $repository = new UserRepository();
        $repository->findUserByEmail("user@user.com");
    }
}