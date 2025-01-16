<?php

namespace Anunde\Api\User\Domain\Service;

interface IJWTEncoderService
{
    public function encode(array $data): string;
}