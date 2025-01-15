<?php

namespace App\Api\User\Domain\Service;

interface IJWTEncoderService
{
    public function encode(array $data): string;
}