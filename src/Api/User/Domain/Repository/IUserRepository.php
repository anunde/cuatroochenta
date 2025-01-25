<?php

namespace Anunde\Api\User\Domain\Repository;

use Anunde\Api\User\Domain\Entity\User;

interface IUserRepository
{   
    public function save(User $user): void;
    
    public function findUserByEmail(string $email): ?User;
}