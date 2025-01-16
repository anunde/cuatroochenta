<?php

namespace Anunde\Api\User\Infrastructure\Persistence;

use Anunde\Api\User\Domain\Entity\User;
use Anunde\Api\User\Domain\Repository\IUserRepository;
use Anunde\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;

final class DoctrineUserRepository extends DoctrineRepository implements IUserRepository
{
    public function findUserByEmail(string $email): ?User
    {
        return $this->repository(User::class)->findOneBy(['email.value' => $email]);
    }
}