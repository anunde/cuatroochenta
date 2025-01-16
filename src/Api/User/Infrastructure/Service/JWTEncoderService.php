<?php

namespace Anunde\Api\User\Infrastructure\Service;

use Anunde\Api\User\Domain\Service\IJWTEncoderService;
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