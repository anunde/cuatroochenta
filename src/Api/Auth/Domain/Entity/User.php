<?php

namespace App\Api\Auth\Domain\Entity;

use App\Shared\Domain\Entity\Entity;

final class User extends Entity
{
    private readonly UserId $id;
    private UserName $name;
    private UserSurname $surname;
    private UserEmail $email;
    private UserPassword $password;   
    
    public function __construct(
        UserId $id,
        UserName $name,
        UserSurname $surname,
        UserEmail $email,
        UserPassword $password        
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->password = $password;
    }

    public static function create(
        UserId $id,
        UserName $name,
        UserSurname $surname,
        UserEmail $email,
        UserPassword $password
    ): self {
        return new self($id, $name, $surname, $email, $password);
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