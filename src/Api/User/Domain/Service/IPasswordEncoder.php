<?php

namespace Anunde\Api\User\Domain\Service;

interface IPasswordEncoder
{
    public function encode(string $plainPassword): string;
    public function isValid(string $plainPassword, string $hashedPassword): bool;
}