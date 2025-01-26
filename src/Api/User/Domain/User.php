<?php

namespace Anunde\Api\User\Domain;

use Anunde\Shared\Domain\Aggregate\AggregateRoot;

final class User extends AggregateRoot
{

    public function __construct(
        private readonly UserId $id,
        private UserName $name,
        private UserSurname $surname,
        private UserEmail $email,
        private UserPassword $password        
    ) {}

    public static function create(
        UserId $id,
        UserName $name,
        UserSurname $surname,
        UserEmail $email,
        UserPassword $password
    ): self 
    {
        return new self(
            $id, 
            $name, 
            $surname, 
            $email, 
            $password
        );
    }

    public function getEmail(): UserEmail
    {
        return $this->email;
    }

    public function getPassword(): UserPassword
    {
        return $this->password;
    }
}