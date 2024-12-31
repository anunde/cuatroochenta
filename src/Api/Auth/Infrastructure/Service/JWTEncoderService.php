<?php

namespace App\Api\Auth\Infrastructure\Service;

use App\Api\Auth\Domain\Service\IJWTEncoderService;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;

readonly class JWTEncoderService implements IJWTEncoderService
{
    public function __construct(
        private JWTEncoderInterface $jwtEncoder
    )
    {
    }

    /**
     * @throws JWTEncodeFailureException
     */
    public function encode(array $data): string
    {
        return $this->jwtEncoder->encode($data);
    }
}