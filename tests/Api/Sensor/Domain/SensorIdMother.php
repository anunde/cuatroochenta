<?php

namespace Anunde\Tests\Api\Sensor\Domain;

use Anunde\Api\Sensor\Domain\SensorId;
use Anunde\Tests\Shared\Domain\UuidMother;

final class SensorIdMother
{
    public static function create(?int $id = null): SensorId
    {
        return new SensorId($id ?? UuidMother::create());
    }
}