<?php

namespace Anunde\Tests\Api\User\Domain;

use Anunde\Api\User\Domain\UserEmail;
use Anunde\Tests\Shared\Domain\EmailMother;

final class UserEmailMother
{
    public static function create(?string $name = null): UserEmail
    {
        return new UserEmail($name ?? EmailMother::create());
    }
}