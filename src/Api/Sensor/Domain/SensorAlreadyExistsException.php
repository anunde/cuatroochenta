<?php

namespace Anunde\Api\Sensor\Domain;

final class SensorAlreadyExistsException extends \Exception
{
    public function __construct(string $message, int $code = 409, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}