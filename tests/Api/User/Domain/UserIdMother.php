<?php

namespace Anunde\Tests\Api\User\Domain;

use Anunde\Api\User\Domain\UserId;
use Anunde\Tests\Shared\Domain\UuidMother;

final class UserIdMother
{
    public static function create(?int $id = null): UserId
    {
        return new UserId($id ?? UuidMother::create());
    }
}