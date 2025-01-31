<?php

namespace Anunde\Api\User\Domain\Repository;

use Anunde\Api\User\Domain\User;
use Anunde\Api\User\Domain\UserEmail;

interface IUserRepository
{   
    public function save(User $user): void;
    
    public function findUserByEmail(UserEmail $email): ?User;
}