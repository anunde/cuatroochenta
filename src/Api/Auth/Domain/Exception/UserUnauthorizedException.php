<?php

namespace App\Api\Auth\Domain\Exception;

class UserUnauthorizedException extends \Exception
{
    public function __construct(string $message = "", int $code = 401, ?\Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}