<?php

namespace App\Api\Auth\Domain\Repository;

use App\Api\Auth\Domain\Entity\User;

interface IUserRepository
{
    public function findUserByEmail(string $email): ?User;
}