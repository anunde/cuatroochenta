<?php

namespace Anunde\Tests\Api\Sensor\Application;

use Anunde\Api\Sensor\Application\SensorRegister\SensorRegister;
use Anunde\Tests\Api\Sensor\Application\SensorRegisterRequestMother;
use Anunde\Tests\Api\Sensor\Domain\SensorMother;
use Anunde\Tests\Api\Sensor\SensorModuleUnitTestCase;
use PHPUnit\Framework\Attributes\Test;

final class SensorRegisterTest extends SensorModuleUnitTestCase 
{
    private SensorRegister | null $handler;

	protected function setUp(): void
	{
		parent::setUp();

		$this->handler = new SensorRegister($this->repository());
	}

    #[Test]
    public function it_should_register_a_new_sensor(): void
    {
        $sensor = SensorMother::create();
        $request = SensorRegisterRequestMother::create($sensor->getId(), $sensor->getName());
        
        $this->shouldSave($sensor);
        
        $this->handler->__invoke($request);
    }
}