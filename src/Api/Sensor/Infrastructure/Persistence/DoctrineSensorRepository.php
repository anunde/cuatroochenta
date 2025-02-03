<?php

namespace Anunde\Api\Sensor\Infrastructure\Persistence;

use Anunde\Api\Sensor\Domain\Repository\SensorRepository;
use Anunde\Api\Sensor\Domain\Sensor;
use Anunde\Api\Sensor\Domain\SensorName;
use Anunde\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;

final class DoctrineSensorRepository extends DoctrineRepository implements SensorRepository
{
    public function save(Sensor $sensor): void
    {
        $this->persist($sensor, true);
    }

    public function findSensorByName(SensorName $name): ?Sensor
    {
        return $this->repository(Sensor::class)->findOneBy(['name.value' => $name->value()]);
    }
}