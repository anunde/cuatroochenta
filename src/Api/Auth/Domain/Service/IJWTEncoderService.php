<?php

namespace App\Api\Auth\Domain\Service;

interface IJWTEncoderService
{
    public function encode(array $data): string;
}