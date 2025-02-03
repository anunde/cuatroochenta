<?php

namespace Anunde\Api\Sensor\Infrastructure\Persistence\Doctrine;

use Anunde\Api\Sensor\Domain\SensorId;
use Anunde\Shared\Infrastructure\Persistence\Doctrine\UuidType;

final class SensorIdType extends UuidType
{
    public static function customTypeName(): string
    {
        return 'sensor_id';
    }

    protected function typeClassName(): string
    {
        return SensorId::class;
    }
}