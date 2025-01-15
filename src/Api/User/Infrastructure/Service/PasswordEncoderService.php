<?php

namespace App\Api\User\Infrastructure\Service;

use App\Api\User\Domain\Service\IPasswordEncoder;

final class PasswordEncoderService implements IPasswordEncoder
{
    private const MIN_LENGTH = 8;

    public function encode(string $plainPassword): string
    {
        if(self::MIN_LENGTH > \strlen($plainPassword)) {
            throw new \InvalidArgumentException('The password must contain at least 8 characters', 400);
        }

        $hash = password_hash($plainPassword, PASSWORD_DEFAULT);

        if (!$hash) {
            throw new \RuntimeException('Password hashing failed', 500);
        }

        return $hash;
    }

    public function isValid(string $plainPassword, string $hashedPassword): bool
    {
        return password_verify($plainPassword, $hashedPassword);
    }
}