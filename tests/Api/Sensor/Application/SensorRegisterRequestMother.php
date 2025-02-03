<?php

namespace Anunde\Tests\Api\Sensor\Application;

use Anunde\Api\Sensor\Application\SensorRegister\SensorRegisterRequest;
use Anunde\Api\Sensor\Domain\SensorId;
use Anunde\Api\Sensor\Domain\SensorName;
use Anunde\Tests\Api\Sensor\Domain\SensorIdMother;
use Anunde\Tests\Api\Sensor\Domain\SensorNameMother;

final class SensorRegisterRequestMother
{
    public static function create(
        ?SensorId $id = null,
        ?SensorName $name = null,
    ): SensorRegisterRequest {
        return new SensorRegisterRequest(
            $id?->value() ?? SensorIdMother::create()->value(),
            $name?->value() ?? SensorNameMother::create()->value(),
        );
    }
}
