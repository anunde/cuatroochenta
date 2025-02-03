<?php

namespace Anunde\Tests\Api\Sensor\Domain;

use Anunde\Api\Sensor\Domain\Sensor;
use Anunde\Api\Sensor\Domain\SensorId;
use Anunde\Api\Sensor\Domain\SensorName;

final class SensorMother
{
    public static function create(
        ?SensorId $id = null,
        ?SensorName $name = null,
    ): Sensor {
        return new Sensor(
            $id ?? SensorIdMother::create(),
            $name ?? SensorNameMother::create(),
        );
    }
}