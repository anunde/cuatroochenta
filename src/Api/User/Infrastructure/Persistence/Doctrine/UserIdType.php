<?php

namespace Anunde\Api\User\Infrastructure\Persistence\Doctrine;

use Anunde\Api\User\Domain\Entity\UserId;
use Anunde\Shared\Infrastructure\Persistence\Doctrine\UuidType;

final class UserIdType extends UuidType
{
    public static function customTypeName(): string
    {
        return 'user_id';
    }

    protected function typeClassName(): string
    {
        return UserId::class;
    }
}