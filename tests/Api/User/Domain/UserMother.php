<?php

namespace Anunde\Tests\Api\User\Domain;

use Anunde\Api\User\Domain\User;
use Anunde\Api\User\Domain\UserEmail;
use Anunde\Api\User\Domain\UserId;
use Anunde\Api\User\Domain\UserName;
use Anunde\Api\User\Domain\UserPassword;
use Anunde\Api\User\Domain\UserSurname;

final class UserMother
{
    public static function create(
        ?UserId $id = null,
        ?UserName $name = null,
        ?UserSurname $surname = null,
        ?UserEmail $email = null,
        ?UserPassword $password = null
    ): User {
        return new User(
            $id ?? UserIdMother::create(),
            $name ?? UserNameMother::create(),
            $surname ?? UserSurnameMother::create(),
            $email ?? UserEmailMother::create(),
            $password ?? UserPasswordMother::create()
        );
    }
}