<?php

namespace Anunde\Tests\Api\User\Domain;

use Anunde\Api\User\Domain\UserSurname;
use Anunde\Tests\Shared\Domain\WordMother;

final class UserSurnameMother
{
    public static function create(?string $name = null): UserSurname
    {
        return new UserSurname($name ?? WordMother::create());
    }
}