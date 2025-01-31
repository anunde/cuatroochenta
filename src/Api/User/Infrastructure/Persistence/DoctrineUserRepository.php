<?php

namespace Anunde\Api\User\Infrastructure\Persistence;

use Anunde\Api\User\Domain\User;
use Anunde\Api\User\Domain\Repository\IUserRepository;
use Anunde\Api\User\Domain\UserEmail;
use Anunde\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;

final class DoctrineUserRepository extends DoctrineRepository implements IUserRepository
{
    public function save(User $user): void
    {
        $this->persist($user, true);
    }

    public function findUserByEmail(UserEmail $email): ?User
    {
        return $this->repository(User::class)->findOneBy(['email.value' => $email->value()]);
    }
}