<?php

namespace Anunde\Tests\Api\User\Infrastructure\Service;

use Anunde\Api\User\Domain\Service\IJWTEncoderService;

final class ConstantJWTEncoderService implements IJWTEncoderService {
    
    public function encode(array $data): string
    {
        return "jwt-token";
    }
}