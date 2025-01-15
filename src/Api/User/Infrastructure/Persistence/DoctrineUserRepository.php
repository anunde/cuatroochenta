<?php

namespace App\Api\User\Infrastructure\Persistence;

use App\Api\User\Domain\Entity\User;
use App\Api\User\Domain\Repository\IUserRepository;
use App\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;

final class DoctrineUserRepository extends DoctrineRepository implements IUserRepository
{
    public function findUserByEmail(string $email): ?User
    {
        return $this->repository(User::class)->findOneBy(['email.value' => $email]);
    }
}