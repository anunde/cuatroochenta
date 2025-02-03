<?php

namespace Anunde\Tests\Api\Sensor\Infrastructure\Persistence;

use Anunde\Tests\Api\Sensor\Domain\SensorMother;
use Anunde\Tests\Api\Sensor\Domain\SensorNameMother;
use Anunde\Tests\Api\Sensor\SensorModuleInfrastructureTestCase;
use PHPUnit\Framework\Attributes\Test;

final class DoctrineSensorRepositoryTest extends SensorModuleInfrastructureTestCase
{
    #[Test]
    public function it_should_save_a_sensor(): void
    {
        $sensor = SensorMother::create();
        
        $this->repository()->save($sensor);
        
        $this->assertNotNull($this->repository()->findSensorByName($sensor->getName()));
    }

    #[Test]
    public function it_should_return_an_existing_sensor(): void 
    {
        $sensor = SensorMother::create();

        $this->repository()->save($sensor);

        $this->assertEquals($sensor, $this->repository()->findSensorByName($sensor->getName()));
    }

    #[Test]
    public function it_should_not_return_a_non_existing_sensor(): void
    {
        $this->assertNull($this->repository()->findSensorByName(SensorNameMother::create()));
    }
}