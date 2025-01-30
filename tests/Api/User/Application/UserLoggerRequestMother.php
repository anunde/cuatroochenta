<?php

namespace Anunde\Tests\Api\User\Application;

use Anunde\Api\User\Application\UserLogger\UserLoggerRequest;
use Anunde\Api\User\Domain\UserEmail;
use Anunde\Api\User\Domain\UserPassword;
use Anunde\Tests\Api\User\Domain\UserEmailMother;
use Anunde\Tests\Api\User\Domain\UserPasswordMother;

final class UserLoggerRequestMother
{
    public static function create(
        ?UserEmail $email = null,
        ?UserPassword $password = null
    ): UserLoggerRequest {
        return new UserLoggerRequest(
            $email?->value() ?? UserEmailMother::create()->value(),
            $password?->value() ?? UserPasswordMother::create()->value()
        );
    }
}
