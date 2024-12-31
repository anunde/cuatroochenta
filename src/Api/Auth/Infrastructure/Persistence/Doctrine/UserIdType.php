<?php

namespace App\Api\Auth\Infrastructure\Persistence\Doctrine;

use App\Api\Auth\Domain\Entity\UserId;
use App\Shared\Infrastructure\Persistence\Doctrine\UuidType;

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