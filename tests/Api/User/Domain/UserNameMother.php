<?php

namespace Anunde\Tests\Api\User\Domain;

use Anunde\Api\User\Domain\UserName;
use Anunde\Tests\Shared\Domain\WordMother;

final class UserNameMother
{
    public static function create(?string $name = null): UserName
    {
        return new UserName($name ?? WordMother::create());
    }
}