<?php

namespace App\Api\Auth\Infrastructure\Persistence;

use App\Api\Auth\Domain\Entity\User;
use App\Api\Auth\Domain\Repository\IUserRepository;
use App\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;

final class DoctrineUserRepository extends DoctrineRepository implements IUserRepository
{
    public function findUserByEmail(string $email): ?User
    {
        return $this->repository(User::class)->findOneBy(['email.value' => $email]);
    }
}