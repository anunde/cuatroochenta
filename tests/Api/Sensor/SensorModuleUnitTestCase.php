<?php

namespace Anunde\Tests\Api\Sensor;

use Anunde\Api\Sensor\Domain\Repository\SensorRepository;
use Anunde\Api\Sensor\Domain\Sensor;
use Anunde\Api\Sensor\Domain\SensorName;
use Anunde\Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;
use Mockery\MockInterface;

abstract class SensorModuleUnitTestCase extends UnitTestCase
{
    private SensorRepository | MockInterface | null $repository;

    protected function shouldSave(Sensor $sensor): void
    {
        $this->repository()
            ->shouldReceive('save')
            ->with($this->similarTo($sensor))
            ->once()
            ->andReturnNull();
    }

    protected function shouldSearch(SensorName $name, ?Sensor $sensor): void
    {
        $this->repository()
            ->shouldReceive('findSensorByName')
            ->with($this->similarTo($name))
            ->once()
            ->andReturn($sensor);
    }

    protected function repository(): SensorRepository | MockInterface
    {
        return $this->repository ??= $this->mock(SensorRepository::class);
    }

}