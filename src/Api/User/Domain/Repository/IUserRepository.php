<?php

namespace App\Api\User\Domain\Repository;

use App\Api\User\Domain\Entity\User;

interface IUserRepository
{
    public function findUserByEmail(string $email): ?User;
}