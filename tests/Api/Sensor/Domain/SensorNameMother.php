<?php

namespace Anunde\Tests\Api\Sensor\Domain;

use Anunde\Api\Sensor\Domain\SensorName;
use Anunde\Tests\Shared\Domain\WordMother;

final class SensorNameMother
{
    public static function create(?string $name = null): SensorName
    {
        return new SensorName($name ?? WordMother::create());
    }
}