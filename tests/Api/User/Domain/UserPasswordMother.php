<?php

namespace Anunde\Tests\Api\User\Domain;

use Anunde\Api\User\Domain\UserPassword;
use Anunde\Tests\Shared\Domain\WordMother;

final class UserPasswordMother
{
    public static function create(?string $password = null): UserPassword
    {
        return new UserPassword($password ?? WordMother::create());
    }
}